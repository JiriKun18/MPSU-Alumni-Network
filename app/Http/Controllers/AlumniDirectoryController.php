<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Batch;
use App\Models\AlumniProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumniDirectoryController extends Controller
{
    /**
     * Display alumni directory for alumni users (basic view)
     */
    public function index(Request $request)
    {
        $query = User::with(['alumniProfile.batch'])
            ->where('role', 'alumni')
            ->where('is_active', true)
            ->where('is_verified', true);

        // Filter by batch/year
        if ($request->filled('batch')) {
            $query->whereHas('alumniProfile', function ($q) use ($request) {
                $q->where('batch_id', $request->batch);
            });
        }

        // Filter by course
        if ($request->filled('course')) {
            $query->whereHas('alumniProfile', function ($q) use ($request) {
                $q->where('course', $request->course);
            });
        }

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $alumni = $query->orderBy('name')->paginate(12);


        // Get available batches
        $batches = Batch::orderBy('year', 'desc')->get();
        // Get all courses from Course model (with major if present), like admin panel
        $courses = \App\Models\Course::orderBy('course_name')
            ->orderBy('major')
            ->get()
            ->map(function($course) {
                return $course->major ? ($course->course_name . ' - ' . $course->major) : $course->course_name;
            });

        return view('alumni.directory', compact('alumni', 'batches', 'courses'));
    }

    /**
     * Show detailed profile (basic info only for alumni users)
     */
    public function show($id)
    {
        if (auth()->user() && !auth()->user()->is_verified) {
            return view('alumni.profile-view', [
                'user' => null,
                'verificationRequired' => true,
            ]);
        }

        $user = User::with(['alumniProfile.batch'])
            ->where('role', 'alumni')
            ->where('is_active', true)
            ->where('is_verified', true)
            ->findOrFail($id);

        return view('alumni.profile-view', [
            'user' => $user,
            'verificationRequired' => false,
        ]);
    }
}
