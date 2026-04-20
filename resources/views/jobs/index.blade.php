@extends('layouts.alumni')

@section('title', 'Jobs - MPSU Alumni Network')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h2><i class="fas fa-briefcase"></i> Job Opportunities</h2>
            <p class="text-muted">Explore career opportunities posted for our alumni</p>
        </div>
    </div>

    @if (!empty($verificationRequired) && $verificationRequired)
        <div class="alert alert-warning" role="alert">
            <strong>Verification required:</strong> Your account is pending approval. Please wait for admin verification before accessing job postings.
        </div>
    @else

    <div class="row mb-4">
        <div class="col-md-8">
            <form class="row g-3" method="GET" action="{{ route('jobs.index') }}">
                <div class="col-md-5">
                    <input type="text" class="form-control" name="search" placeholder="Search jobs..." value="{{ $search }}">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="company" placeholder="Company..." value="{{ $company }}">
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="position_type">
                        <option value="">All Types</option>
                        <option value="Full-time" {{ $position === 'Full-time' ? 'selected' : '' }}>Full-time</option>
                        <option value="Part-time" {{ $position === 'Part-time' ? 'selected' : '' }}>Part-time</option>
                        <option value="Contract" {{ $position === 'Contract' ? 'selected' : '' }}>Contract</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </form>
        </div>
        <div class="col-md-4 text-end d-flex align-items-start justify-content-end">
            <a href="{{ route('jobs.create') }}" class="btn btn-warning" style="font-weight:700; border-radius:8px; min-width:140px;"> <i class="fas fa-plus"></i> Post a Job</a>
        </div>
    </div>

    @if ($jobs->count() > 0)
        <div class="row">
            @foreach ($jobs as $job)
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $job->title }}</h5>
                                    <p class="text-muted mb-2">{{ $job->company_name }}</p>
                                    <p class="card-text small">{{ Str::limit($job->description, 150) }}</p>
                                    <div class="mt-2">
                                        <span class="badge bg-primary">{{ $job->position_type }}</span>
                                        <span class="badge bg-secondary">{{ $job->location }}</span>
                                        @if ($job->salary_min && $job->salary_max)
                                            <span class="badge bg-success">{{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }}</span>
                                        @endif
                                    </div>
                                    <div class="mt-2">
                                        <small><strong>Contact:</strong> {{ $job->contact_email }}
                                            @if($job->contact_phone) | {{ $job->contact_phone }} @endif
                                        </small>
                                    </div>
                                    <div class="mt-2">
                                        <small>
                                            <strong>Status:</strong>
                                            @if($job->approval_status === 'approved')
                                                <span class="badge bg-success">Approved</span>
                                            @elseif($job->approval_status === 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @else
                                                <span class="badge bg-danger">Rejected</span>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4 text-end">
                                    <p class="mb-2">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar"></i>
                                            Deadline: {{ $job->deadline->format('M d, Y') }}
                                        </small>
                                    </p>
                                    @if ($job->isExpired())
                                        <span class="badge bg-danger">Expired</span>
                                    @else
                                        <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-primary btn-sm">View Details</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $jobs->links() }}
    @else
        <div class="alert alert-info text-center py-5">
            <i class="fas fa-inbox fa-3x mb-3"></i>
            <p>No job postings found. Check back later!</p>
        </div>
    @endif
    @endif
</div>
@endsection
