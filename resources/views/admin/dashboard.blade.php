 @extends('admin.layout')

@section('title', 'Admin Dashboard - MPSU Alumni Network')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h2>Admin Dashboard 👨‍💼</h2>
            <p class="text-muted">System overview and management controls</p>
        </div>
    </div>

    <!-- Statistics Row -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-left-primary">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="text-muted">Total Alumni</span>
                            <h3>{{ $totalAlumni }}</h3>
                            <small class="text-success">{{ $verifiedAlumni }} verified</small>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users" style="font-size: 2rem; color: var(--accent-gold); opacity: 1;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-left-secondary">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="text-muted">Active Job Postings</span>
                            <h3>{{ $totalJobs }}</h3>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase" style="font-size: 2rem; color: #d4af37; opacity: 1;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-left-success">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="text-muted">Total Events</span>
                            <h3>{{ $totalEvents }}</h3>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar" style="font-size: 2rem; color: #28a745; opacity: 1;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-left-warning">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="text-muted">Published News</span>
                            <h3>{{ $totalNews }}</h3>
                        </div>
                        <div class="col-auto">                            <i class="fas fa-newspaper" style="font-size: 2rem; color: #ff6b6b; opacity: 1;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card quick-actions">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Management Tools</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                            <a href="{{ route('admin.alumni-directory.index') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1"><i class="fas fa-users"></i> Alumni Management</h6>
                                    <small class="text-muted">Manage alumni accounts and verify users</small>
                                </div>
                                <span style="color: black; font-weight: 600;">{{ $totalAlumni }}</span>
                            </div>
                        </a>
                        <a href="{{ route('admin.jobs.index') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1"><i class="fas fa-briefcase"></i> Job Postings</h6>
                                    <small class="text-muted">Post and manage job opportunities</small>
                                </div>
                                <span style="color: black; font-weight: 600;">{{ $totalJobs }}</span>
                            </div>
                        </a>
                        <a href="{{ route('admin.events.index') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1"><i class="fas fa-calendar"></i> Events Management</h6>
                                    <small class="text-muted">Create and manage alumni events</small>
                                </div>
                                <span style="color: black; font-weight: 600;">{{ $totalEvents }}</span>
                            </div>
                        </a>
                        <a href="{{ route('admin.news.index') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1"><i class="fas fa-newspaper"></i> News & Announcements</h6>
                                    <small class="text-muted">Post news and announcements</small>
                                </div>
                                <span style="color: black; font-weight: 600;">{{ $totalNews }}</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.jobs.create') }}" class="btn btn-outline-primary quick-action-btn">
                            <i class="fas fa-plus"></i> Post New Job
                        </a>
                        <a href="{{ route('admin.events.create') }}" class="btn btn-outline-success quick-action-btn">
                            <i class="fas fa-plus"></i> Create New Event
                        </a>
                        <a href="{{ route('admin.news.create') }}" class="btn btn-outline-warning quick-action-btn">
                            <i class="fas fa-plus"></i> Post News Article
                        </a>
                        <a href="{{ route('admin.alumni-directory.index') }}" class="btn btn-outline-secondary quick-action-btn">
                            <i class="fas fa-list"></i> View All Alumni
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Recent Alumni Registrations</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentAlumni as $alumni)
                                <tr>
                                    <td>
                                        @php
                                            $displayName = implode(' ', array_filter([
                                                $alumni->alumniProfile->family_name ?? '',
                                                $alumni->alumniProfile->given_name ?? '',
                                                $alumni->alumniProfile->middle_initial ?? '',
                                                $alumni->alumniProfile->suffix ?? '',
                                            ]));
                                        @endphp
                                        {{ $displayName ?: $alumni->name }}
                                    </td>
                                    <td>{{ $alumni->email }}</td>
                                    <td>
                                        @if ($alumni->is_verified && $alumni->is_active)
                                            <span style="color: #28a745; font-weight: 600;"><i class="fas fa-circle" style="font-size: 0.5rem; margin-right: 0.5rem;"></i>Verified</span>
                                        @else
                                            <span style="color: #dc3545; font-weight: 600;"><i class="fas fa-circle" style="font-size: 0.5rem; margin-right: 0.5rem;"></i>Unverified</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Upcoming Events</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Event</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($upcomingEvents as $event)
                                <tr>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ $event->event_date->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $event->status }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .border-left-primary {
        border-left: 4px solid var(--primary-color);
    }
    .border-left-secondary {
        border-left: 4px solid var(--secondary-color);
    }
    .border-left-success {
        border-left: 4px solid var(--success-color);
    }
    .border-left-warning {
        border-left: 4px solid var(--warning-color);
    }
</style>
@endsection
