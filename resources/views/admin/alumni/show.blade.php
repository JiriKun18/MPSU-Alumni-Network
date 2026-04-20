@extends('admin.layout')
@section('title','View Alumni')
@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 style="font-size: 2rem; font-weight: 800; color: var(--primary-color);">Alumni Details</h2>
      <p class="text-muted mb-0">Review alumni profile and verification documents</p>
    </div>
    @if (!$user->is_verified)
      <div class="d-flex gap-2">
        <form action="{{ route('admin.alumni.verify', $user->id) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-success" style="border-radius: 8px; font-weight: 600;">
            <i class="fas fa-check"></i> Verify
          </button>
        </form>
        <form action="{{ route('admin.alumni.deactivate', $user->id) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-danger" style="border-radius: 8px; font-weight: 600;">
            <i class="fas fa-times"></i> Decline
          </button>
        </form>
      </div>
    @endif
  </div>

  <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
    <div class="card-body">
      <div class="row">
        <div class="col-md-4">
          <div class="mb-3">
            <strong>Name</strong>
            <div>{{ $user->name }}</div>
          </div>
          <div class="mb-3">
            <strong>Email</strong>
            <div>{{ $user->email }}</div>
          </div>
          <div class="mb-3">
            <strong>Status</strong>
            <div>
              @if ($user->is_verified)
                <span class="badge bg-success">Verified</span>
              @else
                <span class="badge bg-warning text-dark">Unverified</span>
              @endif
            </div>
          </div>
          <div class="mb-3">
            <strong>Active</strong>
            <div>
              @if ($user->is_active)
                <span class="badge bg-success">Active</span>
              @else
                <span class="badge bg-secondary">Inactive</span>
              @endif
            </div>
          </div>
          @if ($profile)
            <div class="mb-3">
              <strong>Student ID</strong>
              <div>{{ $profile->student_id ?? 'Not provided' }}</div>
            </div>
            <div class="mb-3">
              <strong>Course</strong>
              <div>{{ $profile->course ?? 'Not provided' }}</div>
            </div>
          @endif
        </div>
        <div class="col-md-8">
          <h5 class="mb-3">Verification Documents</h5>
          @if ($profile && !empty($profile->verification_documents))
            <ul class="mb-0">
              @foreach ($profile->verification_documents as $doc)
                <li>
                  <a href="{{ asset('storage/' . $doc) }}" target="_blank" rel="noopener noreferrer">View document</a>
                </li>
              @endforeach
            </ul>
          @else
            <p class="text-muted mb-0">No verification documents uploaded.</p>
          @endif
          @if ($profile)
            <hr>
            <h5 class="mb-3">Profile Summary</h5>
            <div class="row">
              <div class="col-md-6 mb-3">
                <strong>Phone</strong>
                <div>{{ $profile->phone ?? 'Not provided' }}</div>
              </div>
              <div class="col-md-6 mb-3">
                <strong>Birthdate</strong>
                <div>{{ $profile->date_of_birth ?? 'Not provided' }}</div>
              </div>
              <div class="col-md-6 mb-3">
                <strong>Present Address</strong>
                <div>{{ $profile->present_address ?? 'Not provided' }}</div>
              </div>
              <div class="col-md-6 mb-3">
                <strong>Permanent Address</strong>
                <div>{{ $profile->permanent_address ?? 'Not provided' }}</div>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
