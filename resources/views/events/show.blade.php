@extends('layouts.alumni')
@section('title','Event Details')
@section('content')
<style>
.event-main-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
    color: #093b1a;
    line-height: 1.1;
}
.event-meta-info {
    font-size: 1.1rem;
    color: #555;
    margin-bottom: 1.5rem;
}
.event-meta-info i {
    color: #d4af37;
    margin-right: 0.5rem;
}
.event-content {
    font-size: 1.15rem;
    color: #222;
    margin-bottom: 2rem;
}
.event-back-link {
    background: #14532d;
    color: #fff;
    font-weight: 700;
    border: none;
    border-radius: 4px;
    padding: 0.5rem 1.5rem;
    font-size: 1rem;
    transition: background 0.2s;
    text-decoration: none;
}
.event-back-link:hover {
    background: #166534;
    color: #ffd700;
}
.event-sidebar {
    background: #f8fafc;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    padding: 1.5rem 1rem;
    margin-top: 2rem;
}
.event-sidebar-title {
  font-size: 1.25rem;
  font-weight: 700;
  color: #222;
  margin-bottom: 1rem;
  border-bottom: 2px solid #facc15;
  padding-bottom: 0.5rem;
}
.event-sidebar-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.event-sidebar-list li {
    margin-bottom: 0.75rem;
}
.event-sidebar-list a {
  color: #222;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.2s;
}
.event-sidebar-list a:hover {
  color: #facc15;
}
</style>
<div class="container" style="max-width: 1200px;">
  <div class="mb-3">
    <button type="button" class="btn btn-secondary btn-sm event-back-link" onclick="window.history.back()">
      <i class="fa-solid fa-arrow-left-long"></i> Back
    </button>
  </div>
  <div class="row">
    <div class="col-lg-8">
      <div class="card h-100" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none; overflow: hidden; margin-bottom:2rem;">
        @php
          $carouselImages = [];
          if ($event->image) {
              $carouselImages[] = $event->image;
          }
          if ($event->images && $event->images->count()) {
              foreach ($event->images as $img) {
                  $carouselImages[] = $img->image_path;
              }
          }
        @endphp
        @if(count($carouselImages) > 0)
          <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              @foreach($carouselImages as $index => $imgPath)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                  <img src="{{ asset('storage/' . $imgPath) }}" class="d-block w-100" alt="{{ $event->title }}" style="height: 260px; object-fit: cover;">
                </div>
              @endforeach
            </div>
            @if(count($carouselImages) > 1)
              <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            @endif
          </div>
        @else
          <div style="height: 260px; background: linear-gradient(135deg, var(--primary-color) 0%, #1a6b3d 100%); display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-calendar-alt fa-4x" style="color: rgba(255,255,255,0.3);"></i>
          </div>
        @endif
        <div class="card-body d-flex flex-column">
          <h2 class="event-main-title mb-2" style="color: var(--primary-color); font-weight: 800; line-height: 1.2;">{{ $event->title }}</h2>
          <div class="event-meta-info mb-3" style="font-size: 1.1rem; color: #555;">
            <i class="fas fa-calendar-alt"></i>
            {{ $event->event_date ? $event->event_date->format('F d, Y') : '' }}
            &nbsp; | &nbsp;
            <i class="fas fa-map-marker-alt"></i>
            {{ $event->venue ?? 'TBA' }}
          </div>
          <div class="event-content mb-3" style="font-size: 1.15rem; color: #222;">
            {!! nl2br(e($event->description)) !!}
          </div>
        </div>
      </div>
      <!-- Removed duplicate event description and back button -->
    </div>
    <div class="col-lg-4">
      @php
        $recentEvents = \App\Models\Event::where('event_date', '<', now())->where('id', '!=', $event->id)->orderBy('event_date', 'desc')->limit(5)->get();
        $upcomingEvents = \App\Models\Event::where('event_date', '>=', now())->where('id', '!=', $event->id)->orderBy('event_date', 'asc')->limit(5)->get();
      @endphp
      <div class="event-sidebar">
        <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
          <button id="recentTab" class="btn btn-sm" style="background: #facc15; color: #222; font-weight: 700; border-radius: 6px;" onclick="showEvents('recent')">Recent Events</button>
          <button id="upcomingTab" class="btn btn-sm" style="background: #facc15; color: #222; font-weight: 700; border-radius: 6px;" onclick="showEvents('upcoming')">Upcoming Events</button>
        </div>
        <div id="recentEventsList">
          <div class="event-sidebar-title">Recent Events</div>
          <ul class="event-sidebar-list">
            @forelse($recentEvents as $recent)
              <li><a href="{{ route('events.show', $recent->id) }}">{{ $recent->title }}</a></li>
            @empty
              <li>No recent events.</li>
            @endforelse
          </ul>
        </div>
        <div id="upcomingEventsList" style="display:none;">
          <div class="event-sidebar-title">Upcoming Events</div>
          <ul class="event-sidebar-list">
            @forelse($upcomingEvents as $upcoming)
              <li><a href="{{ route('events.show', $upcoming->id) }}">{{ $upcoming->title }}</a></li>
            @empty
              <li>No upcoming events.</li>
            @endforelse
          </ul>
        </div>
      </div>
      <script>
        function showEvents(type) {
          document.getElementById('recentEventsList').style.display = (type === 'recent') ? '' : 'none';
          document.getElementById('upcomingEventsList').style.display = (type === 'upcoming') ? '' : 'none';
          document.getElementById('recentTab').style.background = (type === 'recent') ? '#facc15' : '#f3f4f6';
          document.getElementById('recentTab').style.color = (type === 'recent') ? '#222' : '#222';
          document.getElementById('upcomingTab').style.background = (type === 'upcoming') ? '#facc15' : '#f3f4f6';
          document.getElementById('upcomingTab').style.color = (type === 'upcoming') ? '#222' : '#222';
        }
      </script>
    </div>
  </div>
</div>
@endsection
