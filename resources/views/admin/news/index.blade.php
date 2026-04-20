@extends('admin.layout')
@section('title','News Management')
@section('content')
<div class="container-fluid py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0" style="font-size: 2rem; font-weight: 800; color: var(--admin-primary);">
      <i class="fas fa-newspaper"></i> News Management
    </h1>
    <a href="{{ route('admin.news.create') }}" class="btn" style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white; font-weight: 600; padding: 0.75rem 1.5rem;">
      <i class="fas fa-plus-circle"></i> Publish News
    </a>
  </div>

  <!-- Search and Filter -->
  <div class="card mb-3" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
    <div class="card-body">
      <form method="GET" action="{{ route('admin.news.index') }}">
        <div class="row g-3">
          <div class="col-md-6">
            <input type="text" name="search" class="form-control" placeholder="Search news..." value="{{ $search ?? '' }}">
          </div>
          <div class="col-md-4">
            <select name="status" class="form-select">
              <option value="">All Status</option>
              <option value="published" {{ ($status ?? '') == 'published' ? 'selected' : '' }}>Published</option>
              <option value="draft" {{ ($status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
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

  <!-- News Table -->
  <div class="card" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
    <div class="card-body">
      @if($news->count() > 0)
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Image</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Title</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Status</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Published</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Created</th>
                <th style="background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%); color: white;">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($news as $item)
                <tr>
                  <td>
                    @if($item->featured_image)
                      <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                    @else
                      <div style="width: 60px; height: 60px; background: #e2e8f0; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-newspaper text-muted"></i>
                      </div>
                    @endif
                  </td>
                  <td>
                    <strong>{{ $item->title }}</strong><br>
                    <small class="text-muted">{{ Str::limit(strip_tags($item->content), 60) }}</small>
                  </td>
                  <td>
                    @if($item->is_published)
                      Published
                    @else
                      Draft
                    @endif
                  </td>
                  <td>{{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('M d, Y') : 'N/A' }}</td>
                  <td>{{ $item->created_at->diffForHumans() }}</td>
                  <td>
                    <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-sm" style="background: var(--admin-gold); color: white;">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.news.delete', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
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
          {{ $news->links() }}
        </div>
      @else
        <div class="text-center py-5">
          <i class="fas fa-newspaper" style="font-size: 4rem; color: #ccc;"></i>
          <p class="mt-3 text-muted">No news articles yet. Click "Publish News" to create one.</p>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
