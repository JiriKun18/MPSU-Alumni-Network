@extends('layouts.alumni')
@section('title', 'Post a Job')
@section('content')
<div class="container" style="max-width: 700px;">
    <h2 class="mb-4" style="font-weight: 800; color: #14532d;"><i class="fas fa-plus"></i> Post a Job</h2>
    <form method="POST" action="{{ route('jobs.store') }}">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Job Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="company_name" class="form-label">Company Name</label>
            <input type="text" class="form-control" id="company_name" name="company_name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Job Description</label>
            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="position_type" class="form-label">Position Type</label>
            <select class="form-select" id="position_type" name="position_type" required>
                <option value="">Select Type</option>
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
                <option value="Contract">Contract</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Office Location on Map</label>
            <div id="job-location-map" style="height: 220px; border-radius: 12px; border: 1px solid #e2e8f0;"></div>
            <div id="job-map-coords" style="font-size: 0.85rem; color: #64748b; margin-top: 0.5rem;">
                No pin set yet. Click on the map to set the office location.
            </div>
            <input type="hidden" id="job_latitude" name="latitude" value="{{ old('latitude') }}">
            <input type="hidden" id="job_longitude" name="longitude" value="{{ old('longitude') }}">
        </div>
        <div class="mb-3 row">
            <div class="col">
                <label for="salary_min" class="form-label">Salary Min (₱)</label>
                <input type="number" class="form-control" id="salary_min" name="salary_min" min="0">
            </div>
            <div class="col">
                <label for="salary_max" class="form-label">Salary Max (₱)</label>
                <input type="number" class="form-control" id="salary_max" name="salary_max" min="0">
            </div>
        </div>
        <div class="mb-3">
            <label for="contact_email" class="form-label">Contact Email</label>
            <input type="email" class="form-control" id="contact_email" name="contact_email" required>
        </div>
        <div class="mb-3">
            <label for="contact_phone" class="form-label">Contact Phone</label>
            <input type="text" class="form-control" id="contact_phone" name="contact_phone">
        </div>
        <div class="mb-3">
            <label for="contact_website" class="form-label">Contact Website</label>
            <input type="url" class="form-control" id="contact_website" name="contact_website">
        </div>
        <div class="mb-3">
            <label for="contact_address" class="form-label">Contact Address</label>
            <input type="text" class="form-control" id="contact_address" name="contact_address">
        </div>
        <div class="mb-3">
            <label for="deadline" class="form-label">Closing Date</label>
            <input type="date" class="form-control" id="deadline" name="deadline" required>
        </div>
        <button type="submit" class="btn btn-success w-100" style="font-weight:700;">Submit Job Posting</button>
    </form>
</div>
@endsection
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endpush
@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var latInput = document.getElementById('job_latitude');
        var lngInput = document.getElementById('job_longitude');
        var coordsLabel = document.getElementById('job-map-coords');
        var defaultLat = 16.9964;
        var defaultLng = 120.9736;
        var latValue = parseFloat(latInput.value);
        var lngValue = parseFloat(lngInput.value);
        var hasCoords = Number.isFinite(latValue) && Number.isFinite(lngValue);
        var map = L.map('job-location-map').setView(
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
@endpush
