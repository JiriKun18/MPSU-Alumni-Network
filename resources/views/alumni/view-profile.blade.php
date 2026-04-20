@extends('layouts.alumni')
@section('title','View Alumni Profile')
@section('content')
<div class="container mt-5">
    @if (!empty($verificationRequired) && $verificationRequired)
        <div class="alert alert-warning" role="alert">
            <strong>Verification required:</strong> Please wait for admin approval before accessing alumni profiles.
        </div>
    @else
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card" style="border: 2px solid #1a472a; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <div style="background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%); color: white; padding: 2rem; border-radius: 0.5rem 0.5rem 0 0;">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 100px; height: 100px; border-radius: 50%; background: #d4af37; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: #1a472a;">
                            {{ substr($profile->user->name, 0, 2) }}
                        </div>
                        <div>
                            <h2 style="margin: 0; margin-bottom: 0.5rem;">{{ $profile->user->name }}</h2>
                            <p style="margin: 0; opacity: 0.9;">{{ $profile->user->email }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 style="color: #1a472a; font-weight: 600; border-bottom: 2px solid #d4af37; padding-bottom: 0.5rem;">Personal Information</h5>
                            <div class="mt-3">
                                <div class="mb-3">
                                    <label style="color: #64748b; font-weight: 600; font-size: 0.85rem;">Batch/Year</label>
                                    <p style="color: #1a472a; font-weight: 500;">{{ $profile->batch->year ?? 'N/A' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label style="color: #64748b; font-weight: 600; font-size: 0.85rem;">Course</label>
                                    <p style="color: #1a472a; font-weight: 500;">{{ $profile->course ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h5 style="color: #1a472a; font-weight: 600; border-bottom: 2px solid #d4af37; padding-bottom: 0.5rem;">Professional Details</h5>
                            <div class="mt-3">
                                @if($profile->current_company)
                                    <div class="mb-3">
                                        <label style="color: #64748b; font-weight: 600; font-size: 0.85rem;">Company</label>
                                        <p style="color: #1a472a; font-weight: 500;">{{ $profile->current_company }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($profile->current_position)
                        <div class="mb-4">
                            <h5 style="color: #1a472a; font-weight: 600; border-bottom: 2px solid #d4af37; padding-bottom: 0.5rem;">Professional Information</h5>
                            <div class="mt-3">
                                <div class="mb-3">
                                    <label style="color: #64748b; font-weight: 600; font-size: 0.85rem;">Position</label>
                                    <p style="color: #1a472a; font-weight: 500;">{{ $profile->current_position }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('alumni.directory') }}" class="btn" style="background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 6px; font-weight: 600;">
                            <i class="fas fa-arrow-left"></i> Back to Directory
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
