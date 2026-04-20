@extends('layouts.alumni')
@section('title','News')
@section('content')

<!-- HEADER SECTION -->
<div style="background-color: transparent; padding: 3rem 0; margin-bottom: 2rem;">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center gap-3">
            <div>
                <h1 style="font-size: 2.5rem; font-weight: 900; color: var(--primary-color); margin: 0;">
                    <i class="fas fa-newspaper"></i> News & Updates
                </h1>
                <p style="color: var(--text-secondary); font-size: 1.1rem; margin: 0.5rem 0 0 0;">Latest news from MPSU Alumni Network</p>
            </div>
            <div style="width: 100%; max-width: 520px;">
                <form method="GET" action="{{ route('news.index') }}" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control" placeholder="Search news..." value="{{ $search }}" style="border-radius: 8px;">
                    <button type="submit" class="btn" style="background: var(--primary-color); color: white; border-radius: 8px; padding: 0.5rem 1rem; font-weight: 600; white-space: nowrap; width: auto; flex: 0 0 auto;">
                        <i class="fas fa-search"></i> Search
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- CONTENT SECTION -->
<div class="container-fluid" style="padding-bottom: 4rem;">
    <!-- News Grid -->
    @if($news->count() > 0)
    <div class="row">
        @foreach($news as $article)
        <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card h-100" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: 2px solid var(--primary-color); overflow: hidden; transition: transform 0.3s, box-shadow 0.3s;">
                <!-- Featured Image -->
                @if($article->featured_image)
                    <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="card-img-top" style="height: 280px; width: 100%; object-fit: cover; display: block;">
                    <hr style="margin: 0; border-top: 1px solid rgba(13, 77, 45, 0.25);">
                @else
                    <div style="height: 280px; background: linear-gradient(135deg, var(--primary-color) 0%, #1a6b3d 100%); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-newspaper fa-4x" style="color: rgba(255,255,255,0.3);"></i>
                    </div>
                    <hr style="margin: 0; border-top: 1px solid rgba(13, 77, 45, 0.25);">
                @endif

                <div class="card-body d-flex flex-column">
                    <!-- Title -->
                    <h5 class="card-title mb-2" style="color: var(--primary-color); font-weight: 700; line-height: 1.4;">
                        {{ Str::limit($article->title, 60) }}
                    </h5>

                    <!-- Content Preview -->
                    <p class="card-text text-muted mb-3" style="flex-grow: 1; font-size: 0.9rem;">
                        {{ Str::limit(strip_tags($article->content), 100) }}
                    </p>

                    <!-- Meta Info -->
                    <div style="font-size: 0.85rem; color: #94a3b8; margin-bottom: 1rem;">
                        <i class="fas fa-calendar-alt"></i>
                        {{ $article->published_at?->format('M d, Y') ?? $article->created_at->format('M d, Y') }}
                    </div>

                    <!-- Read More Link -->
                    <a href="{{ route('news.show', $article->id) }}" class="btn btn-sm" style="background: var(--primary-color); color: white; border: none; border-radius: 6px; padding: 0.5rem 1rem; font-weight: 600; align-self: flex-start;">
                        <i class="fas fa-arrow-right"></i> Read More
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $news->links('pagination::bootstrap-4') }}
    </div>

    @else
    <div class="card text-center py-5" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none;">
        <i class="fas fa-newspaper fa-3x mb-3" style="color: #cbd5e1;"></i>
        <h5 class="text-muted mb-2">No News Available</h5>
        <p class="text-muted mb-0">Check back soon for the latest updates from MPSU Alumni Network.</p>
    </div>
    @endif
</div>

@endsection

