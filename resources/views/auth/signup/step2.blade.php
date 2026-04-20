@extends('layout')

@section('title', 'Verify OTP - MPSU Alumni Network')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-6">
            <div class="card shadow-lg border-0" style="border-top: 4px solid var(--accent-gold);">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/logo_mpsu.png') }}" alt="MPSU Logo" style="max-width: 80px; margin-bottom: 15px;">
                        <h2 class="mb-2" style="color: var(--primary-color);">Verify Your Phone</h2>
                        <p class="text-muted">Enter the OTP sent to your phone</p>
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar" style="width: 66%; background: var(--accent-gold);">2/3</div>
                        </div>
                    </div>

                    @if (session('otp_debug'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Development Mode:</strong> OTP for testing: <code>{{ session('otp_debug') }}</code>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="alert alert-info" style="background: rgba(45, 80, 22, 0.1); border: 1px solid var(--primary-color);">
                        <p class="mb-0">
                            <i class="fas fa-envelope" style="color: var(--primary-color);"></i>
                            <strong>OTP sent to:</strong> {{ substr($email, 0, 6) }}***{{ substr($email, -10) }}
                        </p>
                    </div>

                    <form action="{{ route('signup.step2.submit') }}" method="POST">
                        @csrf

                        <!-- OTP Input -->
                        <div class="mb-4">
                            <label for="otp_code" class="form-label fw-bold">
                                <i class="fas fa-shield-alt"></i> Enter OTP <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-lg text-center @error('otp_code') is-invalid @enderror" 
                                   id="otp_code" name="otp_code" placeholder="000000" maxlength="6" 
                                   value="{{ old('otp_code') }}" required 
                                   style="letter-spacing: 10px; font-size: 24px; font-weight: bold;">
                            <small class="text-muted d-block mt-2">Enter the 6-digit code sent to your phone</small>
                            @error('otp_code')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Countdown Timer -->
                        <div class="text-center mb-4">
                            <p class="text-muted mb-2">OTP expires in <strong id="countdown">10:00</strong></p>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar" id="timer-bar" style="width: 100%; background: var(--secondary-color);"></div>
                            </div>
                        </div>


                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-lg w-100 text-white fw-bold" 
                                style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); 
                                        border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                            <i class="fas fa-check"></i> Verify OTP
                        </button>
                    </form>

                    <hr class="my-4">

                    <!-- Resend OTP -->
                    <form action="{{ route('signup.resend-otp') }}" method="POST" class="mb-3">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary w-100">
                            <i class="fas fa-redo"></i> Resend OTP
                        </button>
                    </form>

                    <!-- Back Button -->
                    <a href="{{ route('signup.step1') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-arrow-left"></i> Go Back
                    </a>
                </div>
            </div>

            <!-- Info Box -->
            <div class="mt-4 p-3 rounded" style="background: rgba(45, 80, 22, 0.1); border-left: 4px solid var(--primary-color);">
                <p class="mb-0 small">
                    <i class="fas fa-info-circle" style="color: var(--primary-color);"></i>
                    <strong>Didn't receive the OTP?</strong> Click "Resend OTP" or check your spam folder. Make sure your phone number is correct.
                </p>
            </div>
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

    #otp_code {
        font-family: 'Courier New', monospace;
    }
</style>

<script>
    // OTP input formatter - only allow numbers
    document.getElementById('otp_code').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Countdown timer
    function startCountdown() {
        let totalSeconds = 600; // 10 minutes
        const countdownElement = document.getElementById('countdown');
        const timerBar = document.getElementById('timer-bar');

        const interval = setInterval(() => {
            const minutes = Math.floor(totalSeconds / 60);
            const seconds = totalSeconds % 60;
            
            countdownElement.textContent = 
                String(minutes).padStart(2, '0') + ':' + 
                String(seconds).padStart(2, '0');

            const percentage = (totalSeconds / 600) * 100;
            timerBar.style.width = percentage + '%';

            if (totalSeconds <= 0) {
                clearInterval(interval);
                countdownElement.textContent = 'Expired';
                timerBar.style.width = '0%';
                document.querySelector('button[type="submit"]').disabled = true;
            }

            totalSeconds--;
        }, 1000);
    }

    // Start countdown when page loads
    document.addEventListener('DOMContentLoaded', startCountdown);
</script>
@endsection

@section('extra-js')
@endsection
