<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'admin') {
                return redirect('/')->with('error', 'Unauthorized access');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $search = request('search');
        $status = request('status');

        $query = JobPosting::with('postedBy');

        if ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%");
        }

        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        $jobs = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.jobs.index', [
            'jobs' => $jobs,
            'search' => $search,
            'status' => $status,
        ]);
    }

    public function create()
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company_name' => 'required|string|max:255',
            'position_type' => 'required|in:Full-time,Part-time,Contract',
            'location' => 'required|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'requirements' => 'nullable|string',
            'deadline' => 'required|date|after:today',
        ]);

        JobPosting::create([
            'title' => $request->title,
            'description' => $request->description,
            'company_name' => $request->company_name,
            'position_type' => $request->position_type,
            'location' => $request->location,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'requirements' => $request->requirements,
            'deadline' => $request->deadline,
            'posted_by' => Auth::id(),
        ]);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job posting created successfully');
    }

    public function edit($id)
    {
        $job = JobPosting::findOrFail($id);

        return view('admin.jobs.edit', [
            'job' => $job,
        ]);
    }

    public function update(Request $request, $id)
    {
        $job = JobPosting::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company_name' => 'required|string|max:255',
            'position_type' => 'required|in:Full-time,Part-time,Contract',
            'location' => 'required|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'requirements' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        $job->update($request->all());

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job posting updated successfully');
    }

    public function delete($id)
    {
        $job = JobPosting::findOrFail($id);
        $job->delete();

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job posting deleted successfully');
    }

    public function review($id)
    {
        $job = JobPosting::findOrFail($id);
        $poster = $job->postedBy;

        return view('admin.jobs.review', compact('job', 'poster'));
    }

    public function approve($id)
    {
        $job = JobPosting::findOrFail($id);
        $job->forceFill([
            'approval_status' => 'approved',
            'is_active' => true,
        ])->save();

        return redirect()->route('admin.jobs.review', $job->id)
            ->with('success', 'Job posting approved successfully');
    }

    public function reject(Request $request, $id)
    {
        $job = JobPosting::findOrFail($id);
        $job->forceFill([
            'approval_status' => 'rejected',
            'is_active' => false,
            'admin_notes' => $request->input('admin_notes'),
        ])->save();

        return redirect()->route('admin.jobs.review', $job->id)
            ->with('success', 'Job posting rejected');
    }

    public function disable($id)
    {
        $job = JobPosting::findOrFail($id);
        $job->forceFill([
            'is_active' => false,
            'approval_status' => 'pending',
        ])->save();

        return redirect()->route('admin.jobs.review', $job->id)
            ->with('success', 'Job posting disabled and returned to pending for editing');
    }

    public function applications($id)
    {
        $job = JobPosting::findOrFail($id);
        $applications = $job->applications()->with('alumni')->paginate(10);

        return view('admin.jobs.applications', [
            'job' => $job,
            'applications' => $applications,
        ]);
    }

    public function approveApplication($id)
    {
        $application = JobApplication::findOrFail($id);
        $application->update(['status' => 'approved']);

        return back()->with('success', 'Application approved');
    }

    public function rejectApplication(Request $request, $id)
    {
        $application = JobApplication::findOrFail($id);
        $application->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', 'Application rejected');
    }
}
