@extends('admin.layout')

@section('title', 'Survey Results - MPSU Alumni Network')

@section('content')
<style>
    .print-only {
        display: none;
    }

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

    @media print {
        .admin-navbar,
        .admin-page-header,
        .no-print {
            display: none !important;
        }

        .print-only {
            display: block;
        }

        .card {
            box-shadow: none !important;
        }
    }
</style>
<div class="admin-page-header">
    <div class="container-fluid">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('admin.surveys.index') }}" class="btn survey-btn-secondary no-print">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <div>
                <h1 class="admin-page-title"><i class="fas fa-chart-bar"></i> {{ $survey->title }}</h1>
                <p class="admin-page-subtitle">Survey Results & Analysis</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="print-only mb-3">
        <h2 style="margin: 0;">{{ $survey->title }}</h2>
        <p style="margin: 0;">Printed on {{ now()->format('M d, Y g:i a') }}</p>
    </div>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h6 class="text-muted">Total Responses</h6>
                            <h3>{{ $responses->count() }}</h3>
                        </div>
                        <div class="col-md-3">
                            <h6 class="text-muted">Total Questions</h6>
                            <h3>{{ $survey->questions->count() }}</h3>
                        </div>
                        <div class="col-md-3">
                            <h6 class="text-muted">Response Rate</h6>
                            <h3>{{ $responses->count() > 0 ? round(($responses->count() / 100) * 100, 2) : 0 }}%</h3>
                        </div>
                        <div class="col-md-3">
                            <h6 class="text-muted">Published</h6>
                            <h3>{{ $survey->published_at?->format('M d, Y') ?? 'Draft' }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 mb-4 no-print">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Filters</h6>
                </div>
                <div class="card-body">
                    <form method="GET" class="d-flex flex-column gap-2">
                        <div>
                            <label class="form-label">By Batch</label>
                            <select name="batch" class="form-select form-select-sm">
                                <option value="">All Batches</option>
                                @foreach ($batchOptions as $batch)
                                    <option value="{{ $batch }}" {{ ($filters['batch'] ?? '') == $batch ? 'selected' : '' }}>
                                        {{ $batch }}
                                    </option>
                                @endforeach
                                @if (!empty($filters['batch']) && !$batchOptions->contains($filters['batch']))
                                    <option value="{{ $filters['batch'] }}" selected>{{ $filters['batch'] }}</option>
                                @endif
                            </select>
                        </div>
                        <div>
                            <label class="form-label">By Course</label>
                            <select name="course" class="form-select form-select-sm">
                                <option value="">All Courses</option>
                                @foreach ($courseOptions as $course)
                                    <option value="{{ $course }}" {{ ($filters['course'] ?? '') == $course ? 'selected' : '' }}>
                                        {{ $course }}
                                    </option>
                                @endforeach
                                @if (!empty($filters['course']) && !$courseOptions->contains($filters['course']))
                                    <option value="{{ $filters['course'] }}" selected>{{ $filters['course'] }}</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="btn btn-sm survey-btn-primary">Apply Filters</button>
                        <a href="{{ route('admin.surveys.results', $survey) }}" class="btn btn-sm survey-btn-secondary">Clear</a>
                    </form>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">Print Options</h6>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.surveys.results', $survey) }}" class="d-flex flex-column gap-2" id="printForm">
                        <input type="hidden" name="print" value="1">
                        <div>
                            <label class="form-label">Scope</label>
                            <select name="scope" class="form-select form-select-sm" id="printScope">
                                <option value="all" {{ request('scope') === 'all' ? 'selected' : '' }}>All Responses</option>
                                <option value="batch" {{ request('scope') === 'batch' ? 'selected' : '' }}>Batch Only</option>
                                <option value="course" {{ request('scope') === 'course' ? 'selected' : '' }}>Course Only</option>
                                <option value="batch_course" {{ request('scope') === 'batch_course' ? 'selected' : '' }}>Batch + Course</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label">Batch</label>
                            <select name="batch" class="form-select form-select-sm">
                                <option value="">All Batches</option>
                                @foreach ($batchOptions as $batch)
                                    <option value="{{ $batch }}" {{ ($filters['batch'] ?? '') == $batch ? 'selected' : '' }}>
                                        {{ $batch }}
                                    </option>
                                @endforeach
                                @if (!empty($filters['batch']) && !$batchOptions->contains($filters['batch']))
                                    <option value="{{ $filters['batch'] }}" selected>{{ $filters['batch'] }}</option>
                                @endif
                            </select>
                        </div>
                        <div>
                            <label class="form-label">Course</label>
                            <select name="course" class="form-select form-select-sm">
                                <option value="">All Courses</option>
                                @foreach ($courseOptions as $course)
                                    <option value="{{ $course }}" {{ ($filters['course'] ?? '') == $course ? 'selected' : '' }}>
                                        {{ $course }}
                                    </option>
                                @endforeach
                                @if (!empty($filters['course']) && !$courseOptions->contains($filters['course']))
                                    <option value="{{ $filters['course'] }}" selected>{{ $filters['course'] }}</option>
                                @endif
                            </select>
                        </div>
                        <small class="text-muted">Leave batch/course blank to print all responses.</small>
                        <button type="submit" class="btn btn-sm survey-btn-primary">
                            <i class="fas fa-print"></i> Print
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            @foreach ($survey->questions as $question)
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <strong>{{ $loop->iteration }}. {{ $question->text }}</strong>
                            <span class="badge bg-info float-end">{{ ucfirst($question->type) }}</span>
                        </h6>
                    </div>
                    <div class="card-body">
                        @if (in_array($question->type, ['single', 'multiple']))
                            @php
                                $stat = $stats[$question->id] ?? [];
                                $counts = $stat['counts'] ?? collect();
                                $total = $stat['total'] ?? 0;
                                $optionsToShow = request('print')
                                    ? $question->options->filter(fn ($option) => ($counts[$option->id] ?? 0) > 0)
                                    : $question->options;
                            @endphp
                            @if ($total > 0)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Option</th>
                                                <th>Count</th>
                                                <th>Percentage</th>
                                                <th>Chart</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($optionsToShow as $option)
                                                @php
                                                    $count = $counts[$option->id] ?? 0;
                                                    $percentage = $total > 0 ? round(($count / $total) * 100, 2) : 0;
                                                @endphp
                                                <tr>
                                                    <td>{{ $option->label }}</td>
                                                    <td><strong>{{ $count }}</strong></td>
                                                    <td>{{ $percentage }}%</td>
                                                    <td>
                                                        <div class="progress" style="height: 20px;">
                                                            <div class="progress-bar" style="width: {{ $percentage }}%">
                                                                {{ $percentage }}%
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted">No responses yet</p>
                            @endif
                        @else
                            @php
                                $stat = $stats[$question->id] ?? [];
                                $samples = $stat['samples'] ?? collect();
                            @endphp
                            @if ($samples->count() > 0)
                                <div class="list-group">
                                    @foreach ($samples as $sample)
                                        <div class="list-group-item">
                                            <p class="mb-0">{{ $sample }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">No text responses yet</p>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@if (request('print'))
    <script>
        window.addEventListener('load', () => window.print());
    </script>
@endif
<script>
    const printScope = document.getElementById('printScope');
    const printForm = document.getElementById('printForm');

    if (printScope && printForm) {
        const batchInput = printForm.querySelector('select[name="batch"]');
        const courseInput = printForm.querySelector('select[name="course"]');

        const updatePrintFields = () => {
            const scope = printScope.value;
            batchInput.disabled = scope === 'course' || scope === 'all';
            courseInput.disabled = scope === 'batch' || scope === 'all';
            if (scope === 'all') {
                batchInput.value = '';
                courseInput.value = '';
            }
        };

        printScope.addEventListener('change', updatePrintFields);
        updatePrintFields();
    }
</script>
@endsection
