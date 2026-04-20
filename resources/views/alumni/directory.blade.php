@extends('layouts.alumni')

@section('title', 'Alumni Directory - MPSU Alumni Network')

@section('content')
<style>
    .alumni-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .alumni-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(26, 71, 42, 0.2);
    }

    .alumni-photo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 12px;
        border: 3px solid #d4af37;
    }

    .alumni-initials {
        width: 120px;
        height: 120px;
        border-radius: 12px;
        background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%);
        border: 3px solid #d4af37;
        font-size: 3rem;
        font-weight: 700;
    }

    .alumni-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1a472a;
    }

    .alumni-meta {
        font-size: 0.85rem;
        color: #64748b;
        margin-bottom: 0.5rem;
    }

    .status-badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-employed {
        background: #ecfdf5;
        color: #065f46;
    }

    .status-unemployed {
        background: #fef2f2;
        color: #991b1b;
    }

    .status-self-employed {
        background: #fef3c7;
        color: #92400e;
    }

    .status-contractual {
        background: #e0e7ff;
        color: #3730a3;
    }

    .view-details-btn {
        margin-top: auto;
        background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%);
        border: none;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .view-details-btn:hover {
        background: linear-gradient(135deg, #0f2618 0%, #1f380b 100%);
        transform: translateY(-2px);
    }

    /* List View Styles */
    .alumni-list-item {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .alumni-list-item:last-child {
        border-bottom: none;
    }

    .alumni-list-photo {
        width: 80px;
        height: 80px;
        min-width: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #d4af37;
    }

    .alumni-list-initials {
        width: 80px;
        height: 80px;
        min-width: 80px;
        border-radius: 8px;
        background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%);
        border: 2px solid #d4af37;
        font-size: 2rem;
        font-weight: 700;
    }

    .alumni-list-content {
        flex: 1;
        min-width: 0;
    }

    .view-toggle-btn {
        background: white;
        border: 2px solid #2d5016;
        color: #2d5016;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .view-toggle-btn.active {
        background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%);
        color: white;
        border-color: #2d5016;
    }

    .view-toggle-btn:hover {
        background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%);
        color: white;
    }

    .list-view-card {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 8px rgba(26, 71, 42, 0.08);
    }
</style>

<div class="container-fluid py-5">
    <!-- Page Header -->
    <div class="mb-4">
        <h2 class="mb-2" style="font-size: 2rem; font-weight: 800; color: #1a472a;">
            <i class="fas fa-users"></i> Alumni Directory
        </h2>
        <p class="text-muted mb-0">Connect with fellow Mountain Province State University alumni</p>
    </div>

    @if (Auth::user() && !Auth::user()->is_verified)
        <div class="alert alert-warning" role="alert">
            <strong>Verification required:</strong> Your account is pending approval. Please wait for admin verification before accessing the alumni directory.
        </div>
    @else

    <!-- Filters Section -->
    <div class="card mb-4" style="border-radius: 12px; border: 1px solid #e2e8f0;">
        <div class="card-body">
            <form class="row g-3" method="GET" action="{{ route('alumni.alumni-dir') }}" id="filterForm">
                <div class="col-md-6">
                    <label class="form-label fw-600 mb-2">Batch</label>
                    <select name="batch" class="form-select" style="border-radius: 8px;">
                        <option value="">All Batches</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}" {{ request('batch') == $batch->id ? 'selected' : '' }}>
                                Batch {{ $batch->year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-600 mb-2">Course</label>
                    <select name="course" class="form-select" style="border-radius: 8px;">
                        <option value="">All Courses</option>
                        @foreach($courses as $course)
                            <option value="{{ $course }}" {{ request('course') == $course ? 'selected' : '' }}>
                                {{ $course }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Alumni Table -->
    @if($alumni->count() > 0)
    <div class="row">
        <div class="col-lg-9 col-md-8">
            <div class="card" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(26, 71, 42, 0.08); border: 1px solid #e2e8f0;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="border-collapse: separate; border-spacing: 0;">
                            <thead style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white;">
                                <tr>
                                    <th style="padding: 1rem; border: none; font-weight: 700;">Photo</th>
                                    <th style="padding: 1rem; border: none; font-weight: 700;">Name</th>
                                    <th style="padding: 1rem; border: none; font-weight: 700;">Course/Batch</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alumni as $alumni_profile)
                                <tr style="border-bottom: 1px solid #e2e8f0; transition: background 0.2s;">
                                    <!-- Photo -->
                                    <td style="padding: 1rem; vertical-align: middle;">
                                        @if($alumni_profile->profile_picture)
                                            <img src="{{ asset('storage/' . $alumni_profile->profile_picture) }}" 
                                                 alt="{{ $alumni_profile->family_name }}" 
                                                 style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover; border: 2px solid #d4af37;">
                                        @else
                                            <div style="width: 50px; height: 50px; border-radius: 8px; background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%); border: 2px solid #d4af37; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">
                                                {{ substr($alumni_profile->given_name ?? $alumni_profile->family_name ?? $alumni_profile->user->name ?? 'A', 0, 1) }}
                                            </div>
                                        @endif
                                    </td>
                                    
                                    <!-- Full Name -->
                                    <td style="padding: 1rem; vertical-align: middle;">
                                        <div style="font-weight: 600; color: var(--primary-color); font-size: 1rem;">
                                            @php
                                                $fullName = trim(
                                                    ($alumni_profile->family_name ?? '') . ', ' . 
                                                    ($alumni_profile->given_name ?? '') . ' ' . 
                                                    ($alumni_profile->middle_initial ?? '') . ' ' . 
                                                    ($alumni_profile->suffix ?? '')
                                                );
                                                // Remove extra commas and spaces
                                                $fullName = preg_replace('/,\s*,/', ',', $fullName);
                                                $fullName = preg_replace('/\s+/', ' ', $fullName);
                                                $fullName = trim($fullName, ', ');
                                            @endphp
                                            {{ $fullName ?: $alumni_profile->user->name ?? 'Not available' }}
                                        </div>
                                    </td>
                                    
                                    <!-- Course/Batch -->
                                    <td style="padding: 1rem; vertical-align: middle;">
                                        <div style="font-size: 0.9rem;">
                                            @if($alumni_profile->course)
                                                <strong>{{ $alumni_profile->course }}</strong>
                                            @endif
                                            @if($alumni_profile->batch_id)
                                                <br><small class="text-muted">Batch {{ $alumni_profile->batch->year ?? 'N/A' }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="p-3 border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{ $alumni->firstItem() }} to {{ $alumni->lastItem() }} of {{ $alumni->total() }} alumni
                            </div>
                            <div>
                                {{ $alumni->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4">
            @php
                $alumniSpotlight = \App\Models\News::where('is_published', 1)
                    ->where(function($q){
                        $q->where('title', 'like', '%alumni%')
                          ->orWhere('title', 'like', '%achievement%')
                          ->orWhere('title', 'like', '%spotlight%')
                          ->orWhere('title', 'like', '%success%');
                    })
                    ->orderByDesc('published_at')
                    ->first();
            @endphp
            @if($alumniSpotlight)
            <div class="card shadow-sm mb-4 w-100" style="border-radius: 16px; border-left: 6px solid var(--accent-gold);">
                <div class="card-body">
                    <h4 class="card-title mb-2" style="color: var(--primary-color); font-weight: 800;">
                        <i class="fas fa-trophy" style="color: var(--accent-gold);"></i> Alumni Achievement
                    </h4>
                    @if($alumniSpotlight->featured_image)
                        <img src="{{ asset('storage/' . $alumniSpotlight->featured_image) }}" alt="{{ $alumniSpotlight->title }}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 12px; display: block; margin-bottom: 0.75rem;">
                    @endif
                    <h5 class="mb-2" style="font-weight: 700; color: var(--secondary-color);">{{ $alumniSpotlight->title }}</h5>
                    <p class="card-text text-muted" style="font-size: 1rem;">
                        {{ \Illuminate\Support\Str::limit(strip_tags($alumniSpotlight->content), 180) }}
                    </p>
                    <div class="mt-3 text-end">
                        <a href="{{ route('news.show', $alumniSpotlight->id) }}" class="btn btn-outline-primary w-100" style="font-weight: 600;">
                            Read More <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @else
        <div class="alert alert-info text-center py-5" style="border-radius: 12px; border: 1px solid #bae6fd;">
            <i class="fas fa-users fa-3x mb-3" style="color: #0284c7;"></i>
            <h5>No Alumni Found</h5>
            <p class="mb-0">No alumni match your search criteria. Try adjusting your filters.</p>
        </div>
    @endif
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filterForm');
        const batchSelect = filterForm ? filterForm.querySelector('select[name="batch"]') : null;
        const courseSelect = filterForm ? filterForm.querySelector('select[name="course"]') : null;

        [batchSelect, courseSelect].forEach((selectElement) => {
            if (!selectElement || !filterForm) {
                return;
            }

            selectElement.addEventListener('change', function() {
                filterForm.submit();
            });
        });
    });
</script>
@endsection
