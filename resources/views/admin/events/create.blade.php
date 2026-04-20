@extends('admin.layout')
@section('title','Create Event')
@section('content')
<div class="container-fluid py-4">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.events.index') ?? '#' }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Events
        </a>
        <div>
            <h2 style="font-size: 2rem; font-weight: 800; color: var(--primary-color);">
                <i class="fas fa-calendar-plus"></i> Create New Event
            </h2>
            <p class="text-muted mb-0">Organize an alumni event or activity</p>
        </div>
    </div>

    <div class="card" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
        <div class="card-body p-4">
            <form action="{{ route('admin.events.store') ?? '#' }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-4">
                    <!-- Event Title -->
                    <div class="col-12">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Event Title *</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g., MPSU Alumni Homecoming 2026" required style="border-radius: 8px; border: 1px solid #e2e8f0; font-size: 1.1rem;" value="{{ old('title') }}">
                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Event Date & Time -->
                    <div class="col-md-6">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Event Date *</label>
                        <input type="date" name="event_date" class="form-control" required style="border-radius: 8px; border: 1px solid #e2e8f0;" value="{{ old('event_date') }}">
                        @error('event_date')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Event Time *</label>
                        <input type="time" name="event_time" class="form-control" required style="border-radius: 8px; border: 1px solid #e2e8f0;" value="{{ old('event_time') }}">
                        @error('event_time')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Venue -->
                    <div class="col-12">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Venue *</label>
                        <input type="text" name="venue" class="form-control" placeholder="e.g., MPSU Campus, Bontoc" required style="border-radius: 8px; border: 1px solid #e2e8f0;" value="{{ old('venue') }}">
                        @error('venue')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Event Image -->
                    <div class="col-12">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Event Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" style="border-radius: 8px; border: 1px solid #e2e8f0;">
                        <small class="text-muted">Recommended: 1200x600px (Max: 2MB)</small>
                        @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Gallery Images -->
                    <div class="col-12">
                        <label class="form-label fw-600" style="color: var(--primary-color);">More Images (Gallery)</label>
                        <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple style="border-radius: 8px; border: 1px solid #e2e8f0;">
                        <small class="text-muted">You can upload multiple images (Max: 2MB each)</small>
                        @error('gallery_images.*')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Event Description -->
                    <div class="col-12">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Event Description *</label>
                        <textarea name="description" class="form-control" rows="8" placeholder="Provide detailed information about the event, agenda, and what attendees should bring" required style="border-radius: 8px; border: 1px solid #e2e8f0;">{{ old('description') }}</textarea>
                        @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-lg" style="background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%); color: white; font-weight: 700; padding: 0.875rem 2.5rem; box-shadow: 0 4px 15px rgba(26, 71, 42, 0.3); border: none;">
                        <i class="fas fa-check-circle"></i> Create Event
                    </button>
                    <a href="{{ route('admin.events.index') ?? '#' }}" class="btn btn-lg btn-outline-secondary" style="padding: 0.875rem 2.5rem; font-weight: 600;">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
