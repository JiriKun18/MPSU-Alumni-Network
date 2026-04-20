@extends('admin.layout')

@section('title', 'System Reports - MPSU Alumni Network')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h2><i class="fas fa-file-chart-bar"></i> System Reports</h2>
        <p class="text-muted">Comprehensive analytics and statistics</p>
    </div>
</div>

<!-- Key Statistics -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <h3>{{ $totalAlumni }}</h3>
                <p><i class="fas fa-users"></i> Total Alumni</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <h3 style="color: var(--success-color);">{{ $verifiedAlumni }}</h3>
                <p><i class="fas fa-check-circle"></i> Verified Alumni</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <h3 style="color: var(--warning-color);">{{ $unverifiedAlumni }}</h3>
                <p><i class="fas fa-hourglass-half"></i> Unverified Alumni</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <h3 style="color: var(--accent-gold);">{{ number_format(($verifiedAlumni / max($totalAlumni, 1)) * 100, 1) }}%</h3>
                <p><i class="fas fa-chart-pie"></i> Verification Rate</p>
            </div>
        </div>
    </div>
</div>

<!-- Content Statistics -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-briefcase"></i> Job Postings
            </div>
            <div class="card-body">
                <h3>{{ $totalJobs }}</h3>
                <p class="text-muted">Active Job Opportunities</p>
                <a href="{{ route('admin.jobs.index') }}" class="btn btn-sm btn-outline-primary mt-3">
                    View Jobs
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-calendar-alt"></i> Events
            </div>
            <div class="card-body">
                <h3>{{ $totalEvents }}</h3>
                <p class="text-muted">Total Events Created</p>
                <a href="{{ route('admin.events.index') }}" class="btn btn-sm btn-outline-primary mt-3">
                    View Events
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-newspaper"></i> News & Announcements
            </div>
            <div class="card-body">
                <h3>{{ $totalNews }}</h3>
                <p class="text-muted">Published Articles</p>
                <hr>
                <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-outline-primary">
                    View News
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Report Tables -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-table"></i> Summary Report
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Count</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><i class="fas fa-users"></i> Alumni Members</td>
                            <td><strong>{{ $totalAlumni }}</strong></td>
                            <td>
                                <span class="badge badge-primary">{{ $verifiedAlumni }} Verified</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.alumni-directory.index') }}" class="btn btn-sm btn-outline-primary">
                                    Manage
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-briefcase"></i> Job Postings</td>
                            <td><strong>{{ $totalJobs }}</strong></td>
                            <td>
                            </td>
                            <td>
                                <a href="{{ route('admin.jobs.index') }}" class="btn btn-sm btn-outline-primary">
                                    View
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-calendar-alt"></i> Events</td>
                            <td><strong>{{ $totalEvents }}</strong></td>
                            <td>
                            </td>
                            <td>
                                <a href="{{ route('admin.events.index') }}" class="btn btn-sm btn-outline-primary">
                                    View
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-newspaper"></i> News Articles</td>
                            <td><strong>{{ $totalNews }}</strong></td>
                            <td>
                                <span class="badge badge-warning">Published</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-outline-primary">
                                    View
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> System Overview
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <strong>Total Registered Alumni:</strong>
                        <span class="badge badge-primary float-end">{{ $totalAlumni }}</span>
                    </li>
                    <li class="mb-3">
                        <strong>Verified Accounts:</strong>
                        <span class="badge badge-success float-end">{{ $verifiedAlumni }}</span>
                    </li>
                    <li class="mb-3">
                        <strong>Pending Verification:</strong>
                        <span class="badge badge-warning float-end">{{ $unverifiedAlumni }}</span>
                    </li>
                    <li class="mb-3">
                        <strong>Active Job Opportunities:</strong>
                        <span class="badge badge-primary float-end">{{ $totalJobs }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>


</div>

<style>
    .border-left-primary {
        border-left: 4px solid var(--primary-color) !important;
    }

    .border-left-gold {
        border-left: 4px solid var(--accent-gold) !important;
    }

    .border-left-success {
        border-left: 4px solid var(--success-color) !important;
    }

    .border-left-warning {
        border-left: 4px solid var(--accent-yellow) !important;
    }
</style>
@endsection
