@extends('layouts.alumni')
@section('title', 'Privacy Policy')
@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="mb-4" style="color: var(--primary-color); font-weight: 800;">Privacy Policy</h1>
            <p class="text-muted mb-4">Last Updated: January 23, 2026</p>

            <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                @include('legal.partials.privacy-policy-content')

                <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #e0e0e0;">
                    <a href="/" class="btn" style="background: var(--primary-color); color: white; border-radius: 8px; padding: 0.7rem 1.5rem;">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
