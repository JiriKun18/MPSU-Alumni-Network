@extends('admin.layout')

@section('content')
<style>
    .admin-alumni-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .admin-alumni-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(26, 71, 42, 0.2);
    }

    .admin-alumni-photo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 12px;
        border: 3px solid #d4af37;
    }

    .admin-alumni-initials {
        width: 120px;
        height: 120px;
        border-radius: 12px;
        background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%);
        border: 3px solid #d4af37;
        font-size: 3rem;
        font-weight: 700;
    }

    .admin-alumni-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1a472a;
    }

    .admin-alumni-meta {
        font-size: 0.85rem;
        color: #64748b;
        margin-bottom: 0.5rem;
    }

    .admin-status-badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .admin-status-employed {
        background: #ecfdf5;
        color: #065f46;
    }

    .admin-status-unemployed {
        background: #fef2f2;
        color: #991b1b;
    }

    .admin-status-self-employed {
        background: #fef3c7;
        color: #92400e;
    }

    .admin-status-contractual {
        background: #ede9fe;
        color: #5b21b6;
    }

    .admin-view-details-btn {
        margin-top: auto;
        background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%);
        border: none;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .admin-view-details-btn:hover {
        background: linear-gradient(135deg, #0f2618 0%, #1f380b 100%);
        transform: translateY(-2px);
        color: white;
    }

    .view-toggle-btn {
        padding: 0.5rem 1.25rem;
        border: 2px solid #2d5016;
        border-radius: 8px;
        background: white;
        color: #2d5016;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .view-toggle-btn.active {
        background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%);
        color: white;
        border-color: #2d5016;
    }

    .view-toggle-btn:hover {
        background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%);
        color: white;
    }

    .admin-alumni-list-item {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 1.25rem;
        margin-bottom: 1rem;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        background: white;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(26, 71, 42, 0.08);
    }

    .admin-alumni-list-item:hover {
        transform: translateX(8px);
        box-shadow: 0 4px 15px rgba(26, 71, 42, 0.15);
    }

    .admin-alumni-list-photo {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #d4af37;
        flex-shrink: 0;
    }

    .admin-alumni-list-initials {
        width: 80px;
        height: 80px;
        border-radius: 10px;
        background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%);
        border: 2px solid #d4af37;
        font-size: 2rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    .admin-alumni-list-content {
        flex: 1;
        min-width: 0;
    }

    .alumni-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        box-shadow: 0 2px 8px rgba(26, 71, 42, 0.08);
        border-radius: 12px;
        overflow: hidden;
    }

    .alumni-table thead {
        background: linear-gradient(135deg, #1a472a 0%, #2d5016 100%);
        color: white;
    }

    .alumni-table th {
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        border-bottom: 2px solid #d4af37;
    }

    .alumni-table td {
        padding: 1rem;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: middle;
    }

    .alumni-table tbody tr:hover {
        background-color: #f0fdf4;
    }

    .alumni-table tbody tr:last-child td {
        border-bottom: none;
    }

    .alumni-photo-cell {
        width: 80px;
    }

    .alumni-photo-cell img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #d4af37;
    }

    .alumni-name-cell {
        font-weight: 600;
        color: #1a472a;
    }

    .alumni-contact-cell {
        font-size: 0.9rem;
        color: #64748b;
    }

    .alumni-course-cell {
        font-size: 0.9rem;
    }

    .alumni-address-cell {
        font-size: 0.9rem;
        color: #64748b;
    }

    .alumni-actions-cell {
        white-space: nowrap;
    }

    .search-suggestions {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        max-height: 300px;
        overflow-y: auto;
        z-index: 1000;
        margin-top: 4px;
    }

    .search-suggestion-item {
        padding: 0.75rem 1rem;
        cursor: pointer;
        border-bottom: 1px solid #f1f5f9;
        transition: background-color 0.2s;
    }

    .search-suggestion-item:last-child {
        border-bottom: none;
    }

    .search-suggestion-item:hover {
        background-color: #f8fafc;
    }

    .search-suggestion-item.active {
        background-color: #e0f2fe;
    }

    .search-suggestion-name {
        font-weight: 600;
        color: #1a472a;
        margin-bottom: 0.25rem;
    }

    .search-suggestion-email {
        font-size: 0.875rem;
        color: #64748b;
    }

    .search-suggestions-loading {
        padding: 1rem;
        text-align: center;
        color: #64748b;
        font-size: 0.875rem;
    }

    .search-suggestions-empty {
        padding: 1rem;
        text-align: center;
        color: #94a3b8;
        font-size: 0.875rem;
    }
</style>

<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="display-6 fw-bold mb-2" style="color: #1a472a;">
                    <i class="fas fa-users-cog"></i> Alumni Management
                </h1>
                <p class="text-muted mb-0">Complete alumni database with full details</p>
            </div>
            <div class="d-flex gap-2">
                <button class="view-toggle-btn" onclick="switchView('grid')" id="gridBtn">
                    <i class="fas fa-th"></i> Grid
                </button>
                <button class="view-toggle-btn active" onclick="switchView('list')" id="listBtn">
                    <i class="fas fa-list"></i> List
                </button>
                <div style="border-left: 1px solid #e2e8f0; margin: 0 1rem;"></div>
                <button class="view-toggle-btn {{ request('verified') === 'verified' ? 'active' : '' }}" onclick="switchVerification('verified')" id="verifiedBtn">
                    <i class="fas fa-check-circle"></i> Verified
                </button>
                <button class="view-toggle-btn {{ request('verified') === 'unverified' ? 'active' : '' }}" onclick="switchVerification('unverified')" id="unverifiedBtn">
                    <i class="fas fa-times-circle"></i> Unverified
                </button>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card shadow-sm mb-4" style="border-radius: 12px; border: 1px solid #e2e8f0;">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.alumni-directory.index') }}" id="filterForm">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-600 mb-2"><i class="fas fa-search"></i> Search</label>
                        <div style="position: relative;">
                            <input type="text" name="search" id="searchInput" class="form-control" placeholder="Name or email..." value="{{ request('search') }}" style="border-radius: 8px;" autocomplete="off">
                            <div id="searchSuggestions" class="search-suggestions" style="display: none;"></div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-600 mb-2"><i class="fas fa-graduation-cap"></i> Batch</label>
                        <select name="batch" class="form-select" style="border-radius: 8px;">
                            <option value="">All Batches</option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}" {{ request('batch') == $batch->id ? 'selected' : '' }}>
                                    Batch {{ $batch->year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-600 mb-2"><i class="fas fa-book"></i> Course</label>
                        <select name="course" class="form-select" style="border-radius: 8px;">
                            <option value="">All Courses</option>
                            @foreach($courses as $course)
                                <option value="{{ $course }}" {{ request('course') == $course ? 'selected' : '' }}>
                                    {{ $course }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="d-flex gap-2 w-100">
                            <a href="javascript:void(0)" class="btn btn-outline-secondary flex-fill" style="border-radius: 8px;" onclick="printAlumni();">
                                <i class="fas fa-print"></i> Print
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Alumni Grid -->
    @if($alumni->count() > 0)
        <!-- Grid View -->
        <div class="row g-4" id="gridView" style="display: none;">
            @foreach($alumni as $alumnus)
                @php
                    $excludedNames = ['alumni2','alumni3','alumni4','alumni5','alumni6','alumni7','alumni8','alumni9','alumni10'];
                    $addressParts = [];
                    if ($alumnus->alumniProfile) {
                        if ($alumnus->alumniProfile->present_address) $addressParts[] = $alumnus->alumniProfile->present_address;
                        if ($alumnus->alumniProfile->present_city) $addressParts[] = $alumnus->alumniProfile->present_city;
                        if ($alumnus->alumniProfile->present_province) $addressParts[] = $alumnus->alumniProfile->present_province;
                        if ($alumnus->alumniProfile->present_region) $addressParts[] = $alumnus->alumniProfile->present_region;
                        if ($alumnus->alumniProfile->present_country) $addressParts[] = $alumnus->alumniProfile->present_country;
                    }
                    $displayAddress = count($addressParts) > 0 ? implode(', ', $addressParts) : 'Not Provided';
                @endphp
                @if(!in_array($alumnus->name, $excludedNames) && auth()->user()->id !== $alumnus->id)
                    <div class="col-lg-4 col-md-6">
                        <div class="card admin-alumni-card border-0" style="border-top: 4px solid #d4af37; box-shadow: 0 4px 15px rgba(26, 71, 42, 0.08); border-radius: 12px;">
                            <div class="card-body text-center d-flex flex-column">
                                <!-- Photo -->
                                <div class="mb-3">
                                    @if($alumnus->alumniProfile && $alumnus->alumniProfile->profile_picture)
                                        <img src="{{ asset('storage/' . $alumnus->alumniProfile->profile_picture) }}" 
                                             alt="{{ $alumnus->name }}" 
                                             class="admin-alumni-photo">
                                    @else
                                        <img src="{{ asset('images/logo_mpsu.png') }}" 
                                             alt="{{ $alumnus->name }}" 
                                             class="admin-alumni-photo" 
                                             style="background: white; padding: 10px;">
                                    @endif
                                </div>

                                <!-- Name -->
                                <h5 class="admin-alumni-name mb-1">
                                    @if($alumnus->alumniProfile && ($alumnus->alumniProfile->family_name || $alumnus->alumniProfile->given_name))
                                        {{ $alumnus->alumniProfile->family_name }}, {{ $alumnus->alumniProfile->given_name }} {{ $alumnus->alumniProfile->middle_initial }} {{ $alumnus->alumniProfile->suffix }}
                                    @else
                                        {{ $alumnus->name }}
                                    @endif
                                </h5>
                                <!-- Gender & Birthdate -->
                                <div class="admin-alumni-meta">
                                    Sex: {{ $alumnus->alumniProfile->sex ?? ($alumnus->alumniProfile->gender ?? 'N/A') }}<br>
                                    Birthdate: {{ $alumnus->alumniProfile->date_of_birth ? $alumnus->alumniProfile->date_of_birth->format('M d, Y') : 'N/A' }}<br>
                                    Address: {{ $displayAddress }}
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex gap-2 flex-wrap">
                                    <a href="{{ route('admin.alumni-directory.show', $alumnus->id) }}" class="btn btn-sm admin-view-details-btn flex-fill">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                    @if (!$alumnus->is_verified)
                                        <form action="{{ route('admin.alumni-directory.verify', $alumnus->id) }}" method="POST" class="flex-fill">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success w-100" style="font-weight: 600;">
                                                <i class="fas fa-check"></i> Verify
                                            </button>
                                        </form>
                                            <form action="{{ route('admin.alumni-directory.deactivate', $alumnus->id) }}" method="POST" class="flex-fill confirm-action-form"
                                                data-confirm-title="Confirm Deactivation"
                                                data-confirm-message="Decline and deactivate {{ $alumnus->name }}? This will prevent login until reactivated."
                                                data-confirm-button-text="Deactivate User"
                                                data-confirm-button-class="btn-warning">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning w-100" style="font-weight: 600;">
                                                <i class="fas fa-times"></i> Decline
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.alumni-directory.destroy', $alumnus->id) }}" method="POST" 
                                          class="flex-fill confirm-action-form"
                                          data-confirm-title="Confirm Deletion"
                                          data-confirm-message="Are you sure you want to delete {{ $alumnus->name }}? This action cannot be undone."
                                          data-confirm-button-text="Delete User"
                                        data-confirm-button-class="btn-danger">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger w-100" style="font-weight: 600;">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- List View as Table -->
        <div id="listView">
            <table class="alumni-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Photo</th>
                        <th style="width: 18%;">Name</th>
                        <th style="width: 20%;">Course & Year</th>
                        <th style="width: 18%;">Address</th>
                        <th style="width: 14%;">Contact</th>
                        <th style="width: 16%;">Email</th>
                        <th style="width: 14%;">Employment Status</th>
                        <th style="width: 20%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alumni as $alumnus)
                        @php
                            $excludedNames = ['alumni2','alumni3','alumni4','alumni5','alumni6','alumni7','alumni8','alumni9','alumni10'];
                            $addressParts = [];
                            if ($alumnus->alumniProfile) {
                                if ($alumnus->alumniProfile->present_address) $addressParts[] = $alumnus->alumniProfile->present_address;
                                if ($alumnus->alumniProfile->present_city) $addressParts[] = $alumnus->alumniProfile->present_city;
                                if ($alumnus->alumniProfile->present_province) $addressParts[] = $alumnus->alumniProfile->present_province;
                                if ($alumnus->alumniProfile->present_region) $addressParts[] = $alumnus->alumniProfile->present_region;
                                if ($alumnus->alumniProfile->present_country) $addressParts[] = $alumnus->alumniProfile->present_country;
                            }
                            $displayAddress = count($addressParts) > 0 ? implode(', ', $addressParts) : 'Not Provided';
                            $employmentStatus = 'Unemployed';
                            if ($alumnus->alumniProfile && $alumnus->alumniProfile->occupation_type) {
                                $employmentStatus = $alumnus->alumniProfile->occupation_type;
                            } elseif ($alumnus->alumniProfile && $alumnus->alumniProfile->employment_status) {
                                $employmentStatus = $alumnus->alumniProfile->employment_status;
                            }
                            $employmentType = ($alumnus->alumniProfile && $alumnus->alumniProfile->employment_type) ? $alumnus->alumniProfile->employment_type : null;
                        @endphp
                        @if(!in_array($alumnus->name, $excludedNames) && auth()->user()->id !== $alumnus->id)
                            <tr>
                                <!-- Photo -->
                                <td class="alumni-photo-cell">
                                    @if($alumnus->alumniProfile && $alumnus->alumniProfile->profile_picture)
                                        <img src="{{ asset('storage/' . $alumnus->alumniProfile->profile_picture) }}" 
                                             alt="{{ $alumnus->name }}">
                                    @else
                                        <img src="{{ asset('images/logo_mpsu.png') }}" 
                                             alt="{{ $alumnus->name }}" 
                                             style="background: white; padding: 5px;">
                                    @endif
                                </td>
                                
                                <!-- Name -->
                                <td class="alumni-name-cell">
                                    @if($alumnus->alumniProfile && ($alumnus->alumniProfile->family_name || $alumnus->alumniProfile->given_name))
                                        {{ $alumnus->alumniProfile->family_name }}, {{ $alumnus->alumniProfile->given_name }} 
                                        @if($alumnus->alumniProfile->middle_initial){{ $alumnus->alumniProfile->middle_initial }}@endif
                                        @if($alumnus->alumniProfile->suffix){{ $alumnus->alumniProfile->suffix }}@endif
                                    @else
                                        {{ $alumnus->name }}
                                    @endif
                                </td>
                                
                                <!-- Course & Year -->
                                <td class="alumni-course-cell">
                                    @if($alumnus->alumniProfile && $alumnus->alumniProfile->course)
                                        <div><strong>{{ $alumnus->alumniProfile->course }}</strong></div>
                                        @if($alumnus->alumniProfile->batch)
                                            <div class="text-muted">Batch {{ $alumnus->alumniProfile->batch->year }}</div>
                                        @endif
                                    @else
                                        <div class="text-muted">Not specified</div>
                                    @endif
                                </td>

                                <!-- Address -->
                                <td>{{ $displayAddress }}</td>

                                <!-- Contact -->
                                <td class="alumni-contact-cell">
                                    @if($alumnus->alumniProfile && $alumnus->alumniProfile->phone)
                                        <i class="fas fa-phone" style="color: #2d5016; margin-right: 5px;"></i>
                                        <a href="tel:{{ $alumnus->alumniProfile->phone }}" style="color: #1a472a; text-decoration: none;">
                                            {{ $alumnus->alumniProfile->phone }}
                                        </a>
                                    @else
                                        <span class="text-muted">Not Provided</span>
                                    @endif
                                </td>

                                <!-- Email -->
                                <td class="alumni-contact-cell">
                                    @if($alumnus->email)
                                        <i class="fas fa-envelope" style="color: #2d5016; margin-right: 5px;"></i>
                                        <a href="mailto:{{ $alumnus->email }}" style="color: #1a472a; text-decoration: none;">
                                            {{ $alumnus->email }}
                                        </a>
                                    @else
                                        <span class="text-muted">Not Provided</span>
                                    @endif
                                </td>

                                <!-- Employment Status -->
                                <td>
                                    <strong>{{ $employmentStatus }}</strong>
                                    @if($employmentType)
                                        <br><small class="text-muted">{{ $employmentType }}</small>
                                    @endif
                                </td>
                                
                                <!-- Actions -->
                                <td class="alumni-actions-cell">
                                    <div class="d-flex gap-1 flex-column">
                                        <a href="{{ route('admin.alumni-directory.show', $alumnus->id) }}" class="btn btn-sm admin-view-details-btn">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        @if (!$alumnus->is_verified)
                                            <form action="{{ route('admin.alumni-directory.verify', $alumnus->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success w-100" style="font-weight: 600;">
                                                    <i class="fas fa-check"></i> Verify
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.alumni-directory.deactivate', $alumnus->id) }}" method="POST" class="confirm-action-form"
                                                data-confirm-title="Confirm Deactivation"
                                                data-confirm-message="Decline and deactivate {{ $alumnus->name }}? This will prevent login until reactivated."
                                                data-confirm-button-text="Deactivate User"
                                                data-confirm-button-class="btn-warning">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-warning w-100" style="font-weight: 600;">
                                                    <i class="fas fa-times"></i> Decline
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.alumni-directory.destroy', $alumnus->id) }}" method="POST" class="confirm-action-form"
                                              data-confirm-title="Confirm Deletion"
                                              data-confirm-message="Are you sure you want to delete {{ $alumnus->name }}? This action cannot be undone."
                                              data-confirm-button-text="Delete User"
                                              data-confirm-button-class="btn-danger">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger w-100" style="font-weight: 600;">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($alumni->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $alumni->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <div class="alert alert-info text-center py-5" style="border-radius: 12px; border: 1px solid #bae6fd;">
            <i class="fas fa-users fa-3x mb-3" style="color: #0284c7;"></i>
            <h5>No Alumni Found</h5>
            <p class="mb-0">No alumni match your search criteria. Try adjusting your filters.</p>
        </div>
    @endif

</div>

<div class="modal fade" id="actionConfirmModal" tabindex="-1" aria-labelledby="actionConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actionConfirmModalLabel">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0" id="actionConfirmMessage">Are you sure you want to continue?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="actionConfirmButton">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script>
function switchView(view) {
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    const gridBtn = document.getElementById('gridBtn');
    const listBtn = document.getElementById('listBtn');

    if (view === 'grid') {
        gridView.style.display = 'flex';
        listView.style.display = 'none';
        gridBtn.classList.add('active');
        listBtn.classList.remove('active');
    } else {
        gridView.style.display = 'none';
        listView.style.display = 'block';
        listBtn.classList.add('active');
        gridBtn.classList.remove('active');
    }
}

function switchVerification(status) {
    const verifiedBtn = document.getElementById('verifiedBtn');
    const unverifiedBtn = document.getElementById('unverifiedBtn');
    const filterForm = document.getElementById('filterForm');
    
    // Create a new FormData object from the current form
    const formData = new FormData(filterForm);
    
    // Set the verified parameter
    formData.set('verified', status);
    
    // Build query string and redirect
    const params = new URLSearchParams(formData);
    window.location.href = '{{ route('admin.alumni-directory.index') }}?' + params.toString();
}

// Print function
function printAlumni() {
    let printUrl = "{{ route('admin.alumni-directory.print', request()->query()) }}";
    let printWindow = window.open(printUrl, 'printWindow', 'width=900,height=700');
    
    if (printWindow) {
        printWindow.addEventListener('load', function() {
            setTimeout(function() {
                printWindow.print();
            }, 500);
        });
        
        // Close window after user closes print dialog
        setTimeout(function() {
            if (!printWindow.closed) {
                printWindow.close();
            }
        }, 3000);
    }
}

// Set default view to list on page load
document.addEventListener('DOMContentLoaded', function() {
    switchView('list');

    const filterForm = document.getElementById('filterForm');
    const batchSelect = filterForm ? filterForm.querySelector('select[name="batch"]') : null;
    const courseSelect = filterForm ? filterForm.querySelector('select[name="course"]') : null;

    [batchSelect, courseSelect].forEach((selectElement) => {
        if (!selectElement || !filterForm) {
            return;
        }

        selectElement.addEventListener('change', function() {
            filterForm.submit();
        });
    });

    // Search autocomplete functionality
    const searchInput = document.getElementById('searchInput');
    const searchSuggestions = document.getElementById('searchSuggestions');
    let currentFocus = -1;
    let searchTimeout = null;

    if (searchInput && searchSuggestions) {
        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            
            clearTimeout(searchTimeout);
            
            if (query.length < 2) {
                searchSuggestions.style.display = 'none';
                return;
            }

            searchTimeout = setTimeout(() => {
                fetchSuggestions(query);
            }, 300);
        });

        searchInput.addEventListener('keydown', function(e) {
            const items = searchSuggestions.querySelectorAll('.search-suggestion-item');
            
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                currentFocus++;
                addActive(items);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                currentFocus--;
                addActive(items);
            } else if (e.key === 'Enter') {
                if (currentFocus > -1 && items[currentFocus]) {
                    e.preventDefault();
                    items[currentFocus].click();
                }
            } else if (e.key === 'Escape') {
                searchSuggestions.style.display = 'none';
                currentFocus = -1;
            }
        });

        // Close suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchSuggestions.contains(e.target)) {
                searchSuggestions.style.display = 'none';
                currentFocus = -1;
            }
        });

        function fetchSuggestions(query) {
            searchSuggestions.innerHTML = '<div class="search-suggestions-loading"><i class="fas fa-spinner fa-spin"></i> Loading...</div>';
            searchSuggestions.style.display = 'block';

            fetch('{{ route('admin.alumni-directory.search-suggestions') }}?q=' + encodeURIComponent(query))
                .then(response => response.json())
                .then(data => {
                    currentFocus = -1;
                    
                    if (data.length === 0) {
                        searchSuggestions.innerHTML = '<div class="search-suggestions-empty">No results found</div>';
                        return;
                    }

                    let html = '';
                    data.forEach(item => {
                        html += `
                            <div class="search-suggestion-item" data-name="${escapeHtml(item.name)}" data-email="${escapeHtml(item.email)}">
                                <div class="search-suggestion-name">${escapeHtml(item.name)}</div>
                                <div class="search-suggestion-email">${escapeHtml(item.email)}</div>
                            </div>
                        `;
                    });
                    
                    searchSuggestions.innerHTML = html;
                    
                    // Add click listeners to suggestions
                    searchSuggestions.querySelectorAll('.search-suggestion-item').forEach(item => {
                        item.addEventListener('click', function() {
                            searchInput.value = this.dataset.name;
                            searchSuggestions.style.display = 'none';
                            filterForm.submit();
                        });
                    });
                })
                .catch(error => {
                    console.error('Error fetching suggestions:', error);
                    searchSuggestions.innerHTML = '<div class="search-suggestions-empty">Error loading suggestions</div>';
                });
        }

        function addActive(items) {
            if (!items || items.length === 0) return;
            
            removeActive(items);
            
            if (currentFocus >= items.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = items.length - 1;
            
            items[currentFocus].classList.add('active');
            items[currentFocus].scrollIntoView({ block: 'nearest' });
        }

        function removeActive(items) {
            items.forEach(item => item.classList.remove('active'));
        }

        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, m => map[m]);
        }
    }

    const modalElement = document.getElementById('actionConfirmModal');
    const modalTitle = document.getElementById('actionConfirmModalLabel');
    const modalMessage = document.getElementById('actionConfirmMessage');
    const confirmButton = document.getElementById('actionConfirmButton');
    let pendingForm = null;

    const modalInstance = (window.bootstrap && modalElement)
        ? new bootstrap.Modal(modalElement)
        : null;

    document.querySelectorAll('.confirm-action-form').forEach((form) => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            pendingForm = form;
            const title = form.dataset.confirmTitle || 'Confirm Action';
            const message = form.dataset.confirmMessage || 'Are you sure you want to continue?';
            const buttonText = form.dataset.confirmButtonText || 'Confirm';
            const buttonClass = form.dataset.confirmButtonClass || 'btn-danger';

            modalTitle.textContent = title;
            modalMessage.textContent = message;
            confirmButton.textContent = buttonText;
            confirmButton.classList.remove('btn-danger', 'btn-warning', 'btn-success', 'btn-primary');
            confirmButton.classList.add(buttonClass);

            if (modalInstance) {
                modalInstance.show();
            } else {
                if (window.confirm(message)) {
                    pendingForm.submit();
                }
                pendingForm = null;
            }
        });
    });

    confirmButton.addEventListener('click', function() {
        if (!pendingForm) {
            return;
        }

        confirmButton.disabled = true;
        pendingForm.submit();
    });

    if (modalElement) {
        modalElement.addEventListener('hidden.bs.modal', function() {
            pendingForm = null;
            confirmButton.disabled = false;
        });
    }
});
</script>
@endsection
