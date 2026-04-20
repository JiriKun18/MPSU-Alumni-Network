<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobPostingController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        if (!($user instanceof User) || !$user->isAlumni()) {
            return redirect()->route('login');
        }

        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!($user instanceof User) || !$user->isAlumni()) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company_name' => 'required|string|max:255',
            'position_type' => 'required|in:Full-time,Part-time,Contract',
            'location' => 'required|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'contact_website' => 'nullable|url|max:255',
            'contact_address' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'deadline' => 'required|date|after:today',
        ]);

        JobPosting::create(array_merge($validated, [
            'posted_by' => $user->id,
            'is_active' => true,
            'approval_status' => 'pending',
        ]));

        return redirect()->route('jobs.index')
            ->with('success', 'Job posting submitted successfully and is pending admin review.');
    }

    public function index()
    {
        $search = request('search');
        $company = request('company');
        $position = request('position_type');

        $query = JobPosting::where('is_active', true)->orderBy('deadline', 'asc');

        if ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%");
        }

        if ($company) {
            $query->where('company_name', 'like', "%{$company}%");
        }

        if ($position) {
            $query->where('position_type', $position);
        }

        $jobs = $query->paginate(10);

        return view('jobs.index', [
            'jobs' => $jobs,
            'search' => $search,
            'company' => $company,
            'position' => $position,
        ]);
    }

    public function show($id)
    {
        $job = JobPosting::findOrFail($id);
        $applicationCount = $job->applications()->count();
        $hasApplied = false;
        $user = Auth::user();

        if ($user instanceof User && $user->isAlumni()) {
            $hasApplied = JobApplication::where('alumni_id', $user->id)
                ->where('job_posting_id', $id)
                ->exists();
        }

        return view('jobs.show', [
            'job' => $job,
            'applicationCount' => $applicationCount,
            'hasApplied' => $hasApplied,
        ]);
    }

    public function apply(Request $request, $id)
    {
        $user = Auth::user();
        if (!($user instanceof User) || !$user->isAlumni()) {
            return redirect()->route('login');
        }

        $request->validate([
            'cover_letter' => 'nullable|string|max:1000',
            'cv_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $job = JobPosting::findOrFail($id);

        $existing = JobApplication::where('alumni_id', $user->id)
            ->where('job_posting_id', $id)
            ->first();

        if ($existing) {
            return back()->with('error', 'You have already applied for this job');
        }

        $cvPath = null;
        if ($request->hasFile('cv_file')) {
            $cvPath = $request->file('cv_file')->store('cvs', 'public');
        }

        JobApplication::create([
            'alumni_id' => $user->id,
            'job_posting_id' => $id,
            'cover_letter' => $request->cover_letter,
            'cv_file' => $cvPath,
        ]);

        return redirect()->route('jobs.show', $id)
            ->with('success', 'Your application has been submitted successfully');
    }
}
