@extends('admin.layout')
@section('title','Events Management')
@section('content')
<div class="container-fluid py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0" style="font-size: 2rem; font-weight: 800; color: var(--admin-primary);">
      <i class="fas fa-calendar-alt"></i> Events Management
    </h1>
    <a href="{{ route('admin.events.create') }}" class="btn" style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white; font-weight: 600; padding: 0.75rem 1.5rem;">
      <i class="fas fa-plus-circle"></i> Create New Event
    </a>
  </div>

  <!-- Search and Filter -->
  <div class="card mb-3" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
    <div class="card-body">
      <form method="GET" action="{{ route('admin.events.index') }}">
        <div class="row g-3">
          <div class="col-md-6">
            <input type="text" name="search" class="form-control" placeholder="Search events..." value="{{ $search ?? '' }}">
          </div>
          <div class="col-md-4">
            <select name="status" class="form-select">
              <option value="">All Status</option>
              <option value="upcoming" {{ ($status ?? '') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
              <option value="ongoing" {{ ($status ?? '') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
              <option value="completed" {{ ($status ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
              <option value="cancelled" {{ ($status ?? '') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn w-100" style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white; font-weight: 600;">
              <i class="fas fa-search"></i> Search
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Events Table -->
  <div class="card" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
    <div class="card-body">
      @if($events->count() > 0)
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Image</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Event Title</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Venue</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Date & Time</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Status</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($events as $event)
                <tr>
                  <td>
                    @if($event->image)
                      <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                    @else
                      <div style="width: 60px; height: 60px; background: #e2e8f0; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-calendar-alt text-muted"></i>
                      </div>
                    @endif
                  </td>
                  <td><strong>{{ $event->title }}</strong></td>
                  <td>{{ $event->venue }}</td>
                  <td>
                    {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}<br>
                    <small class="text-muted">{{ $event->event_time }}</small>
                  </td>
                  <td>{{ ucfirst($event->status ?? 'Upcoming') }}</td>
                  <td>
                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm" style="background: var(--admin-gold); color: white;">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.events.delete', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="mt-3">
          {{ $events->links() }}
        </div>
      @else
        <div class="text-center py-5">
          <i class="fas fa-calendar-alt" style="font-size: 4rem; color: #ccc;"></i>
          <p class="mt-3 text-muted">No events created yet. Click "Create New Event" to add one.</p>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
