@extends('admin.layout')
@section('title','Alumni Management')
@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 style="font-size: 2rem; font-weight: 800; color: var(--primary-color);">
                <i class="fas fa-users"></i> Alumni Management
            </h2>
            <p class="text-muted mb-0">Manage and monitor all registered alumni</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
        <div class="card-body">
            <form class="row g-3" method="GET" action="{{ route('admin.alumni.index') }}">
                <div class="col-md-4">
                    <label class="form-label fw-600">Search Alumni</label>
                    <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ $search }}" style="border-radius: 8px;">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-600">Status</label>
                    <select name="status" class="form-select" style="border-radius: 8px;">
                        <option value="">All Status</option>
                        <option value="verified" {{ $status === 'verified' ? 'selected' : '' }}>Verified</option>
                        <option value="unverified" {{ $status === 'unverified' ? 'selected' : '' }}>Unverified</option>
                        <option value="inactive" {{ $status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100" style="border-radius: 8px;">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Alumni Table -->
    <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
        <div class="card-body p-0">
            @if($alumni->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="border-collapse: separate; border-spacing: 0;">
                    <thead style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white;">
                        <tr>
                            <th style="padding: 1rem; border: none; font-weight: 700;">Photo</th>
                            <th style="padding: 1rem; border: none; font-weight: 700;">Name</th>
                            <th style="padding: 1rem; border: none; font-weight: 700;">Email</th>
                            <th style="padding: 1rem; border: none; font-weight: 700;">Contact</th>
                            <th style="padding: 1rem; border: none; font-weight: 700;">Batch</th>
                            <th style="padding: 1rem; border: none; font-weight: 700;">Address</th>
                            <th style="padding: 1rem; border: none; font-weight: 700; text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumni as $alumnus)
                        <tr style="border-bottom: 1px solid #e2e8f0; transition: background 0.2s;">
                            <td style="padding: 1rem; vertical-align: middle;">
                                @if($alumnus->alumniProfile && $alumnus->alumniProfile->profile_picture)
                                    <img src="{{ asset('storage/' . $alumnus->alumniProfile->profile_picture) }}" 
                                         alt="{{ $alumnus->name }}" 
                                         style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover; border: 2px solid var(--accent-gold);">
                                @else
                                    <img src="{{ asset('images/logo_mpsu.png') }}" 
                                         alt="{{ $alumnus->name }}" 
                                         style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover; border: 2px solid var(--accent-gold); background: white; padding: 5px;">
                                @endif
                            </td>
                            <td style="padding: 1rem; vertical-align: middle;">
                                <div style="font-weight: 600; color: var(--primary-color);">{{ $alumnus->name }}</div>
                                @if($alumnus->is_verified)
                                    <span style="display: inline-block; padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.7rem; font-weight: 600; background: #ecfdf5; color: #065f46; margin-top: 0.25rem;">
                                        <i class="fas fa-check-circle"></i> Verified
                                    </span>
                                @else
                                    <span style="display: inline-block; padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.7rem; font-weight: 600; background: #fef2f2; color: #991b1b; margin-top: 0.25rem;">
                                        <i class="fas fa-times-circle"></i> Unverified
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 1rem; vertical-align: middle;">
                                <div style="font-size: 0.9rem; color: #64748b;">
                                    <i class="fas fa-envelope" style="color: var(--accent-gold);"></i> {{ $alumnus->email }}
                                </div>
                            </td>
                            <td style="padding: 1rem; vertical-align: middle;">
                                @if($alumnus->alumniProfile && $alumnus->alumniProfile->phone)
                                    <div style="font-size: 0.9rem; color: #64748b;">
                                        <i class="fas fa-phone" style="color: var(--accent-gold);"></i> {{ $alumnus->alumniProfile->phone }}
                                    </div>
                                @else
                                    <span style="color: #94a3b8; font-size: 0.85rem;">Not provided</span>
                                @endif
                            </td>
                            <td style="padding: 1rem; vertical-align: middle;">
                                @if($alumnus->alumniProfile && $alumnus->alumniProfile->batch)
                                    <div style="font-size: 0.9rem; color: #64748b;">
                                        <i class="fas fa-graduation-cap" style="color: var(--accent-gold);"></i> {{ $alumnus->alumniProfile->batch->year }}
                                    </div>
                                @else
                                    <span style="color: #94a3b8; font-size: 0.85rem;">Not provided</span>
                                @endif
                            </td>
                            <td style="padding: 1rem; vertical-align: middle;">
                                @if($alumnus->alumniProfile && ($alumnus->alumniProfile->address || $alumnus->alumniProfile->city || $alumnus->alumniProfile->province))
                                    <div style="font-size: 0.9rem; color: #64748b; max-width: 200px;">
                                        <i class="fas fa-map-marker-alt" style="color: var(--accent-gold);"></i>
                                        {{ implode(', ', array_filter([$alumnus->alumniProfile->address, $alumnus->alumniProfile->city, $alumnus->alumniProfile->province])) }}
                                    </div>
                                @else
                                    <span style="color: #94a3b8; font-size: 0.85rem;">Not provided</span>
                                @endif
                            </td>
                            <td style="padding: 1rem; vertical-align: middle; text-align: center;">
                                <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                    <a href="{{ route('admin.alumni.show', $alumnus->id) }}" class="btn btn-sm" style="background: var(--accent-gold); color: var(--primary-color); border: none; padding: 0.4rem 0.8rem; border-radius: 6px; font-weight: 600;">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    @if (!$alumnus->is_verified)
                                        <form action="{{ route('admin.alumni.verify', $alumnus->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" style="padding: 0.4rem 0.8rem; border-radius: 6px; font-weight: 600;">
                                                <i class="fas fa-check"></i> Approve
                                            </button>
                                        </form>
                                    @endif
                                    <button type="button" class="btn btn-sm btn-danger" style="padding: 0.4rem 0.8rem; border-radius: 6px; font-weight: 600;" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $alumnus->id }}">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                    
                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteModal{{ $alumnus->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $alumnus->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.15);">
                                                <div class="modal-header" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; border: none; border-radius: 12px 12px 0 0;">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $alumnus->id }}">
                                                        <i class="fas fa-exclamation-triangle"></i> Confirm Deletion
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="padding: 2rem;">
                                                    <div class="text-center mb-3">
                                                        <i class="fas fa-user-times fa-3x text-danger mb-3"></i>
                                                        <h5 class="mb-3">Are you sure you want to delete this alumni?</h5>
                                                        <div class="alert alert-warning" style="border-radius: 8px; background-color: #fff3cd; border-left: 4px solid #ffc107;">
                                                            <strong>{{ $alumnus->name }}</strong><br>
                                                            <small class="text-muted">{{ $alumnus->email }}</small>
                                                        </div>
                                                        <p class="text-danger mb-0"><small><i class="fas fa-info-circle"></i> This action cannot be undone.</small></p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="border: none; padding: 1rem 2rem 2rem;">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px; padding: 0.5rem 1.5rem; font-weight: 600;">
                                                        <i class="fas fa-times"></i> Cancel
                                                    </button>
                                                    <form action="{{ route('admin.alumni.delete', $alumnus->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" style="border-radius: 8px; padding: 0.5rem 1.5rem; font-weight: 600;">
                                                            <i class="fas fa-trash"></i> Delete Alumni
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-3 border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Showing {{ $alumni->firstItem() }} to {{ $alumni->lastItem() }} of {{ $alumni->total() }} alumni
                    </div>
                    <div>
                        {{ $alumni->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-users fa-3x mb-3" style="color: #cbd5e1;"></i>
                <h5 class="text-muted">No Alumni Found</h5>
                <p class="text-muted mb-0">No alumni match your search criteria.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
