@extends('layouts.alumni')
@section('title','Upcoming Events')
@section('content')
<div class="container">
  <h1 class="mb-4" style="font-weight: 800; color: #093b1a;">Upcoming Events</h1>
  @if($events->count())
    <div class="row g-4">
      @foreach($events as $event)
        <div class="col-md-6 col-lg-4 d-flex">
          <div class="event-card w-100">
              @if(!empty($event->image))
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="event-image mb-2" />
              @else
                <div style="height: 120px; background: linear-gradient(135deg, var(--primary-color) 0%, #1a6b3d 100%); display: flex; align-items: center; justify-content: center;">
                  <i class="fas fa-calendar-alt fa-2x" style="color: rgba(255,255,255,0.3);"></i>
                </div>
              @endif
              <div class="event-card-header">
                <h3>{{ $event->title }}</h3>
                <div class="event-meta">
                  <i class="fas fa-calendar-alt"></i>
                  {{ $event->event_date ? $event->event_date->format('F d, Y') : '' }}
                </div>
                <div class="event-meta">
                  <i class="fas fa-map-marker-alt"></i>
                  {{ $event->venue ?? 'TBA' }}
                </div>
              </div>
            <div class="event-card-body">
              <p>{{ Str::limit($event->description, 220) }}</p>
            </div>
            <div class="event-card-footer">
              <a href="{{ route('events.show', $event->id) }}" class="event-read-more">READ MORE <i class="fas fa-angle-double-right"></i></a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="mt-4">
      {{ $events->links() }}
    </div>
  @else
    <div class="alert alert-info">No upcoming events found.</div>
  @endif
</div>
@endsection
