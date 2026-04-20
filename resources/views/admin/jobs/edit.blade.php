@extends('admin.layout')
@section('title','Edit Job')
@section('content')
<div class="container">
  <h1 class="mb-4">Edit Job</h1>
  <div class="card p-4">
    <form action="{{ route('admin.jobs.update', $job->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="row g-4">
        <div class="col-md-6">
          <label class="form-label fw-600">Job Title *</label>
          <input type="text" name="title" class="form-control" required value="{{ old('title', $job->title) }}">
        </div>
        <div class="col-md-6">
          <label class="form-label fw-600">Company Name *</label>
          <input type="text" name="company_name" class="form-control" required value="{{ old('company_name', $job->company_name) }}">
        </div>
        <div class="col-md-6">
          <label class="form-label fw-600">Location *</label>
          <input type="text" name="location" class="form-control" required value="{{ old('location', $job->location) }}">
        </div>
        <div class="col-12">
          <label class="form-label fw-600">Office Location on Map</label>
          <div id="admin-job-location-map" style="height: 240px; border-radius: 12px; border: 1px solid #e2e8f0;"></div>
          <div id="admin-job-map-coords" style="font-size: 0.85rem; color: #64748b; margin-top: 0.5rem;">
            Click on the map to set or update the office location.
          </div>
          <input type="hidden" id="admin_job_latitude" name="latitude" value="{{ old('latitude', $job->latitude) }}">
          <input type="hidden" id="admin_job_longitude" name="longitude" value="{{ old('longitude', $job->longitude) }}">
        </div>
        <div class="col-md-6">
          <label class="form-label fw-600">Job Type *</label>
          <select name="position_type" class="form-select" required>
            <option value="Full-time" {{ old('position_type', $job->position_type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
            <option value="Part-time" {{ old('position_type', $job->position_type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
            <option value="Contract" {{ old('position_type', $job->position_type) == 'Contract' ? 'selected' : '' }}>Contract</option>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label fw-600">Minimum Salary ()</label>
          <input type="number" name="salary_min" class="form-control" value="{{ old('salary_min', $job->salary_min) }}">
        </div>
        <div class="col-md-6">
          <label class="form-label fw-600">Maximum Salary ()</label>
          <input type="number" name="salary_max" class="form-control" value="{{ old('salary_max', $job->salary_max) }}">
        </div>
        <div class="col-12">
          <label class="form-label fw-600">Requirements</label>
          <textarea name="requirements" class="form-control" rows="3">{{ old('requirements', $job->requirements) }}</textarea>
        </div>
        <div class="col-12">
          <label class="form-label fw-600">Job Description *</label>
          <textarea name="description" class="form-control" rows="6" required>{{ old('description', $job->description) }}</textarea>
        </div>
        <div class="col-md-6">
          <label class="form-label fw-600">Contact Email *</label>
          <input type="email" name="contact_email" class="form-control" required value="{{ old('contact_email', $job->contact_email) }}">
        </div>
        <div class="col-md-6">
          <label class="form-label fw-600">Contact Phone</label>
          <input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $job->contact_phone) }}">
        </div>
        <div class="col-md-6">
          <label class="form-label fw-600">Contact Website</label>
          <input type="url" name="contact_website" class="form-control" value="{{ old('contact_website', $job->contact_website) }}">
        </div>
        <div class="col-md-6">
          <label class="form-label fw-600">Contact Address</label>
          <input type="text" name="contact_address" class="form-control" value="{{ old('contact_address', $job->contact_address) }}">
        </div>
        <div class="col-md-6">
          <label class="form-label fw-600">Application Deadline *</label>
          <input type="date" name="deadline" class="form-control" required value="{{ old('deadline', $job->deadline ? $job->deadline->format('Y-m-d') : '') }}">
        </div>
        <div class="col-md-6">
          <label class="form-label fw-600">Approval Status</label>
          <select name="approval_status" class="form-select">
            <option value="approved" {{ old('approval_status', $job->approval_status) == 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="pending" {{ old('approval_status', $job->approval_status) == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="rejected" {{ old('approval_status', $job->approval_status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
          </select>
        </div>
      </div>
      <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-success px-4">Update Job</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">Cancel</a>
      </div>
    </form>
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
