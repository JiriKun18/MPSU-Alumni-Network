@extends('admin.layout')
@section('title','Edit News')
@section('content')
<div class="container-fluid py-4">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.news.index') ?? '#' }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to News
        </a>
        <div>
            <h2 style="font-size: 2rem; font-weight: 800; color: var(--primary-color);">
                <i class="fas fa-newspaper"></i> Edit News Article
            </h2>
            <p class="text-muted mb-0">Update news content and publish status</p>
        </div>
    </div>

    <div class="card" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
        <div class="card-body p-4">
            <form action="{{ route('admin.news.update', $news->id) ?? '#' }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    <!-- Title -->
                    <div class="col-12">
                        <label class="form-label fw-600" style="color: var(--primary-color);">News Title *</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g., MPSU Launches New Alumni Portal" required style="border-radius: 8px; border: 1px solid #e2e8f0; font-size: 1.1rem;" value="{{ old('title', $news->title) }}">
                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Featured Image -->
                    <div class="col-12">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Featured Image</label>
                        @if($news->featured_image)
                            <div class="mb-3">
                                <p class="mb-2">Current image:</p>
                                <img src="{{ asset('storage/' . $news->featured_image) }}" alt="Featured Image" style="max-width: 300px; border-radius: 8px;">
                            </div>
                        @endif
                        <input type="file" name="featured_image" class="form-control" accept="image/*" style="border-radius: 8px; border: 1px solid #e2e8f0;">
                        <small class="text-muted">Recommended: 1200x600px (Max: 2MB) - Leave empty to keep current image</small>
                        @error('featured_image')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Gallery Images -->
                    <div class="col-12">
                        <label class="form-label fw-600" style="color: var(--primary-color);">More Images (Gallery)</label>
                        @if($news->images && $news->images->count())
                            <div class="mb-3 d-flex flex-wrap gap-2">
                                @foreach($news->images as $image)
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gallery image" style="width: 110px; height: 80px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0;">
                                @endforeach
                            </div>
                        @endif
                        <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple style="border-radius: 8px; border: 1px solid #e2e8f0;">
                        <small class="text-muted">Add more images (Max: 2MB each) - Existing images stay</small>
                        @error('gallery_images.*')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Content -->
                    <div class="col-12">
                        <label class="form-label fw-600" style="color: var(--primary-color);">Content *</label>
                        <textarea name="content" class="form-control" rows="10" placeholder="Write your news article here..." required style="border-radius: 8px; border: 1px solid #e2e8f0;">{{ old('content', $news->content) }}</textarea>
                        @error('content')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Publish Status -->
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_published" id="isPublished" value="1" {{ old('is_published', $news->is_published) ? 'checked' : '' }}>
                            <label class="form-check-label fw-600" for="isPublished" style="color: var(--primary-color);">
                                Publish (make visible to alumni)
                            </label>
                        </div>
                        @error('is_published')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- Publication Info -->
                    @if($news->published_at)
                        <div class="col-12">
                            <div class="alert alert-info alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                                <i class="fas fa-info-circle"></i> Published on: <strong>{{ $news->published_at->format('M d, Y g:i A') }}</strong>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Buttons -->
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-lg" style="background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%); color: white; font-weight: 700; padding: 0.875rem 2.5rem; box-shadow: 0 4px 15px rgba(26, 71, 42, 0.3); border: none;">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                    <a href="{{ route('admin.news.index') ?? '#' }}" class="btn btn-lg btn-outline-secondary" style="padding: 0.875rem 2.5rem; font-weight: 600;">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
