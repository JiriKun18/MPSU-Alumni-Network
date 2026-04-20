@extends('layouts.alumni')

@section('title', $job->title . ' - MPSU Alumni Network')

@section('content')
<div class="container">
    @if (!empty($verificationRequired) && $verificationRequired)
        <div class="alert alert-warning" role="alert">
            <strong>Verification required:</strong> Your account is pending approval. Please wait for admin verification before accessing job details.
        </div>
    @else
    <div class="row mb-4">
        <div class="col">
            <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary btn-sm mb-3">
                <button type="button" class="btn btn-secondary btn-sm" onclick="window.history.back()">
                    <i class="fa-solid fa-arrow-left-long"></i> Back
                </button>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 style="color: #0d4d2d; font-weight: 800;">{{ $job->title }}</h2>
                    <p class="lead text-muted">{{ $job->company_name }}</p>

                    <div class="mb-4">
                        <span class="badge bg-primary">{{ $job->position_type }}</span>
                        <span class="badge bg-secondary">{{ $job->location }}</span>
                        @if ($job->salary_min && $job->salary_max)
                            <span class="badge bg-success">₱{{ number_format($job->salary_min) }} - ₱{{ number_format($job->salary_max) }}</span>
                        @endif
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>Deadline:</strong> 
                                @if ($job->isExpired())
                                    <span class="text-danger">Expired</span>
                                @else
                                    {{ $job->deadline->format('M d, Y') }}
                                @endif
                            </p>
                        </div>
                    </div>

                    <hr>

                    <h5 style="color: #0d4d2d; font-weight: 700;">Job Description</h5>
                    <div class="mb-4">
                        {!! nl2br(e($job->description)) !!}
                    </div>

                    @if ($job->requirements)
                        <h5 style="color: #0d4d2d; font-weight: 700;">Requirements</h5>
                        <div class="mb-4">
                            {!! nl2br(e($job->requirements)) !!}
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header" style="background: linear-gradient(135deg, #0d4d2d 0%, #1a6b3d 100%); color: white; border-radius: 12px 12px 0 0;">
                    <h5 class="mb-0">
                        <i class="fas fa-phone-alt"></i> Contact if Interested
                    </h5>
                </div>
                <div class="card-body">
                    @if ($job->isExpired())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i> This job posting has expired.
                        </div>
                    @else
                        <div class="contact-info" style="background: #f5f7f0; padding: 1.5rem; border-radius: 8px; border-left: 4px solid #d4af37;">
                            <h6 style="color: #0d4d2d; font-weight: 700; margin-bottom: 1rem;">
                                <i class="fas fa-envelope" style="color: #d4af37;"></i> Email
                            </h6>
                            <p style="margin-bottom: 1.5rem;">
                                <a href="mailto:{{ $job->contact_email }}" style="color: #0d4d2d; text-decoration: none; font-weight: 600;">
                                    {{ $job->contact_email }}
                                </a>
                            </p>

                            @if($job->contact_phone)
                                <h6 style="color: #0d4d2d; font-weight: 700; margin-bottom: 1rem;">
                                    <i class="fas fa-phone" style="color: #d4af37;"></i> Phone
                                </h6>
                                <p style="margin-bottom: 1.5rem;">
                                    <a href="tel:{{ $job->contact_phone }}" style="color: #0d4d2d; text-decoration: none; font-weight: 600;">
                                        {{ $job->contact_phone }}
                                    </a>
                                </p>
                            @endif

                            @if($job->contact_website)
                                <h6 style="color: #0d4d2d; font-weight: 700; margin-bottom: 1rem;">
                                    <i class="fas fa-globe" style="color: #d4af37;"></i> Website
                                </h6>
                                <p style="margin-bottom: 1.5rem;">
                                    <a href="{{ $job->contact_website }}" target="_blank" style="color: #0d4d2d; text-decoration: none; font-weight: 600;">
                                        {{ $job->contact_website }}
                                    </a>
                                </p>
                            @endif

                            @if($job->contact_address)
                                <h6 style="color: #0d4d2d; font-weight: 700; margin-bottom: 1rem;">
                                    <i class="fas fa-map-marker-alt" style="color: #d4af37;"></i> Address
                                </h6>
                                <p style="margin-bottom: 0;">
                                    {{ $job->contact_address }}
                                </p>
                            @endif
                        </div>

                        <div style="margin-top: 1.5rem; padding: 1rem; background: #fff3cd; border-radius: 8px; border-left: 4px solid #ffc107;">
                            <p style="margin-bottom: 0; font-size: 0.9rem; color: #856404;">
                                <i class="fas fa-info-circle"></i> Contact the employer directly to inquire about this position.
                            </p>
                        </div>
                        @php
                            $mapQuery = trim($job->contact_address ?: ($job->location ?: $job->company_name));
                            $mapUrl = $mapQuery ? 'https://www.google.com/maps?q=' . urlencode($mapQuery) : null;
                        @endphp
                        <div class="py-2">
                            <h6 style="color: #0d4d2d; font-weight: 700; margin-bottom: 0.75rem;">
                                <i class="fas fa-map-marked-alt" style="color: #d4af37;"></i> Location Map
                            </h6>
                            @if ($mapUrl)
                                <div style="border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden; background: #fff;">
                                    <iframe
                                        title="Job location map"
                                        src="{{ $mapUrl }}&output=embed"
                                        width="100%"
                                        height="220"
                                        style="border: 0; display: block;"
                                        loading="lazy"
                                    ></iframe>
                                </div>
                                <p class="mt-2 mb-0" style="font-size: 0.9rem; color: #0d4d2d;">
                                    <i class="fas fa-map-marker-alt" style="color: #d4af37;"></i>
                                    {{ $mapQuery }}
                                </p>
                                <a href="{{ $mapUrl }}" target="_blank" rel="noopener" class="btn btn-outline-success w-100 mt-3">
                                    Open in Google Maps
                                </a>
                            @else
                                <p class="text-muted mb-0">Location not provided.</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
