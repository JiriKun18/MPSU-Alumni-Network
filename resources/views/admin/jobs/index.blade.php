@extends('admin.layout')
@section('title','Jobs Management')
@section('content')
<div class="container-fluid py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0" style="font-size: 2rem; font-weight: 800; color: var(--admin-primary);">
      <i class="fas fa-briefcase"></i> Jobs Management
    </h1>
    <a href="{{ route('admin.jobs.create') }}" class="btn" style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white; font-weight: 600; padding: 0.75rem 1.5rem;">
      <i class="fas fa-plus-circle"></i> Post New Job
    </a>
  </div>

  <!-- Search and Filter -->
  <div class="card mb-3" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
    <div class="card-body">
      <form method="GET" action="{{ route('admin.jobs.index') }}">
        <div class="row g-3">
          <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search jobs..." value="{{ $search ?? '' }}">
          </div>
          <div class="col-md-3">
            <select name="status" class="form-select">
              <option value="">All Status</option>
              <option value="active" {{ ($status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
              <option value="inactive" {{ ($status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
          </div>
          <div class="col-md-3">
            <select name="scope" class="form-select">
              <option value="">All Jobs</option>
              <option value="mine" {{ ($scope ?? '') == 'mine' ? 'selected' : '' }}>Your Job Postings</option>
              <option value="pending" {{ ($scope ?? '') == 'pending' ? 'selected' : '' }}>Pending Requests</option>
            </select>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn w-100" style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white; font-weight: 600;">
              <i class="fas fa-search"></i> Search
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Jobs Table -->
  <div class="card" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
    <div class="card-body">
      @if($jobs->count() > 0)
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Job Title</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Company</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Location</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Posted By</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Type</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Deadline</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Contact</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Approval</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Posted</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Status</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($jobs as $job)
                <tr>
                  <td><strong>{{ $job->title }}</strong></td>
                  <td>{{ $job->company_name }}</td>
                  <td>{{ $job->location }}</td>
                  <td>
                    @if($job->postedBy)
                      <div><strong>{{ $job->postedBy->name }}</strong></div>
                      <small class="text-muted">{{ $job->postedBy->email }}</small>
                    @else
                      <span class="text-muted">Unknown</span>
                    @endif
                  </td>
                  <td>{{ $job->position_type }}</td>
                  <td>{{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}</td>
                  <td>
                    <small>{{ $job->contact_email }}@if($job->contact_phone) | {{ $job->contact_phone }}@endif</small>
                  </td>
                  <td>
                    @if($job->approval_status === 'approved')
                      Approved
                    @elseif($job->approval_status === 'pending')
                      Pending
                    @else
                      Rejected
                    @endif
                  </td>
                  <td>{{ $job->created_at->diffForHumans() }}</td>
                  <td>
                    @if($job->is_active ?? true)
                      Active
                    @else
                      Inactive
                    @endif
                  </td>
                  <td class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.jobs.review', $job->id) }}" class="btn btn-sm btn-primary" title="Review Job">
                      <i class="fas fa-search"></i>
                    </a>
                    <form action="{{ route('admin.jobs.delete', $job->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="mt-3">
          {{ $jobs->links() }}
        </div>
      @else
        <div class="text-center py-5">
          <i class="fas fa-briefcase" style="font-size: 4rem; color: #ccc;"></i>
          <p class="mt-3 text-muted">No jobs posted yet. Click "Post New Job" to create one.</p>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
