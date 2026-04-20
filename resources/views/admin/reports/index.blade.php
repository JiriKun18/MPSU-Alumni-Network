@extends('admin.layout')
@section('title', 'Reports & Analytics')
@section('content')

<div class="container-fluid py-4">
    <div class="card" style="border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none; max-width: 900px; margin: 0 auto 2rem auto; overflow: hidden;">
        @if(isset($reportImage) && $reportImage)
            <img src="{{ asset('storage/' . $reportImage) }}" alt="Reports & Analytics" style="width:100%;height:220px;object-fit:cover;">
        @else
            <div style="width:100%;height:220px;background:linear-gradient(135deg,var(--primary-color) 0%,#1a6b3d 100%);display:flex;align-items:center;justify-content:center;">
                <i class="fas fa-chart-line fa-4x" style="color:rgba(255,255,255,0.3);"></i>
            </div>
        @endif
        <div class="card-body" style="background: #fff !important;">
            <h2 style="font-size: 2rem; font-weight: 900; color: var(--primary-color); margin: 0;">
                <i class="fas fa-chart-line"></i> Reports & Analytics
            </h2>
            <p style="color: #334155; font-size: 1.1rem; margin: 0.5rem 0 0 0;">Key metrics and analytics for MPSU Alumni Network</p>
        </div>
    </div>

    <!-- Key Metrics Row -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none; border-left: 4px solid var(--primary-color);">
                <div class="card-body">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p class="text-muted mb-2" style="font-size: 0.9rem;">Total Users</p>
                            <h3 style="color: var(--primary-color); font-weight: 800; margin: 0;">{{ $totalUsers }}</h3>
                        </div>
                        <i class="fas fa-users fa-3x" style="color: var(--primary-color); opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none; border-left: 4px solid #10b981;">
                <div class="card-body">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p class="text-muted mb-2" style="font-size: 0.9rem;">Active Alumni</p>
                            <h3 style="color: #10b981; font-weight: 800; margin: 0;">{{ $activeAlumni }}</h3>
                        </div>
                        <i class="fas fa-check-circle fa-3x" style="color: #10b981; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none; border-left: 4px solid #f59e0b;">
                <div class="card-body">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p class="text-muted mb-2" style="font-size: 0.9rem;">Job Postings</p>
                            <h3 style="color: #f59e0b; font-weight: 800; margin: 0;">{{ $totalJobs }}</h3>
                        </div>
                        <i class="fas fa-briefcase fa-3x" style="color: #f59e0b; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none; border-left: 4px solid #8b5cf6;">
                <div class="card-body">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p class="text-muted mb-2" style="font-size: 0.9rem;">Events</p>
                            <h3 style="color: #8b5cf6; font-weight: 800; margin: 0;">{{ $totalEvents }}</h3>
                        </div>
                        <i class="fas fa-calendar-alt fa-3x" style="color: #8b5cf6; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Metrics -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none;">
                <div class="card-header" style="background: white; border-bottom: 1px solid #e9ecef; padding: 1.5rem;">
                    <h5 style="margin: 0; font-weight: 700; color: var(--primary-color);">
                        <i class="fas fa-newspaper"></i> Content Statistics
                    </h5>
                </div>
                <div class="card-body">
                    <div style="margin-bottom: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span class="text-muted">News Articles</span>
                            <strong>{{ $totalNews }}</strong>
                        </div>
                        <div style="width: 100%; height: 8px; background: #e9ecef; border-radius: 4px; overflow: hidden;">
                            <div style="width: 100%; height: 100%; background: linear-gradient(90deg, var(--primary-color), #1a6b3d);"></div>
                        </div>
                    </div>
                    <div style="margin-bottom: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span class="text-muted">Job Applications</span>
                            <strong>{{ $jobApplications }}</strong>
                        </div>
                        <div style="width: 100%; height: 8px; background: #e9ecef; border-radius: 4px; overflow: hidden;">
                            <div style="width: 100%; height: 100%; background: linear-gradient(90deg, #f59e0b, #d97706);"></div>
                        </div>
                    </div>
                    <div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span class="text-muted">Event Registrations</span>
                            <strong>{{ $eventRegistrations }}</strong>
                        </div>
                        <div style="width: 100%; height: 8px; background: #e9ecef; border-radius: 4px; overflow: hidden;">
                            <div style="width: 100%; height: 100%; background: linear-gradient(90deg, #8b5cf6, #7c3aed);"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none;">
                <div class="card-header" style="background: white; border-bottom: 1px solid #e9ecef; padding: 1.5rem;">
                    <h5 style="margin: 0; font-weight: 700; color: var(--primary-color);">
                        <i class="fas fa-poll"></i> Survey Information
                    </h5>
                </div>
                <div class="card-body">
                    <div style="margin-bottom: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span class="text-muted">Active Surveys</span>
                            <strong>{{ $activeSurveys }}</strong>
                        </div>
                    </div>
                    <div style="margin-bottom: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span class="text-muted">Total Responses</span>
                            <strong>{{ $surveyResponses }}</strong>
                        </div>
                    </div>
                    <div style="margin-bottom: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span class="text-muted">Response Rate</span>
                            <strong>{{ $responseRate }}%</strong>
                        </div>
                        <div style="width: 100%; height: 8px; background: #e9ecef; border-radius: 4px; overflow: hidden;">
                            <div style="width: {{ $responseRate }}%; height: 100%; background: linear-gradient(90deg, #10b981, #059669);"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Status -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none;">
                <div class="card-header" style="background: white; border-bottom: 1px solid #e9ecef; padding: 1.5rem;">
                    <h5 style="margin: 0; font-weight: 700; color: var(--primary-color);">
                        <i class="fas fa-user-check"></i> User Status
                    </h5>
                </div>
                <div class="card-body">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <div style="padding: 1.5rem; background: #f0fdf4; border-radius: 12px; border-left: 4px solid #10b981;">
                            <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 0.5rem;">Verified Users</div>
                            <div style="font-size: 2rem; font-weight: 800; color: #10b981;">{{ $verifiedUsers }}</div>
                        </div>
                        <div style="padding: 1.5rem; background: #fef3c7; border-radius: 12px; border-left: 4px solid #f59e0b;">
                            <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 0.5rem;">Unverified Users</div>
                            <div style="font-size: 2rem; font-weight: 800; color: #f59e0b;">{{ $unverifiedUsers }}</div>
                        </div>
                        <div style="padding: 1.5rem; background: #fee2e2; border-radius: 12px; border-left: 4px solid #ef4444;">
                            <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 0.5rem;">Inactive Users</div>
                            <div style="font-size: 2rem; font-weight: 800; color: #ef4444;">{{ $inactiveUsers }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Options -->
    <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none;">
        <div class="card-header" style="background: white; border-bottom: 1px solid #e9ecef; padding: 1.5rem;">
            <h5 style="margin: 0; font-weight: 700; color: var(--primary-color);">
                <i class="fas fa-download"></i> Export Data
            </h5>
        </div>
        <div class="card-body">
            <p class="text-muted mb-3">Download reports in various formats for further analysis</p>
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="{{ route('admin.reports.export', 'csv') }}" class="btn" style="background: #10b981; color: white; border-radius: 8px; padding: 0.7rem 1.5rem; font-weight: 600;">
                    <i class="fas fa-file-csv"></i> Export as CSV
                </a>
                <a href="{{ route('admin.reports.export', 'json') }}" class="btn" style="background: #3b82f6; color: white; border-radius: 8px; padding: 0.7rem 1.5rem; font-weight: 600;">
                    <i class="fas fa-file-code"></i> Export as JSON
                </a>
                <a href="{{ route('admin.reports.export', 'pdf') }}" class="btn" style="background: #ef4444; color: white; border-radius: 8px; padding: 0.7rem 1.5rem; font-weight: 600;">
                    <i class="fas fa-file-pdf"></i> Export as PDF
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
