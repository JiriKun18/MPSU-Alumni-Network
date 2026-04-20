@extends('admin.layout')

@section('content')
<style>
    .profile-tabs {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid #e2e8f0;
        flex-wrap: wrap;
    }

    .tab-button {
        background: white;
        border: none;
        padding: 1rem 1.5rem;
        border-radius: 10px 10px 0 0;
        font-weight: 600;
        color: #64748b;
        cursor: pointer;
        transition: all 0.3s ease;
        border-bottom: 3px solid transparent;
    }

    .tab-button:hover {
        color: #2d5016;
        background: rgba(45, 80, 22, 0.05);
    }

    .tab-button.active {
        color: #1a472a;
        background: linear-gradient(135deg, rgba(26, 71, 42, 0.1) 0%, rgba(74, 124, 44, 0.1) 100%);
        border-bottom-color: #d4af37;
    }

    .tab-content-panel {
        display: none;
    }

    .tab-content-panel.active {
        display: block;
    }

    .profile-photo-circle {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%);
        border: 4px solid #d4af37;
        font-size: 4rem;
        font-weight: 700;
    }

    .section-icon {
        color: #2d5016;
    }

    .info-label {
        font-weight: 600;
        color: #1a472a;
        margin-bottom: 0.25rem;
    }
</style>

@php
    $displayName = $user->name;

    if ($user->alumniProfile && ($user->alumniProfile->family_name || $user->alumniProfile->given_name)) {
        $displayName = trim(preg_replace('/\s+/', ' ', sprintf(
            '%s, %s %s %s',
            $user->alumniProfile->family_name ?? '',
            $user->alumniProfile->given_name ?? '',
            $user->alumniProfile->middle_initial ?? '',
            $user->alumniProfile->suffix ?? ''
        )));
    }

    $displayInitial = strtoupper(substr($displayName, 0, 1));
@endphp

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                <div>
                    <a href="{{ route('admin.alumni-directory.index') }}" class="btn btn-secondary mb-3">
                        <i class="fas fa-arrow-left"></i> Back to Directory
                    </a>
                    <h1 class="display-6 fw-bold" style="color: #1a472a;">
                        <i class="fas fa-user-circle"></i> Full Alumni Profile
                    </h1>
                </div>
                <div class="d-flex gap-2">
                    @if (!$user->is_verified)
                        <form action="{{ route('admin.alumni-directory.verify', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success" style="border-radius: 8px; font-weight: 600;">
                                <i class="fas fa-check"></i> Verify
                            </button>
                        </form>
                        <form action="{{ route('admin.alumni-directory.deactivate', $user->id) }}" method="POST"
                            onsubmit="return confirm('Decline and deactivate {{ $displayName }}? This will prevent login until reactivated.')">
                            @csrf
                            <button type="submit" class="btn btn-warning" style="border-radius: 8px; font-weight: 600;">
                                <i class="fas fa-times"></i> Decline
                            </button>
                        </form>
                    @else
                        @if ($user->is_active)
                                <form action="{{ route('admin.alumni-directory.deactivate', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Deactivate {{ $displayName }}? This will prevent login until reactivated.')">
                                @csrf
                                <button type="submit" class="btn btn-warning" style="border-radius: 8px; font-weight: 600;">
                                    <i class="fas fa-user-slash"></i> Deactivate
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.alumni-directory.activate', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success" style="border-radius: 8px; font-weight: 600;">
                                    <i class="fas fa-user-check"></i> Verify
                                </button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Left Column: Profile Card -->
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4" style="border-radius: 12px; border-top: 4px solid #d4af37;">
                <div class="card-body text-center">
                    <div class="mb-3">
                        @if($user->alumniProfile && $user->alumniProfile->profile_picture)
                            <img src="{{ asset('storage/' . $user->alumniProfile->profile_picture) }}" 
                                 alt="{{ $displayName }}" 
                                 class="rounded-circle" 
                                 style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #d4af37;">
                        @else
                            <div class="profile-photo-circle text-white d-inline-flex align-items-center justify-content-center mx-auto">
                                {{ $displayInitial }}
                            </div>
                        @endif
                    </div>
                    
                    <h3 class="mb-2" style="color: #1a472a; font-weight: 700;">{{ $displayName }}</h3>
                    <p class="text-muted mb-1">{{ $user->email }}</p>
                    
                    <div class="mb-3">
                        <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }} me-1">
                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        <span class="badge" style="background: #d4af37; color: #1a472a;">
                            {{ $user->is_verified ? 'Verified' : 'Unverified' }}
                        </span>
                    </div>
                    
                    @if($user->alumniProfile)
                        @if($user->alumniProfile->current_position)
                            <p class="text-muted mb-1">
                                <i class="fas fa-briefcase section-icon"></i> {{ $user->alumniProfile->current_position }}
                            </p>
                        @endif
                        
                        @if($user->alumniProfile->current_company)
                            <p class="text-muted">
                                <i class="fas fa-building section-icon"></i> {{ $user->alumniProfile->current_company }}
                            </p>
                        @endif

                        @if($user->alumniProfile->employment_status)
                            <div class="mt-3">
                                @php
                                    $statusMap = [
                                        'employed' => ['bg-success', 'Employed'],
                                        'unemployed' => ['bg-danger', 'Unemployed'],
                                        'self-employed' => ['bg-warning', 'Self-Employed'],
                                        'contractual' => ['bg-info', 'Contractual']
                                    ];
                                    $status = $statusMap[$user->alumniProfile->employment_status] ?? ['bg-secondary', ucfirst(str_replace('-', ' ', $user->alumniProfile->employment_status))];
                                @endphp
                                <span class="badge {{ $status[0] }} fs-6 px-3 py-2">
                                    {{ $status[1] }}
                                </span>
                            </div>
                        @endif
                    @endif
                </div>
            </div>


            <!-- Verification Documents -->
            <div class="card shadow-sm mb-4" style="border-radius: 12px; border-top: 4px solid #d4af37;">
                <div class="card-header" style="background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(230, 199, 88, 0.1) 100%); border-bottom: 2px solid #d4af37;">
                    <h5 class="mb-0" style="color: #1a472a; font-weight: 600;">
                        <i class="fas fa-file-alt"></i> Verification Documents
                    </h5>
                </div>
                <div class="card-body">
                    @php
                        $verificationDocs = $user->alumniProfile->verification_documents ?? null;
                        if (is_string($verificationDocs)) {
                            $verificationDocs = json_decode($verificationDocs, true) ?? [];
                        }
                    @endphp
                    @if($user->alumniProfile && !empty($verificationDocs))
                        <ul class="mb-0">
                            @foreach ($verificationDocs as $doc)
                                <li>
                                    <a href="{{ asset('storage/' . $doc) }}" target="_blank" rel="noopener noreferrer">View document</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted mb-0">No verification documents uploaded.</p>
                    @endif
                </div>
            </div>

            <!-- Social Links -->
            @if($user->alumniProfile && ($user->alumniProfile->linkedin_url || $user->alumniProfile->facebook_url))
                <div class="card shadow-sm" style="border-radius: 12px; border-top: 4px solid #d4af37;">
                    <div class="card-header" style="background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(230, 199, 88, 0.1) 100%); border-bottom: 2px solid #d4af37;">
                        <h5 class="mb-0" style="color: #1a472a; font-weight: 600;">
                            <i class="fas fa-share-alt"></i> Social Links
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($user->alumniProfile->linkedin_url)
                            <a href="{{ $user->alumniProfile->linkedin_url }}" target="_blank" class="btn btn-outline-primary btn-sm w-100 mb-2">
                                <i class="fab fa-linkedin"></i> LinkedIn
                            </a>
                        @endif
                        @if($user->alumniProfile->facebook_url)
                            <a href="{{ $user->alumniProfile->facebook_url }}" target="_blank" class="btn btn-outline-primary btn-sm w-100">
                                <i class="fab fa-facebook"></i> Facebook
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Right Column: Tabbed Content -->
        <div class="col-lg-8">
            <!-- Tab Navigation -->
            <div class="profile-tabs">
                <button class="tab-button active" onclick="switchTab(event, 'academic')">
                    <i class="fas fa-graduation-cap"></i> Academic Information
                </button>
                <button class="tab-button" onclick="switchTab(event, 'personal')">
                    <i class="fas fa-user"></i> Personal Information
                </button>
                <button class="tab-button" onclick="switchTab(event, 'account')">
                    <i class="fas fa-briefcase"></i> Nature of Work
                </button>
                @if($user->jobApplications && $user->jobApplications->count() > 0)
                    <button class="tab-button" onclick="switchTab(event, 'jobs')">
                        <i class="fas fa-briefcase"></i> Job Applications ({{ $user->jobApplications->count() }})
                    </button>
                @endif
                @if($user->eventRegistrations && $user->eventRegistrations->count() > 0)
                    <button class="tab-button" onclick="switchTab(event, 'events')">
                        <i class="fas fa-calendar-check"></i> Events ({{ $user->eventRegistrations->count() }})
                    </button>
                @endif
            </div>

            <!-- Academic Information Tab -->
            <div id="academic" class="tab-content-panel active">
                <div class="card shadow-sm" style="border-radius: 12px; border-top: 4px solid #2d5016;">
                    <div class="card-header" style="background: linear-gradient(135deg, rgba(45, 80, 22, 0.1) 0%, rgba(74, 124, 44, 0.1) 100%); border-bottom: 2px solid #d4af37;">
                        <h5 class="mb-0" style="color: #1a472a; font-weight: 600;">
                            <i class="fas fa-graduation-cap"></i> Academic Information
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($user->alumniProfile)
                            <div class="row">
                                @if($user->alumniProfile->campus)
                                    <div class="col-md-4 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-university section-icon"></i> Campus:
                                        </div>
                                        <p class="mb-0">{{ $user->alumniProfile->campus }}</p>
                                    </div>
                                @endif
                                @if($user->alumniProfile->course_graduated)
                                    <div class="col-md-4 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-book section-icon"></i> Course:
                                        </div>
                                        <p class="mb-0">{{ $user->alumniProfile->course_graduated }}</p>
                                    </div>
                                @endif
                                @if($user->alumniProfile->year_graduated)
                                    <div class="col-md-4 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-calendar section-icon"></i> Year Graduated:
                                        </div>
                                        <p class="mb-0">{{ $user->alumniProfile->year_graduated }}</p>
                                    </div>
                                @endif
                            </div>
                        @else
                            <p class="text-muted">No academic information available.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Personal Information Tab -->
            <div id="personal" class="tab-content-panel">
                <div class="card shadow-sm" style="border-radius: 12px; border-top: 4px solid #2d5016;">
                    <div class="card-header" style="background: linear-gradient(135deg, rgba(45, 80, 22, 0.1) 0%, rgba(74, 124, 44, 0.1) 100%); border-bottom: 2px solid #d4af37;">
                        <h5 class="mb-0" style="color: #1a472a; font-weight: 600;">
                            <i class="fas fa-user"></i> Personal Information
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($user->alumniProfile)
                            <div class="row">
                                <!-- Name Fields -->
                                @if($user->alumniProfile->family_name || $user->alumniProfile->given_name)
                                    <div class="col-md-6 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-user section-icon"></i> Full Name:
                                        </div>
                                        <p class="mb-0">
                                            {{ $user->alumniProfile->family_name }}, {{ $user->alumniProfile->given_name }} 
                                            {{ $user->alumniProfile->middle_initial }} {{ $user->alumniProfile->suffix }}
                                        </p>
                                    </div>
                                @else
                                    <div class="col-md-6 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-user section-icon"></i> Full Name:
                                        </div>
                                        <p class="mb-0">{{ $displayName }}</p>
                                    </div>
                                @endif
                                
                                <!-- Sex/Gender -->
                                @if($user->alumniProfile->sex || $user->alumniProfile->gender)
                                    <div class="col-md-6 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-venus-mars section-icon"></i> Sex:
                                        </div>
                                        <p class="mb-0">{{ $user->alumniProfile->sex ?? $user->alumniProfile->gender }}</p>
                                    </div>
                                @endif
                                
                                <!-- Date of Birth -->
                                @if($user->alumniProfile->date_of_birth)
                                    <div class="col-md-6 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-birthday-cake section-icon"></i> Date of Birth:
                                        </div>
                                        <p class="mb-0">{{ $user->alumniProfile->date_of_birth->format('F d, Y') }}</p>
                                    </div>
                                @endif
                                
                                <!-- Student ID -->
                                @if($user->alumniProfile->student_id)
                                    <div class="col-md-6 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-id-card section-icon"></i> Student ID:
                                        </div>
                                        <p class="mb-0">{{ $user->alumniProfile->student_id }}</p>
                                    </div>
                                @endif
                                
                                <!-- Present Address -->
                                @php
                                    $addressParts = array_filter([
                                        $user->alumniProfile->present_address,
                                        $user->alumniProfile->present_barangay,
                                        $user->alumniProfile->present_city,
                                        $user->alumniProfile->present_province,
                                        $user->alumniProfile->present_region,
                                        $user->alumniProfile->present_country,
                                    ]);
                                @endphp
                                @if(count($addressParts) > 0)
                                    <div class="col-md-12 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-map-marker-alt section-icon"></i> Present Address:
                                        </div>
                                        <p class="mb-0">
                                            {{ implode(', ', $addressParts) }}
                                        </p>
                                    </div>
                                @elseif($user->alumniProfile->address || $user->alumniProfile->city || $user->alumniProfile->province)
                                    <div class="col-md-12 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-map-marker-alt section-icon"></i> Current Address:
                                        </div>
                                        <p class="mb-0">{{ implode(', ', array_filter([$user->alumniProfile->address, $user->alumniProfile->city, $user->alumniProfile->province])) }}</p>
                                    </div>
                                @endif
                                
                                <!-- Permanent Address -->
                                @if($user->alumniProfile->same_as_present == 'yes')
                                    <div class="col-md-12 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-home section-icon"></i> Permanent Address:
                                        </div>
                                        <p class="mb-0 text-muted">Same as present address</p>
                                    </div>
                                @elseif($user->alumniProfile->permanent_address)
                                    <div class="col-md-12 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-home section-icon"></i> Permanent Address:
                                        </div>
                                        <p class="mb-0">
                                            {{ $user->alumniProfile->permanent_address }}
                                            @if($user->alumniProfile->permanent_country)
                                                , {{ $user->alumniProfile->permanent_country }}
                                            @endif
                                        </p>
                                    </div>
                                @endif
                                
                                <!-- Bio -->
                                @if($user->alumniProfile->bio)
                                    <div class="col-md-12 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-quote-left section-icon"></i> Bio:
                                        </div>
                                        <p class="mb-0">{{ $user->alumniProfile->bio }}</p>
                                    </div>
                                @endif
                            </div>
                        @else
                            <p class="text-muted">No personal information available.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Account Information Tab -->
            <div id="account" class="tab-content-panel">
                <div class="card shadow-sm" style="border-radius: 12px; border-top: 4px solid #d4af37;">
                    <div class="card-header" style="background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(230, 199, 88, 0.1) 100%); border-bottom: 2px solid #d4af37;">
                        <h5 class="mb-0" style="color: #1a472a; font-weight: 600;">
                            <i class="fas fa-briefcase"></i> Nature of Work / Occupation
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($user->alumniProfile)
                            <div class="row">
                                <!-- Occupation Type -->
                                @if($user->alumniProfile->occupation_type)
                                    <div class="col-md-6 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-user-tie section-icon"></i> Occupation Type:
                                        </div>
                                        <p class="mb-0">{{ $user->alumniProfile->occupation_type }}</p>
                                    </div>
                                @endif
                                
                                <!-- Employment Type -->
                                @if($user->alumniProfile->employment_type)
                                    <div class="col-md-6 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-building section-icon"></i> Employment Type:
                                        </div>
                                        <p class="mb-0">{{ $user->alumniProfile->employment_type }}</p>
                                    </div>
                                @endif
                                
                                <!-- Job Position -->
                                @if($user->alumniProfile->job_position)
                                    <div class="col-md-6 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-id-badge section-icon"></i> Job Position/Title:
                                        </div>
                                        <p class="mb-0">{{ $user->alumniProfile->job_position }}</p>
                                    </div>
                                @elseif($user->alumniProfile->current_position)
                                    <div class="col-md-6 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-id-badge section-icon"></i> Current Position:
                                        </div>
                                        <p class="mb-0">{{ $user->alumniProfile->current_position }}</p>
                                    </div>
                                @endif
                                
                                <!-- Company Name -->
                                @if($user->alumniProfile->company_name)
                                    <div class="col-md-6 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-building section-icon"></i> Company/Agency/Business Name:
                                        </div>
                                        <p class="mb-0">{{ $user->alumniProfile->company_name }}</p>
                                    </div>
                                @elseif($user->alumniProfile->current_company)
                                    <div class="col-md-6 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-building section-icon"></i> Current Company:
                                        </div>
                                        <p class="mb-0">{{ $user->alumniProfile->current_company }}</p>
                                    </div>
                                @endif
                                
                                <!-- Company Address -->
                                @if($user->alumniProfile->company_address)
                                    <div class="col-md-12 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-map-marker-alt section-icon"></i> Company/Agency/Business Address:
                                        </div>
                                        <p class="mb-0">
                                            {{ $user->alumniProfile->company_address }}
                                            @if($user->alumniProfile->company_country)
                                                , {{ $user->alumniProfile->company_country }}
                                            @endif
                                        </p>
                                    </div>
                                @endif
                                
                                <!-- Proof of Employment -->
                                @if($user->alumniProfile->proof_of_employment)
                                    <div class="col-md-12 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-file-image section-icon"></i> Proof of Employment:
                                        </div>
                                        <div style="margin-top: 0.5rem;">
                                            <img src="{{ asset('storage/' . $user->alumniProfile->proof_of_employment) }}" 
                                                 alt="Proof of Employment" 
                                                 style="max-width: 100%; max-height: 500px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Employment Status -->
                                @if($user->alumniProfile->employment_status)
                                    <div class="col-md-6 mb-3">
                                        <div class="info-label">
                                            <i class="fas fa-briefcase section-icon"></i> Employment Status:
                                        </div>
                                        <p class="mb-0">{{ ucfirst($user->alumniProfile->employment_status) }}</p>
                                    </div>
                                @endif
                            </div>
                            
                            @if(!$user->alumniProfile->occupation_type && !$user->alumniProfile->employment_type && !$user->alumniProfile->job_position && !$user->alumniProfile->company_name && !$user->alumniProfile->employment_status)
                                <p class="text-muted">No employment/occupation information available.</p>
                            @endif
                        @else
                            <p class="text-muted">No nature of work information available.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Job Applications Tab -->
            @if($user->jobApplications && $user->jobApplications->count() > 0)
                <div id="jobs" class="tab-content-panel">
                    <div class="card shadow-sm" style="border-radius: 12px; border-top: 4px solid #d4af37;">
                        <div class="card-header" style="background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(230, 199, 88, 0.1) 100%); border-bottom: 2px solid #d4af37;">
                            <h5 class="mb-0" style="color: #1a472a; font-weight: 600;">
                                <i class="fas fa-briefcase"></i> Job Applications ({{ $user->jobApplications->count() }})
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead style="background: linear-gradient(135deg, rgba(26, 71, 42, 0.05) 0%, rgba(74, 124, 44, 0.05) 100%);">
                                        <tr>
                                            <th>Job Title</th>
                                            <th>Applied On</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->jobApplications as $application)
                                            <tr>
                                                <td>{{ $application->jobPosting->title ?? 'N/A' }}</td>
                                                <td>{{ $application->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $application->status === 'approved' ? 'success' : ($application->status === 'rejected' ? 'danger' : 'warning') }}">
                                                        {{ ucfirst($application->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Event Registrations Tab -->
            @if($user->eventRegistrations && $user->eventRegistrations->count() > 0)
                <div id="events" class="tab-content-panel">
                    <div class="card shadow-sm" style="border-radius: 12px; border-top: 4px solid #d4af37;">
                        <div class="card-header" style="background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(230, 199, 88, 0.1) 100%); border-bottom: 2px solid #d4af37;">
                            <h5 class="mb-0" style="color: #1a472a; font-weight: 600;">
                                <i class="fas fa-calendar-check"></i> Event Registrations ({{ $user->eventRegistrations->count() }})
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead style="background: linear-gradient(135deg, rgba(26, 71, 42, 0.05) 0%, rgba(74, 124, 44, 0.05) 100%);">
                                        <tr>
                                            <th>Event Title</th>
                                            <th>Registered On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->eventRegistrations as $registration)
                                            <tr>
                                                <td>{{ $registration->event->title ?? 'N/A' }}</td>
                                                <td>{{ $registration->created_at->format('M d, Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function switchTab(event, tabId) {
    // Hide all tab content
    const allPanels = document.querySelectorAll('.tab-content-panel');
    allPanels.forEach(panel => panel.classList.remove('active'));
    
    // Remove active class from all buttons
    const allButtons = document.querySelectorAll('.tab-button');
    allButtons.forEach(button => button.classList.remove('active'));
    
    // Show selected tab
    document.getElementById(tabId).classList.add('active');
    event.currentTarget.classList.add('active');
}
</script>
@endsection
