@extends('layout')

@section('title', 'Sign Up - MPSU Alumni Network')

@section('content')
<div class="container">
    <link rel="stylesheet" href="{{ asset('css/cascading-address-selector.css') }}">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-7">
            <div class="card shadow-lg border-0" style="border-top: 4px solid var(--accent-gold);">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/logo_mpsu.png') }}" alt="MPSU Logo" style="max-width: 80px; margin-bottom: 15px;">
                        <h2 class="mb-2" style="color: var(--primary-color);">Create Your Account</h2>
                        <p class="text-muted">Join the MPSU Alumni Network</p>
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar" style="width: 33%; background: var(--accent-gold);">1/3</div>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Please correct the errors below:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('signup.step1.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Alumni Personal Information: Family Name, Given Name, MI, Suffix, Sex, Birthdate -->
                        <div class="row mb-3">
                            <div class="col-md-4 mb-2">
                                <label for="family_name" class="form-label fw-bold">
                                    <i class="fas fa-user"></i> Family Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-lg @error('family_name') is-invalid @enderror" id="family_name" name="family_name" placeholder="Enter family name" value="{{ old('family_name') }}" required>
                                @error('family_name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="given_name" class="form-label fw-bold">
                                    Given Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-lg @error('given_name') is-invalid @enderror" id="given_name" name="given_name" placeholder="Enter given name" value="{{ old('given_name') }}" required>
                                @error('given_name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="middle_initial" class="form-label fw-bold">MI</label>
                                 <input type="text" class="form-control form-control-lg @error('middle_initial') is-invalid @enderror" id="middle_initial" name="middle_initial" placeholder="M" value="{{ old('middle_initial') }}">
                                @error('middle_initial')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="suffix" class="form-label fw-bold">Suffix</label>
                                <input type="text" class="form-control form-control-lg @error('suffix') is-invalid @enderror" id="suffix" name="suffix" placeholder="Jr, Sr, III" value="{{ old('suffix') }}">
                                @error('suffix')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 mb-2">
                                <label for="sex" class="form-label fw-bold">Sex <span class="text-danger">*</span></label>
                                <select class="form-select form-select-lg @error('sex') is-invalid @enderror" id="sex" name="sex" required>
                                    <option value="">Select</option>
                                    <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('sex')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="date_of_birth" class="form-label fw-bold">Birthdate</label>
                                <input type="date" class="form-control form-control-lg @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                                @error('date_of_birth')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Contact Number -->
                        <div class="mb-3">
                            <label for="contact_number" class="form-label fw-bold">
                                <i class="fas fa-phone"></i> Contact Number
                            </label>
                            <input type="tel" class="form-control form-control-lg @error('contact_number') is-invalid @enderror" 
                                   id="contact_number" name="contact_number" placeholder="09XX-XXX-XXXX or +63-9XX-XXX-XXXX" 
                                   value="{{ old('contact_number') }}">
                            <small class="text-muted d-block mt-1">Optional - for communication purposes only</small>
                            @error('contact_number')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">
                                <i class="fas fa-envelope"></i> Email Address <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   id="email" name="email" placeholder="your.email@example.com" 
                                   value="{{ old('email') }}" required>
                            <small class="text-muted d-block mt-1">We'll send your OTP code to this email address</small>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address Section -->
                        <div class="address-selector-section">
                            <h5><i class="fas fa-map-marker-alt"></i> Present Address (Complete Address Required)</h5>
                            
                            <!-- Address display summary -->
                            <div id="present_address_display" class="address-display incomplete">
                                📍 Incomplete address
                            </div>

                            <!-- Address Level 1: Country -->
                            <div class="address-hierarchy-row">
                                <div class="address-field-group">
                                    <label for="present_country">
                                        Country
                                        <span class="required">*</span>
                                    </label>
                                    <select class="form-select @error('present_country') is-invalid @enderror" 
                                            id="present_country" name="present_country" 
                                            data-selected="{{ old('present_country') ?? '' }}" required>
                                        <option value="">Select Country</option>
                                    </select>
                                    @error('present_country')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <div class="hierarchy-indicator">Level 1 of 6 • Required for all</div>
                                </div>
                            </div>

                            <!-- Address Level 2: Region (Philippines only) -->
                            <div class="address-hierarchy-row">
                                <div class="address-field-group">
                                    <label for="present_region">
                                        Region
                                        <span class="required">*</span>
                                    </label>
                                    <select class="form-select @error('present_region') is-invalid @enderror" 
                                            id="present_region" name="present_region" 
                                            data-selected="{{ old('present_region') ?? '' }}" disabled required>
                                        <option value="">Select Region</option>
                                    </select>
                                    @error('present_region')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <div class="hierarchy-indicator">
                                        <span class="required-marker"></span> Level 2 of 6 • Required for Philippines only
                                    </div>
                                </div>
                            </div>

                            <!-- Address Level 3: Province (Philippines only) -->
                            <div class="address-hierarchy-row">
                                <div class="address-field-group">
                                    <label for="present_province">
                                        Province
                                        <span class="required">*</span>
                                    </label>
                                    <select class="form-select @error('present_province') is-invalid @enderror" 
                                            id="present_province" name="present_province" 
                                            data-selected="{{ old('present_province') ?? '' }}" disabled required>
                                        <option value="">Select Province</option>
                                    </select>
                                    @error('present_province')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <div class="hierarchy-indicator">
                                        <span class="required-marker"></span> Level 3 of 6 • Required for Philippines only
                                    </div>
                                </div>
                            </div>

                            <!-- Address Level 4: City/Municipality (Philippines only) -->
                            <div class="address-hierarchy-row">
                                <div class="address-field-group">
                                    <label for="present_city">
                                        City/Municipality
                                        <span class="required">*</span>
                                    </label>
                                    <select class="form-select @error('present_city') is-invalid @enderror" 
                                            id="present_city" name="present_city" 
                                            data-selected="{{ old('present_city') ?? '' }}" disabled required>
                                        <option value="">Select City/Municipality</option>
                                    </select>
                                    @error('present_city')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <div class="hierarchy-indicator">
                                        <span class="required-marker"></span> Level 4 of 6 • Required for Philippines only
                                    </div>
                                </div>
                            </div>

                            <!-- Address Level 5: Barangay (Philippines only) -->
                            <div class="address-hierarchy-row">
                                <div class="address-field-group">
                                    <label for="present_barangay">
                                        Barangay
                                        <span class="required">*</span>
                                    </label>
                                    <select class="form-select @error('present_barangay') is-invalid @enderror" 
                                            id="present_barangay" name="present_barangay" 
                                            data-selected="{{ old('present_barangay') ?? '' }}" disabled required>
                                        <option value="">Select Barangay</option>
                                    </select>
                                    @error('present_barangay')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <div class="hierarchy-indicator">
                                        <span class="required-marker"></span> Level 5 of 5 • Required for Philippines only
                                    </div>
                                </div>
                            </div>

                            <!-- Validation Messages -->
                            <div id="present_address_complete" class="address-validation address-complete-msg" style="display: none;">
                                <i class="fas fa-check-circle"></i>
                                <span>✓ Complete address provided</span>
                            </div>
                            <div id="present_address_incomplete" class="address-validation address-incomplete-msg">
                                <i class="fas fa-info-circle"></i>
                                <span>⚠ Address is incomplete. Please fill all required levels.</span>
                            </div>

                            <!-- Address Notes -->
                            <div class="address-notes">
                                <strong>📌 Important:</strong>
                                <small>
                                    Each location level must be selected from the dropdown menu. You cannot manually type addresses. 
                                    For Philippines addresses, all 6 levels are required. For other countries, only the country is required.
                                </small>
                            </div>
                        </div>

                        <!-- Campus -->
                        <div class="mb-3">
                            <label for="campus" class="form-label fw-bold">
                                <i class="fas fa-university"></i> Campus <span class="text-danger">*</span>
                            </label>
                            <select class="form-control form-control-lg @error('campus') is-invalid @enderror" 
                                    id="campus" name="campus" required>
                                <option value="">-- Select Campus --</option>
                                <option value="Bontoc Campus" {{ old('campus') == 'Bontoc Campus' ? 'selected' : '' }}>Bontoc Campus</option>
                                <option value="Tadian Campus" {{ old('campus') == 'Tadian Campus' ? 'selected' : '' }}>Tadian Campus</option>
                                <option value="Paracelis Campus" {{ old('campus') == 'Paracelis Campus' ? 'selected' : '' }}>Paracelis Campus</option>
                            </select>
                            @error('campus')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Course Graduated -->
                        <div class="mb-3">
                            <label for="course_graduated" class="form-label fw-bold">
                                <i class="fas fa-book"></i> Course Graduated <span class="text-danger">*</span>
                            </label>
                            <select class="form-control form-control-lg @error('course_graduated') is-invalid @enderror" 
                                    id="course_graduated" name="course_graduated" required disabled>
                                <option value="">-- Select Campus First --</option>
                            </select>
                            <small class="text-muted d-block mt-1">Select a campus first to see available courses</small>
                            @error('course_graduated')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Year Graduated -->
                        <div class="mb-3">
                            <label for="year_graduated" class="form-label fw-bold">
                                <i class="fas fa-calendar"></i> Year Graduated <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control form-control-lg @error('year_graduated') is-invalid @enderror" 
                                   id="year_graduated" name="year_graduated" placeholder="YYYY" 
                                   value="{{ old('year_graduated') }}" min="1950" max="{{ date('Y') }}" required>
                            @error('year_graduated')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">
                                <i class="fas fa-lock"></i> Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       id="password" name="password" placeholder="Enter a strong password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword" 
                                        style="border: 2px solid #e9ecef; border-left: 0;">
                                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                            <small class="text-muted d-block mt-1">At least 8 characters with uppercase, lowercase, number, and symbol</small>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-bold">
                                <i class="fas fa-lock"></i> Confirm Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" 
                                       id="password_confirmation" name="password_confirmation" placeholder="Re-enter your password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation" 
                                        style="border: 2px solid #e9ecef; border-left: 0;">
                                    <i class="fas fa-eye" id="togglePasswordConfirmationIcon"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Profile Picture -->
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label fw-bold">
                                <i class="fas fa-camera"></i> Profile Picture <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control form-control-lg @error('profile_picture') is-invalid @enderror" 
                                   id="profile_picture" name="profile_picture" accept="image/*" required>
                            <small class="text-muted d-block mt-1">Upload a clear profile photo to confirm your identity. File size limit: 5MB</small>
                            @error('profile_picture')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alumni Verification Documents -->
                        <div class="mb-4">
                            <div class="card" style="border: 2px dashed #17a2b8; border-radius: 16px; background: linear-gradient(135deg, rgba(23, 162, 184, 0.05) 0%, rgba(23, 162, 184, 0.02) 100%);">
                                <div class="card-body p-4">
                                    <div class="text-center mb-3">
                                        <i class="fas fa-file-upload" style="font-size: 2.5rem; color: #17a2b8;"></i>
                                        <h5 class="mt-2 mb-1" style="color: var(--primary-color);">Alumni Verification Documents <span class="text-danger">*</span></h5>
                                        <p class="text-muted small">Upload official documents to confirm your alumni status</p>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="verification_documents" class="form-label" style="font-weight: 600; color: var(--primary-color);">Upload Documents</label>
                                        <input type="file" class="form-control @error('verification_documents') is-invalid @enderror" 
                                               id="verification_documents" name="verification_documents[]" accept="image/*,.pdf" multiple style="padding: 12px; border: 1px solid #17a2b8;" required>
                                        <small class="text-muted d-block mt-2"><i class="fas fa-info-circle"></i> Upload transcript of records, diploma, or graduation photo. Multiple files supported. Up to 5 files, max 5MB each.</small>
                                        @error('verification_documents')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        @error('verification_documents.*')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input @error('terms_accepted') is-invalid @enderror" 
                                       id="terms_accepted" name="terms_accepted" value="1" {{ old('terms_accepted') ? 'checked' : '' }} required>
                                <label class="form-check-label" for="terms_accepted">
                                    I agree to the <a href="#" class="text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditions</a> 
                                    and <a href="#" class="text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#privacyModal">Privacy Policy</a> <span class="text-danger">*</span>
                                </label>
                                @error('terms_accepted')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-lg w-100 text-white fw-bold" 
                                style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); 
                                        border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                            <i class="fas fa-arrow-right"></i> Continue to Verification
                        </button>
                    </form>

                    <hr class="my-4">

                    <p class="text-center text-muted">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-primary fw-bold">Login here</a>
                    </p>
                </div>
            </div>

            <!-- Info Box -->
            <div class="mt-4 p-3 rounded" style="background: rgba(45, 80, 22, 0.1); border-left: 4px solid var(--primary-color);">

    <!-- Terms Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms of Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted mb-4">Last Updated: January 23, 2026</p>
                    @include('legal.partials.terms-of-service-content')
                </div>
            </div>
        </div>
    </div>

    <!-- Privacy Modal -->
    <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="privacyModalLabel">Privacy Policy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted mb-4">Last Updated: January 23, 2026</p>
                    @include('legal.partials.privacy-policy-content')
                </div>
            </div>
        </div>
    </div>
                <p class="mb-0 small">
                    <i class="fas fa-info-circle" style="color: var(--primary-color);"></i>
                    <strong>Why we need this information:</strong> We use this data to verify your MPSU alumni status and create your personalized alumni profile.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="signup-helper-fab">
    <button type="button" class="helper-bubble-btn" id="signupHelperToggle" aria-expanded="false" aria-controls="signupHelperPanel">
        <span class="helper-icon"><i class="fas fa-comments"></i></span>
        <span class="helper-label">Need help?</span>
    </button>
</div>

<div class="signup-helper-panel" id="signupHelperPanel" aria-hidden="true">
    <div class="helper-panel-header">
        <div class="helper-title">
            <i class="fas fa-life-ring"></i> Signup Helper
        </div>
        <button type="button" class="helper-close" id="signupHelperClose" aria-label="Close helper">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="helper-panel-body">
        <p class="helper-intro">Quick tips to complete your registration:</p>
        <ul class="helper-list">
            <li>Use your real alumni name and graduation year.</li>
            <li>OTP will be sent to your phone number.</li>
            <li>Choose campus first to unlock course list.</li>
            <li>Use a valid email you can access.</li>
        </ul>
        <div class="helper-links">
            <a href="#" class="helper-link" data-bs-toggle="modal" data-bs-target="#termsModal">Terms</a>
            <span class="helper-divider">|</span>
            <a href="#" class="helper-link" data-bs-toggle="modal" data-bs-target="#privacyModal">Privacy</a>
        </div>
    </div>
</div>

<style>
    .form-control-lg:focus {
        border-color: var(--accent-gold);
        box-shadow: 0 0 0 0.2rem rgba(197, 165, 114, 0.25);
    }

    .form-control-lg {
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .form-control-lg:hover {
        border-color: var(--accent-gold);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.3) !important;
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
    }

    .input-group .form-control:focus {
        border-color: var(--accent-gold);
        box-shadow: none;
    }

    .input-group .btn-outline-secondary {
        border-color: #e9ecef;
        color: #6c757d;
    }

    .input-group .btn-outline-secondary:hover {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    .signup-helper-fab {
        position: fixed;
        right: 24px;
        bottom: 24px;
        z-index: 1050;
    }

    .helper-bubble-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        border: none;
        border-radius: 999px;
        padding: 0.75rem 1.1rem;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: #fff;
        font-weight: 700;
        box-shadow: 0 10px 24px rgba(0,0,0,0.2);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .helper-bubble-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 30px rgba(0,0,0,0.25);
    }

    .helper-icon {
        display: inline-flex;
        width: 32px;
        height: 32px;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
    }

    .helper-label {
        font-size: 0.95rem;
        letter-spacing: 0.2px;
    }

    .signup-helper-panel {
        position: fixed;
        right: 24px;
        bottom: 88px;
        width: min(340px, 90vw);
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 18px 40px rgba(0,0,0,0.2);
        border: 1px solid var(--border-color);
        opacity: 0;
        transform: translateY(10px);
        pointer-events: none;
        transition: all 0.2s ease;
        z-index: 1050;
    }

    .signup-helper-panel.is-open {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .helper-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.9rem 1rem;
        border-bottom: 1px solid var(--border-color);
        background: rgba(212, 175, 55, 0.08);
        border-radius: 16px 16px 0 0;
        color: var(--primary-color);
        font-weight: 800;
    }

    .helper-panel-body {
        padding: 1rem;
        color: #475569;
    }

    .helper-intro {
        margin-bottom: 0.75rem;
        font-weight: 600;
        color: var(--primary-color);
    }

    .helper-list {
        padding-left: 1.1rem;
        margin-bottom: 0.9rem;
    }

    .helper-list li {
        margin-bottom: 0.35rem;
    }

    .helper-links {
        font-size: 0.85rem;
        color: #64748b;
    }

    .helper-link {
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
    }

    .helper-divider {
        margin: 0 8px;
        color: #cbd5f5;
    }

    .helper-close {
        border: none;
        background: transparent;
        color: var(--primary-color);
        font-size: 1rem;
    }
</style>

<script>
    // Password toggle functionality
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const icon = document.getElementById('togglePasswordIcon');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
        const passwordField = document.getElementById('password_confirmation');
        const icon = document.getElementById('togglePasswordConfirmationIcon');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    const helperToggle = document.getElementById('signupHelperToggle');
    const helperClose = document.getElementById('signupHelperClose');
    const helperPanel = document.getElementById('signupHelperPanel');

    function setHelperOpen(isOpen) {
        helperPanel.classList.toggle('is-open', isOpen);
        helperPanel.setAttribute('aria-hidden', String(!isOpen));
        helperToggle.setAttribute('aria-expanded', String(isOpen));
    }

    helperToggle.addEventListener('click', function() {
        const isOpen = helperPanel.classList.contains('is-open');
        setHelperOpen(!isOpen);
    });

    helperClose.addEventListener('click', function() {
        setHelperOpen(false);
    });

    // Campus and course dropdown functionality
    const campusSelect = document.getElementById('campus');
    const courseSelect = document.getElementById('course_graduated');
    const globalApiBase = (window.APP_API_BASE || '').replace(/\/$/, '') + '/api';

    campusSelect.addEventListener('change', function() {
        const selectedCampus = this.value;
        
        // Reset course dropdown
        courseSelect.innerHTML = '<option value="">-- Loading courses... --</option>';
        courseSelect.disabled = true;

        if (!selectedCampus) {
            courseSelect.innerHTML = '<option value="">-- Select Campus First --</option>';
            return;
        }

        // Fetch courses for selected campus
        fetch(`${globalApiBase}/courses?campus=${encodeURIComponent(selectedCampus)}`)
            .then(response => response.json())
            .then(data => {
                courseSelect.innerHTML = '<option value="">-- Select Course --</option>';
                
                data.forEach(course => {
                    const option = document.createElement('option');
                    option.value = course.display;
                    option.textContent = course.display;
                    courseSelect.appendChild(option);
                });
                
                courseSelect.disabled = false;

                // Restore old value if exists
                const oldValue = "{{ old('course_graduated') }}";
                if (oldValue) {
                    courseSelect.value = oldValue;
                }
            })
            .catch(error => {
                console.error('Error fetching courses:', error);
                courseSelect.innerHTML = '<option value="">-- Error loading courses --</option>';
            });
    });

    // Trigger campus change on page load if there's an old value
    window.addEventListener('DOMContentLoaded', function() {
        const oldCampus = "{{ old('campus') }}";
        if (oldCampus) {
            campusSelect.value = oldCampus;
            campusSelect.dispatchEvent(new Event('change'));
        }
    });

    // Address selectors - Cascading 6-level selector
    // Automatically initialized by cascading-address-selector.js
</script>

<script src="{{ asset('js/cascading-address-selector.js') }}"></script>
@endsection

