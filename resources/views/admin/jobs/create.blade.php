@extends('admin.layout')
@section('title','Post a Job')
@section('content')
<div class="container-fluid py-4">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.jobs.index') ?? '#' }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Jobs
        </a>
        <div>
            <h2 style="font-size: 2rem; font-weight: 800; color: var(--primary-color);">
                <i class="fas fa-briefcase"></i> Post a New Job
            </h2>
            <p class="text-muted mb-0">Create a job opportunity for alumni</p>
        </div>
    </div>

    <div class="card" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
        <div class="card-body p-4">
            <form action="{{ route('admin.jobs.store') ?? '#' }}" method="POST">
                @csrf
                
                <div class="row g-4">
                    <!-- Job Title -->
                    <div class="col-md-6">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Job Title *</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g., Senior Software Engineer" required style="border-radius: 8px; border: 1px solid #e2e8f0;" value="{{ old('title') }}">
                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Company Name -->
                    <div class="col-md-6">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Company Name *</label>
                        <input type="text" name="company_name" class="form-control" placeholder="e.g., Tech Corp Inc." required style="border-radius: 8px; border: 1px solid #e2e8f0;" value="{{ old('company_name') }}">
                        @error('company_name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Location -->
                    <div class="col-md-6">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Location *</label>
                        <input type="text" name="location" class="form-control" placeholder="e.g., Manila, Philippines" required style="border-radius: 8px; border: 1px solid #e2e8f0;" value="{{ old('location') }}">
                        @error('location')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Office Location on Map</label>
                        <div id="admin-job-location-map" style="height: 240px; border-radius: 12px; border: 1px solid #e2e8f0;"></div>
                        <div id="admin-job-map-coords" style="font-size: 0.85rem; color: #64748b; margin-top: 0.5rem;">
                            No pin set yet. Click on the map to set the office location.
                        </div>
                        <input type="hidden" id="admin_job_latitude" name="latitude" value="{{ old('latitude') }}">
                        <input type="hidden" id="admin_job_longitude" name="longitude" value="{{ old('longitude') }}">
                    </div>

                    <!-- Job Type -->
                    <div class="col-md-6">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Job Type *</label>
                        <select name="position_type" class="form-select" required style="border-radius: 8px; border: 1px solid #e2e8f0;">
                            <option value="">Select job type</option>
                            <option value="Full-time" {{ old('position_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ old('position_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Contract" {{ old('position_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                        </select>
                        @error('position_type')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Salary Min -->
                    <div class="col-md-6">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Minimum Salary (₱)</label>
                        <input type="number" name="salary_min" class="form-control" placeholder="e.g., 50000" style="border-radius: 8px; border: 1px solid #e2e8f0;" value="{{ old('salary_min') }}">
                        @error('salary_min')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Salary Max -->
                    <div class="col-md-6">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Maximum Salary (₱)</label>
                        <input type="number" name="salary_max" class="form-control" placeholder="e.g., 80000" style="border-radius: 8px; border: 1px solid #e2e8f0;" value="{{ old('salary_max') }}">
                        @error('salary_max')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Requirements -->
                    <div class="col-12">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Requirements</label>
                        <textarea name="requirements" class="form-control" rows="3" placeholder="Enter job requirements, one per line" style="border-radius: 8px; border: 1px solid #e2e8f0;">{{ old('requirements') }}</textarea>
                        @error('requirements')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Job Description -->
                    <div class="col-12">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Job Description *</label>
                        <textarea name="description" class="form-control" rows="6" placeholder="Describe the job role, responsibilities, and what you're looking for in a candidate" required style="border-radius: 8px; border: 1px solid #e2e8f0;">{{ old('description') }}</textarea>
                        @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Contact Email -->
                    <div class="col-md-6">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Contact Email *</label>
                        <input type="email" name="contact_email" class="form-control" placeholder="e.g., hr@company.com" required style="border-radius: 8px; border: 1px solid #e2e8f0;" value="{{ old('contact_email') }}">
                        @error('contact_email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <!-- Contact Phone -->
                    <div class="col-md-6">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Contact Phone</label>
                        <input type="text" name="contact_phone" class="form-control" placeholder="e.g., +63 912 345 6789" style="border-radius: 8px; border: 1px solid #e2e8f0;" value="{{ old('contact_phone') }}">
                        @error('contact_phone')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <!-- Contact Website -->
                    <div class="col-md-6">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Contact Website</label>
                        <input type="url" name="contact_website" class="form-control" placeholder="e.g., https://company.com" style="border-radius: 8px; border: 1px solid #e2e8f0;" value="{{ old('contact_website') }}">
                        @error('contact_website')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <!-- Contact Address -->
                    <div class="col-md-6">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Contact Address</label>
                        <input type="text" name="contact_address" class="form-control" placeholder="e.g., 123 Main St, City" style="border-radius: 8px; border: 1px solid #e2e8f0;" value="{{ old('contact_address') }}">
                        @error('contact_address')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <!-- Deadline -->
                    <div class="col-md-6">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Application Deadline *</label>
                        <input type="date" name="deadline" class="form-control" required style="border-radius: 8px; border: 1px solid #e2e8f0;" value="{{ old('deadline') }}">
                        @error('deadline')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-lg" style="background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%); color: white; font-weight: 700; padding: 0.875rem 2.5rem; box-shadow: 0 4px 15px rgba(26, 71, 42, 0.3); border: none;">
                        <i class="fas fa-check-circle"></i> Post Job
                    </button>
                    <a href="{{ route('admin.jobs.index') ?? '#' }}" class="btn btn-lg btn-outline-secondary" style="padding: 0.875rem 2.5rem; font-weight: 600;">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endpush
@section('extra-js')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var latInput = document.getElementById('admin_job_latitude');
        var lngInput = document.getElementById('admin_job_longitude');
        var coordsLabel = document.getElementById('admin-job-map-coords');
        var defaultLat = 16.9964;
        var defaultLng = 120.9736;
        var latValue = parseFloat(latInput.value);
        var lngValue = parseFloat(lngInput.value);
        var hasCoords = Number.isFinite(latValue) && Number.isFinite(lngValue);
        var map = L.map('admin-job-location-map').setView(
            [hasCoords ? latValue : defaultLat, hasCoords ? lngValue : defaultLng],
            hasCoords ? 15 : 13
        );

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker = null;
        if (hasCoords) {
            marker = L.marker([latValue, lngValue]).addTo(map);
            coordsLabel.textContent = 'Pin set at ' + latValue.toFixed(6) + ', ' + lngValue.toFixed(6);
        }

        map.on('click', function (e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            if (!marker) {
                marker = L.marker([lat, lng]).addTo(map);
            } else {
                marker.setLatLng([lat, lng]);
            }
            latInput.value = lat.toFixed(6);
            lngInput.value = lng.toFixed(6);
            coordsLabel.textContent = 'Pin set at ' + lat.toFixed(6) + ', ' + lng.toFixed(6);
        });
    });
</script>
@endsection
