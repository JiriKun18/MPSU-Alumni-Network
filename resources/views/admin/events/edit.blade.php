@extends('admin.layout')
@section('title','Edit Event')
@section('content')
<div class="container-fluid py-4">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.events.index') ?? '#' }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Events
        </a>
        <div>
            <h2 style="font-size: 2rem; font-weight: 800; color: var(--primary-color);">
                <i class="fas fa-calendar-edit"></i> Edit Event
            </h2>
            <p class="text-muted mb-0">Update event details and schedule</p>
        </div>
    </div>

    <div class="card" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
        <div class="card-body p-4">
            <form action="{{ route('admin.events.update', $event->id) ?? '#' }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    <!-- Event Title -->
                    <div class="col-12">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Event Title *</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g., MPSU Alumni Homecoming 2026" required style="border-radius: 8px; border: 1px solid #e2e8f0; font-size: 1.1rem;" value="{{ old('title', $event->title) }}">
                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Event Date & Time -->
                    <div class="col-md-6">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Event Date *</label>
                        <input type="date" name="event_date" class="form-control" required style="border-radius: 8px; border: 1px solid #e2e8f0;" value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}">
                        @error('event_date')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Event Time *</label>
                        <input type="time" name="event_time" class="form-control" required style="border-radius: 8px; border: 1px solid #e2e8f0;" value="{{ old('event_time', $event->event_time) }}">
                        @error('event_time')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Venue -->
                    <div class="col-12">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Venue *</label>
                        <input type="text" name="venue" class="form-control" placeholder="e.g., MPSU Campus, Bontoc" required style="border-radius: 8px; border: 1px solid #e2e8f0;" value="{{ old('venue', $event->venue) }}">
                        @error('venue')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Event Status -->
                    <div class="col-12">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Event Status *</label>
                        <select name="status" class="form-select" required style="border-radius: 8px; border: 1px solid #e2e8f0;">
                            <option value="">Select Status</option>
                            <option value="upcoming" {{ old('status', $event->status) === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                            <option value="ongoing" {{ old('status', $event->status) === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="completed" {{ old('status', $event->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status', $event->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Event Image -->
                    <div class="col-12">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Event Image</label>
                        @if($event->image)
                            <div class="mb-3">
                                <p class="mb-2">Current image:</p>
                                <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" style="max-width: 300px; border-radius: 8px;">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*" style="border-radius: 8px; border: 1px solid #e2e8f0;">
                        <small class="text-muted">Recommended: 1200x600px (Max: 2MB) - Leave empty to keep current image</small>
                        @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Gallery Images -->
                    <div class="col-12">
                        <label class="form-label fw-600" style="color: var(--primary-color);">More Images (Gallery)</label>
                        @if($event->images && $event->images->count())
                            <div class="mb-3 d-flex flex-wrap gap-2">
                                @foreach($event->images as $image)
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gallery image" style="width: 110px; height: 80px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0;">
                                @endforeach
                            </div>
                        @endif
                        <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple style="border-radius: 8px; border: 1px solid #e2e8f0;">
                        <small class="text-muted">Add more images (Max: 2MB each) - Existing images stay</small>
                        @error('gallery_images.*')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Event Description -->
                    <div class="col-12">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Event Description *</label>
                        <textarea name="description" class="form-control" rows="8" placeholder="Provide detailed information about the event, agenda, and what attendees should bring" required style="border-radius: 8px; border: 1px solid #e2e8f0;">{{ old('description', $event->description) }}</textarea>
                        @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-lg" style="background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%); color: white; font-weight: 700; padding: 0.875rem 2.5rem; box-shadow: 0 4px 15px rgba(26, 71, 42, 0.3); border: none;">
                        <i class="fas fa-save"></i> Save Changes
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
