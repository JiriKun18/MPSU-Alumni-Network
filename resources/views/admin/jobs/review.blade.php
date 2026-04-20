@extends('admin.layout')
@section('title','Review Job Posting')
@section('content')
<div class="container-fluid py-4">
  <div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.jobs.index') }}" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i> Back to Jobs
    </a>
    <div>
      <h1 class="mb-1" style="font-size: 2rem; font-weight: 800; color: var(--admin-primary);">
        <i class="fas fa-search"></i> Review Job Posting
      </h1>
      <p class="text-muted mb-0">Verify job details before approving or rejecting.</p>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-lg-4">
      <div class="card" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
        <div class="card-header" style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">
          <h5 class="mb-0"><i class="fas fa-user"></i> Posted By</h5>
        </div>
        <div class="card-body">
          @if($poster)
            <p class="mb-1"><strong>Name:</strong> {{ $poster->name }}</p>
            <p class="mb-1"><strong>Email:</strong> {{ $poster->email }}</p>
            @if($poster->contact_number)
              <p class="mb-1"><strong>Phone:</strong> {{ $poster->contact_number }}</p>
            @endif
            <p class="mb-0"><strong>Role:</strong> {{ ucfirst($poster->role) }}</p>
          @else
            <p class="text-muted mb-0">Poster information not available.</p>
          @endif
        </div>
      </div>

      <div class="card mt-4" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
        <div class="card-header" style="background: #f8f9fa;">
          <h6 class="mb-0"><i class="fas fa-balance-scale"></i> Review Actions</h6>
        </div>
        <div class="card-body">
          <div class="d-flex gap-2 mb-2">
            @if($job->approval_status === 'approved')
              <form action="{{ route('admin.jobs.disable', $job->id) }}" method="POST" class="flex-fill">
                @csrf
                <button type="submit" class="btn btn-secondary w-100" title="Disable approved job to allow editing">
                  <i class="fas fa-ban"></i> Disable
                </button>
              </form>
              <button type="button" class="btn btn-warning w-100" disabled title="Disable the job to edit">
                <i class="fas fa-edit"></i> Edit Job
              </button>
            @else
              <a href="{{ route('admin.jobs.edit', $job->id) }}" class="btn btn-warning w-100">
                <i class="fas fa-edit"></i> Edit Job
              </a>
            @endif
          </div>
          <div class="d-flex gap-2">
            <form action="{{ route('admin.jobs.approve', $job->id) }}" method="POST" class="flex-fill">
              @csrf
              <button type="submit" class="btn btn-success w-100">
                <i class="fas fa-check"></i> Approve
              </button>
            </form>
            <form action="{{ route('admin.jobs.reject', $job->id) }}" method="POST" class="flex-fill">
              @csrf
              <button type="submit" class="btn btn-danger w-100">
                <i class="fas fa-times"></i> Decline
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-8">
      <div class="card" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
        <div class="card-body">
          <h3 class="mb-1">{{ $job->title }}</h3>
          <p class="text-muted mb-3">{{ $job->company_name }}</p>

          <div class="mb-3">
            <span class="badge bg-info">{{ $job->position_type }}</span>
            <span class="badge bg-secondary">{{ $job->location }}</span>
            @if ($job->salary_min && $job->salary_max)
              <span class="badge bg-success">₱{{ number_format($job->salary_min) }} - ₱{{ number_format($job->salary_max) }}</span>
            @endif
          </div>

          <div class="row mb-3">
            <div class="col-md-6"><strong>Posted:</strong> {{ $job->created_at->format('M d, Y') }}</div>
            <div class="col-md-6"><strong>Deadline:</strong> {{ $job->deadline->format('M d, Y') }}</div>
          </div>

          <hr>

          <h5>Job Description</h5>
          <div class="mb-4">
            {!! nl2br(e($job->description)) !!}
          </div>

          @if ($job->requirements)
            <h5>Requirements</h5>
            <div class="mb-4">
              {!! nl2br(e($job->requirements)) !!}
            </div>
          @endif

          <h5>Contact Information</h5>
          <ul class="list-unstyled mb-0">
            <li><strong>Email:</strong> {{ $job->contact_email }}</li>
            @if($job->contact_phone)
              <li><strong>Phone:</strong> {{ $job->contact_phone }}</li>
            @endif
            @if($job->contact_website)
              <li><strong>Website:</strong> <a href="{{ $job->contact_website }}" target="_blank">{{ $job->contact_website }}</a></li>
            @endif
            @if($job->contact_address)
              <li><strong>Address:</strong> {{ $job->contact_address }}</li>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
