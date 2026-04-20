@extends('layouts.alumni')
@section('title', $news->title)
@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="mb-4">
        <button type="button" class="btn btn-secondary btn-sm mb-2" onclick="window.history.back()">
          <i class="fa-solid fa-arrow-left-long"></i> Back
        </button>
        <h1 class="fw-bold" style="color: var(--primary-color);">{{ $news->title }}</h1>
        <div class="text-muted mb-2">
          <i class="fas fa-calendar-alt"></i> {{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->format('F d, Y') : 'Unpublished' }}
          @if($news->author)
            &nbsp;|&nbsp; <i class="fas fa-user"></i> {{ $news->author->name }}
          @endif
        </div>
        @if($news->featured_image)
          <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}" class="img-fluid rounded mb-3" style="max-height: 420px; width: 100%; object-fit: cover;">
        @endif
        <div class="mb-4" style="font-size: 1.15rem; line-height: 1.7; text-align: justify;">
          {!! nl2br(e($news->content)) !!}
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card" style="border-radius: 12px; border: 1px solid rgba(13, 77, 45, 0.2);">
        <div class="card-body">
          <h5 class="fw-bold mb-3" style="color: var(--primary-color);">More Photos</h5>
          @if($news->images && $news->images->count())
            <div class="row g-2">
              @foreach($news->images as $image)
                <div class="col-6">
                  <img src="{{ asset('storage/' . $image->image_path) }}" alt="News image" style="width: 100%; height: 110px; object-fit: cover; border-radius: 8px; border: 1px solid rgba(13, 77, 45, 0.15);">
                </div>
              @endforeach
            </div>
          @else
            <p class="text-muted mb-0">No additional photos.</p>
          @endif
        </div>
      </div>
    </div>
  </div>
  @if($relatedNews && $relatedNews->count())
    <div class="mt-5">
      <h4 class="fw-bold mb-3">Related News</h4>
      <div class="row justify-content-center">
        @foreach($relatedNews as $item)
          <div class="col-md-4 mb-3">
            <div class="card h-100">
              @if($item->featured_image)
                <img src="{{ asset('storage/' . $item->featured_image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 160px; object-fit: cover;">
              @endif
              <div class="card-body">
                <h5 class="card-title">{{ $item->title }}</h5>
                <p class="card-text">{{ $item->getExcerpt(80) }}</p>
                <a href="{{ route('news.show', $item->id) }}" class="btn btn-sm btn-primary">Read More</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @endif
  @php
    $prevNews = \App\Models\News::where('is_published', 1)
        ->where('id', '<', $news->id)
        ->orderByDesc('id')
        ->first();
    $nextNews = \App\Models\News::where('is_published', 1)
        ->where('id', '>', $news->id)
        ->orderBy('id')
        ->first();
  @endphp
  <div class="mt-5 d-flex justify-content-between align-items-center" style="max-width: 700px; margin-left: auto; margin-right: auto;">
    @if($prevNews)
      <a href="{{ route('news.show', $prevNews->id) }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> Previous
      </a>
    @else
      <span class="text-muted">
        <i class="fas fa-arrow-left"></i> Previous
      </span>
    @endif

    @if($nextNews)
      <a href="{{ route('news.show', $nextNews->id) }}" class="btn btn-outline-secondary">
        Next <i class="fas fa-arrow-right"></i>
      </a>
    @else
      <span class="text-muted">
        Next <i class="fas fa-arrow-right"></i>
      </span>
    @endif
  </div>
</div>
@endsection
