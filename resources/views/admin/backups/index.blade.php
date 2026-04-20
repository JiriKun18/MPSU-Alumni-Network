@extends('admin.layout')
@section('title', 'Database Backups')
@section('content')

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 style="font-size: 2rem; font-weight: 800; color: var(--primary-color);">
                <i class="fas fa-database"></i> Database Backups
            </h2>
            <p class="text-muted mb-0">Manage and restore database backups</p>
        </div>
        <div>
            <button class="btn" onclick="createBackupNow()" style="background: var(--primary-color); color: white; border-radius: 8px; padding: 0.7rem 1.5rem; font-weight: 600;">
                <i class="fas fa-download"></i> Backup Now
            </button>
        </div>
    </div>

    <!-- Info Alert -->
    <div class="alert alert-info" style="border-radius: 12px; border-left: 4px solid #0d9488; background-color: #f0fdf4;">
        <i class="fas fa-info-circle"></i>
        <strong>Automatic Backups:</strong> Daily backups are scheduled at 2:00 AM. Old backups (older than 30 days) are automatically deleted.
    </div>

    <!-- Backups Table -->
    <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background: #f8f9fa; border-bottom: 2px solid #e9ecef;">
                        <tr>
                            <th style="padding: 1rem; font-weight: 700; color: var(--primary-color);">Backup File</th>
                            <th style="padding: 1rem; font-weight: 700; color: var(--primary-color);">Created</th>
                            <th style="padding: 1rem; font-weight: 700; color: var(--primary-color);">File Size</th>
                            <th style="padding: 1rem; font-weight: 700; color: var(--primary-color);">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($backups as $backup)
                        <tr style="border-bottom: 1px solid #e9ecef;">
                            <td style="padding: 1rem; vertical-align: middle;">
                                <i class="fas fa-file-archive" style="color: var(--primary-color); margin-right: 0.5rem;"></i>
                                <strong>{{ basename($backup['path']) }}</strong>
                            </td>
                            <td style="padding: 1rem; vertical-align: middle;">
                                <span class="badge" style="background: #e0f2fe; color: #0369a1; padding: 0.4rem 0.8rem; border-radius: 6px;">
                                    {{ $backup['date'] }}
                                </span>
                            </td>
                            <td style="padding: 1rem; vertical-align: middle;">
                                <span style="color: #64748b; font-weight: 600;">{{ $backup['size'] }}</span>
                            </td>
                            <td style="padding: 1rem; vertical-align: middle;">
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="{{ route('admin.backups.download', basename($backup['path'])) }}" class="btn btn-sm" style="background: #10b981; color: white; border: none; padding: 0.4rem 0.8rem; border-radius: 6px; font-weight: 600;">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                    <button onclick="deleteBackup('{{ basename($backup['path']) }}')" class="btn btn-sm btn-danger" style="padding: 0.4rem 0.8rem; border-radius: 6px; font-weight: 600;">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="padding: 2rem; text-align: center; color: #94a3b8;">
                                <i class="fas fa-inbox fa-3x mb-3" style="color: #cbd5e1; opacity: 0.5;"></i>
                                <h5 class="text-muted">No Backups Available</h5>
                                <p class="text-muted mb-0">Click "Backup Now" to create your first backup</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Info Box -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none; text-align: center; padding: 2rem;">
                <i class="fas fa-clock fa-2x mb-3" style="color: var(--primary-color);"></i>
                <h5 style="color: var(--primary-color); font-weight: 700;">Daily Schedule</h5>
                <p class="text-muted mb-0">Backups run automatically every day at 2:00 AM</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none; text-align: center; padding: 2rem;">
                <i class="fas fa-calendar fa-2x mb-3" style="color: #10b981;"></i>
                <h5 style="color: #10b981; font-weight: 700;">30-Day Retention</h5>
                <p class="text-muted mb-0">Old backups are automatically deleted after 30 days</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none; text-align: center; padding: 2rem;">
                <i class="fas fa-shield-alt fa-2x mb-3" style="color: #f59e0b;"></i>
                <h5 style="color: #f59e0b; font-weight: 700;">Data Protection</h5>
                <p class="text-muted mb-0">All data is safely stored and easily recoverable</p>
            </div>
        </div>
    </div>
</div>

<script>
function createBackupNow() {
    if (confirm('Create a backup now? This may take a few moments...')) {
        window.location.href = '{{ route("admin.backups.create") }}';
    }
}

function deleteBackup(filename) {
    if (confirm('Are you sure you want to delete this backup? This action cannot be undone.')) {
        fetch('{{ route("admin.backups.delete", "") }}/' + filename, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Backup deleted successfully');
                location.reload();
            } else {
                alert('Failed to delete backup');
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
</script>

@endsection
