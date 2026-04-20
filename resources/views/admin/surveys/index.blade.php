@extends('admin.layout')

@section('title', 'Surveys Management - MPSU Alumni Network')

@section('content')
<style>
    .survey-btn-primary {
        background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%);
        border: none;
        color: #ffffff;
        font-weight: 700;
    }

    .survey-btn-primary:hover {
        background: linear-gradient(135deg, var(--admin-secondary) 0%, var(--admin-primary) 100%);
        color: #ffffff;
    }

    .survey-btn-secondary {
        background: #4b5563;
        border: none;
        color: #ffffff;
        font-weight: 600;
    }

    .survey-btn-secondary:hover {
        background: #374151;
        color: #ffffff;
    }

    .survey-count {
        color: var(--admin-text);
        font-weight: 600;
    }
</style>
<div class="admin-page-header">
    <div class="container-fluid">
        <h1 class="admin-page-title"><i class="fas fa-poll"></i> Surveys Management</h1>
        <p class="admin-page-subtitle">Create and manage alumni surveys with statistical analysis</p>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-list"></i> Active Surveys</h5>
                    <a href="{{ route('admin.surveys.create') }}" class="btn btn-sm survey-btn-primary">
                        <i class="fas fa-plus"></i> Create Survey
                    </a>
                </div>
                <div class="card-body">
                    @if ($surveys->count())
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Questions</th>
                                        <th>Responses</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($surveys as $survey)
                                        <tr>
                                            <td>
                                                <strong>{{ $survey->title }}</strong><br>
                                                <small class="text-muted">{{ Str::limit($survey->description, 60) }}</small>
                                            </td>
                                            <td>
                                                <span class="survey-count">{{ $survey->questions_count ?? 0 }}</span>
                                            </td>
                                            <td>
                                                <span class="survey-count">{{ $survey->responses_count }}</span>
                                            </td>
                                            <td>
                                                @if ($survey->is_active)
                                                    <span class="badge bg-success"><i class="fas fa-check"></i> Active</span>
                                                @else
                                                    <span class="badge bg-secondary"><i class="fas fa-pause"></i> Draft</span>
                                                @endif
                                            </td>
                                            <td>{{ $survey->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <div class="d-flex gap-2 flex-wrap">
                                                    <a href="{{ route('admin.surveys.results', $survey) }}" class="btn btn-sm survey-btn-primary">
                                                        <i class="fas fa-chart-bar"></i> Results
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $surveys->links() }}
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-clipboard-list" style="font-size: 3rem; opacity: 0.3;"></i>
                            <h3 class="mt-4 mb-3">No Surveys Yet</h3>
                            <p class="text-muted mb-4">Create your first survey to engage with alumni</p>
                            <a href="{{ route('admin.surveys.create') }}" class="btn survey-btn-primary">
                                <i class="fas fa-plus"></i> Create First Survey
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
