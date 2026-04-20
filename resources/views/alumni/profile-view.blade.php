@extends('layout')

@section('content')
<div class="container my-5">
    @if (!empty($verificationRequired) && $verificationRequired)
        <div class="alert alert-warning" role="alert">
            <strong>Verification required:</strong> Please wait for admin approval before accessing alumni profiles.
        </div>
    @else
    <div class="row">
        <!-- Profile Structure: Photo, Name, Course, Batch/Year, Address, Contact -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm" style="border-radius: 12px; border-top: 4px solid #2d5016;">
                <div class="card-body text-center">
                    <!-- Photo -->
                    <div class="mb-3">
                        @if($user->alumniProfile && $user->alumniProfile->profile_picture)
                            <img src="{{ asset('storage/' . $user->alumniProfile->profile_picture) }}" 
                                 alt="{{ $user->name }}" 
                                 class="rounded-circle" 
                                 style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #2d5016;">
                        @else
                            <img src="{{ asset('images/logo_mpsu.png') }}" 
                                 alt="{{ $user->name }}" 
                                 class="rounded-circle" 
                                 style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #d4af37;">
                        @endif
                    </div>
                    <!-- Name -->
                    <h3 class="mb-2" style="color: #1a472a; font-weight: 700;">{{ $user->name }}</h3>
                    <!-- Course -->
                    @if($user->alumniProfile && $user->alumniProfile->course)
                        <div class="mb-1">
                            <i class="fas fa-book" style="color: #2d5016;"></i> {{ $user->alumniProfile->course }}
                        </div>
                    @endif
                    <!-- Batch/Year -->
                    @if($user->alumniProfile && $user->alumniProfile->batch)
                        <div class="mb-1">
                            <i class="fas fa-graduation-cap" style="color: #2d5016;"></i> {{ $user->alumniProfile->batch->year }}
                        </div>
                    @endif
                    <!-- Address (Privacy-aware) -->
                    @php
                        $presentLine1 = $user->alumniProfile
                            ? implode(', ', array_filter([
                                $user->alumniProfile->present_address,
                                $user->alumniProfile->present_barangay,
                                $user->alumniProfile->present_city,
                                $user->alumniProfile->present_province,
                                $user->alumniProfile->present_region,
                            ]))
                            : '';
                        $presentLine2 = $user->alumniProfile->present_postal_code ?? '';
                        $presentLine3 = $user->alumniProfile->present_country ?? '';
                        $presentFullAddress = implode(', ', array_filter([$presentLine1, $presentLine2, $presentLine3]));
                    @endphp
                    @if($user->alumniProfile && ($user->alumniProfile->show_present_address ?? true) && $presentFullAddress)
                        <div class="mb-1">
                            <i class="fas fa-map-marker-alt" style="color: #2d5016;"></i>
                            <span>
                                @if($presentLine1)
                                    {{ $presentLine1 }}<br>
                                @endif
                                @if($presentLine2)
                                    {{ $presentLine2 }}<br>
                                @endif
                                @if($presentLine3)
                                    {{ $presentLine3 }}
                                @endif
                            </span>
                        </div>
                    @endif
                    <!-- Contact (Email, Phone, Facebook) - Privacy-aware -->
                    <div class="mb-1">
                        @if($user->alumniProfile && ($user->alumniProfile->show_email ?? true))
                            <i class="fas fa-envelope" style="color: #2d5016;"></i> {{ $user->email }}<br>
                        @endif
                        @if($user->alumniProfile && $user->alumniProfile->phone && ($user->alumniProfile->show_phone ?? true))
                            <i class="fas fa-phone" style="color: #2d5016;"></i> {{ $user->alumniProfile->phone }}<br>
                        @endif
                        @if($user->alumniProfile && $user->alumniProfile->facebook_url)
                            <i class="fab fa-facebook" style="color: #2d5016;"></i> 
                            <a href="{{ $user->alumniProfile->facebook_url }}" target="_blank">Facebook</a>
                        @endif
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="window.history.back()">
                        <i class="fa-solid fa-arrow-left-long"></i> Back
                    </button>
                </div>
            </div>
        </div>

        <!-- Right Content -->
        <div class="col-lg-8">
            <!-- Basic Information -->
            <div class="card shadow-sm mb-4" style="border-radius: 12px; border-top: 4px solid #2d5016;">
                <div class="card-header" style="background: linear-gradient(135deg, rgba(45, 80, 22, 0.05) 0%, rgba(74, 124, 44, 0.05) 100%); border-bottom: 2px solid #d4af37;">
                    <h5 class="mb-0" style="color: #1a472a; font-weight: 600;">
                        <i class="fas fa-info-circle"></i> Basic Information
                    </h5>
                </div>
                <div class="card-body">
                    @if($user->alumniProfile)
                        <div class="row">
                            @if($user->alumniProfile->batch)
                                <div class="col-md-6 mb-3">
                                    <strong><i class="fas fa-graduation-cap" style="color: #2d5016;"></i> Batch:</strong>
                                    <p class="mb-0">{{ $user->alumniProfile->batch->year }}</p>
                                </div>
                            @endif
                            
                            @if($user->alumniProfile->course)
                                <div class="col-md-6 mb-3">
                                    <strong><i class="fas fa-book" style="color: #2d5016;"></i> Course:</strong>
                                    <p class="mb-0">{{ $user->alumniProfile->course }}</p>
                                </div>
                            @endif
                            
                            @if(($user->alumniProfile->show_present_address ?? true) && $presentFullAddress)
                                <div class="col-md-6 mb-3">
                                    <strong><i class="fas fa-map-marker-alt" style="color: #2d5016;"></i> Location:</strong>
                                    <p class="mb-0">
                                        @if($presentLine1)
                                            {{ $presentLine1 }}<br>
                                        @endif
                                        @if($presentLine2)
                                            {{ $presentLine2 }}<br>
                                        @endif
                                        @if($presentLine3)
                                            {{ $presentLine3 }}
                                        @endif
                                    </p>
                                </div>
                            @endif
                        </div>
                    @else
                        <p class="text-muted">Profile information not available.</p>
                    @endif
                </div>
            </div>

            <!-- Employment Information -->
            @if($user->alumniProfile && ($user->alumniProfile->show_occupation ?? true) && ($user->alumniProfile->current_position || $user->alumniProfile->current_company || $user->alumniProfile->employment_status))
                <div class="card shadow-sm mb-4" style="border-radius: 12px; border-top: 4px solid #d4af37;">
                    <div class="card-header" style="background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(230, 199, 88, 0.1) 100%); border-bottom: 2px solid #d4af37;">
                        <h5 class="mb-0" style="color: #1a472a; font-weight: 600;">
                            <i class="fas fa-briefcase"></i> Employment Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if($user->alumniProfile && $user->alumniProfile->current_position)
                                <div class="col-md-6 mb-3">
                                    <strong><i class="fas fa-id-card" style="color: #d4af37;"></i> Current Position:</strong>
                                    <p class="mb-0">{{ $user->alumniProfile->current_position }}</p>
                                </div>
                            @endif
                            
                            @if($user->alumniProfile && $user->alumniProfile->current_company)
                                <div class="col-md-6 mb-3">
                                    <strong><i class="fas fa-building" style="color: #d4af37;"></i> Current Company:</strong>
                                    <p class="mb-0">{{ $user->alumniProfile->current_company }}</p>
                                </div>
                            @endif

                            @if($user->alumniProfile && $user->alumniProfile->employment_status)
                                <div class="col-md-6 mb-3">
                                    <strong><i class="fas fa-work" style="color: #d4af37;"></i> Employment Status:</strong>
                                    @php
                                        $statusMap = [
                                            'employed' => 'Employed',
                                            'unemployed' => 'Unemployed',
                                            'self-employed' => 'Self-Employed',
                                            'contractual' => 'Contractual'
                                        ];
                                    @endphp
                                    <p class="mb-0"><span class="badge bg-success">{{ $statusMap[$user->alumniProfile->employment_status] ?? ucfirst(str_replace('-', ' ', $user->alumniProfile->employment_status)) }}</span></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Personal Information -->
            @if($user->alumniProfile && (((($user->alumniProfile->show_birthdate ?? true) && $user->alumniProfile->date_of_birth)) || $user->alumniProfile->gender))
                <div class="card shadow-sm mb-4" style="border-radius: 12px; border-top: 4px solid #2d5016;">
                    <div class="card-header" style="background: linear-gradient(135deg, rgba(45, 80, 22, 0.05) 0%, rgba(74, 124, 44, 0.05) 100%); border-bottom: 2px solid #d4af37;">
                        <h5 class="mb-0" style="color: #1a472a; font-weight: 600;">
                            <i class="fas fa-user"></i> Personal Details
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if($user->alumniProfile && ($user->alumniProfile->show_birthdate ?? true) && $user->alumniProfile->date_of_birth)
                                <div class="col-md-6 mb-3">
                                    <strong><i class="fas fa-calendar" style="color: #2d5016;"></i> Date of Birth:</strong>
                                    <p class="mb-0">{{ $user->alumniProfile->date_of_birth ? $user->alumniProfile->date_of_birth->format('F d, Y') : 'N/A' }}</p>
                                </div>
                            @endif
                            
                            @if($user->alumniProfile && $user->alumniProfile->gender)
                                <div class="col-md-6 mb-3">
                                    <strong><i class="fas fa-mars-stroke-v" style="color: #2d5016;"></i> Gender:</strong>
                                    <p class="mb-0">{{ ucfirst($user->alumniProfile->gender) }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- About Section -->
            @if($user->alumniProfile && $user->alumniProfile->bio)
                <div class="card shadow-sm" style="border-radius: 12px; border-top: 4px solid #d4af37;">
                    <div class="card-header" style="background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(230, 199, 88, 0.1) 100%); border-bottom: 2px solid #d4af37;">
                        <h5 class="mb-0" style="color: #1a472a; font-weight: 600;">
                            <i class="fas fa-pen-fancy"></i> About
                        </h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $user->alumniProfile->bio }}</p>
                    </div>
                </div>
            @endif
            <!-- Latest Events, Jobs, and News for Alumni -->
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card shadow-sm mb-4" style="border-radius: 12px; border-top: 4px solid var(--accent-gold);">
                        <div class="card-header" style="background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(230, 199, 88, 0.1) 100%); border-bottom: 2px solid var(--accent-gold);">
                            <h5 class="mb-0" style="color: #1a472a; font-weight: 700;">
                                <i class="fas fa-calendar-check"></i> Latest Events
                            </h5>
                        </div>
                        <div class="card-body">
                            @php
                                $allEvents = \App\Models\Event::where('event_date', '>=', now())
                                    ->orderBy('event_date', 'asc')
                                    ->get();
                            @endphp
                            @if($allEvents->count() > 0)
                                <ul class="list-group list-group-flush">
                                    @foreach($allEvents as $event)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $event->title }}</strong><br>
                                            <small><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</small>
                                            @if($event->location)
                                                <br><small><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</small>
                                            @endif
                                        </div>
                                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                    </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted mb-0">No upcoming events.</p>
                            @endif
                        </div>
                    </div>

                    <div class="card shadow-sm mb-4" style="border-radius: 12px; border-top: 4px solid var(--accent-gold);">
                        <div class="card-header" style="background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(230, 199, 88, 0.1) 100%); border-bottom: 2px solid var(--accent-gold);">
                            <h5 class="mb-0" style="color: #1a472a; font-weight: 700;">
                                <i class="fas fa-briefcase"></i> Latest Job Opportunities
                            </h5>
                        </div>
                        <div class="card-body">
                            @php
                                $allJobs = \App\Models\JobPosting::where('is_active', true)
                                    ->where('approval_status', 'approved')
                                    ->orderBy('created_at', 'desc')
                                    ->get();
                            @endphp
                            @if(!auth()->user()->is_verified)
                                <div class="alert alert-warning mb-0">
                                    <i class="fas fa-clock"></i> Your account is pending approval. Job listings will be available once verified.
                                </div>
                            @elseif($allJobs->count() > 0)
                                <ul class="list-group list-group-flush">
                                    @foreach($allJobs as $job)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $job->job_title }}</strong><br>
                                            <small><i class="fas fa-building"></i> {{ $job->company_name }}</small>
                                            @if($job->location)
                                                <br><small><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</small>
                                            @endif
                                        </div>
                                        <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                    </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted mb-0">No job postings available.</p>
                            @endif
                        </div>
                    </div>

                    <div class="card shadow-sm mb-4" style="border-radius: 12px; border-top: 4px solid var(--accent-gold);">
                        <div class="card-header" style="background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(230, 199, 88, 0.1) 100%); border-bottom: 2px solid var(--accent-gold);">
                            <h5 class="mb-0" style="color: #1a472a; font-weight: 700;">
                                <i class="fas fa-newspaper"></i> Latest News & Announcements
                            </h5>
                        </div>
                        <div class="card-body">
                            @php
                                $allNews = \App\Models\News::where('is_published', true)
                                    ->where('published_at', '<=', now())
                                    ->orderBy('published_at', 'desc')
                                    ->get();
                            @endphp
                                @if($allNews->count() > 0)
                                    <ul class="list-group list-group-flush">
                                        @foreach($allNews as $news)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $news->title }}</strong><br>
                                                <small><i class="fas fa-calendar"></i> {{ $news->created_at->format('M d, Y') }}</small>
                                            </div>
                                            <a href="{{ route('news.show', $news->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted mb-0">No news or announcements available.</p>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
