@extends('layouts.alumni')

@section('title', 'Surveys - MPSU Alumni Network')

@section('content')
<div class="container">
    <div class="page-header-premium">
        <div class="container">
            <h1 class="page-title"><i class="fas fa-poll"></i> Alumni Surveys</h1>
            <p class="page-subtitle">Participate in surveys to help improve alumni engagement</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if (Auth::user() && !Auth::user()->is_verified)
                <div class="alert alert-warning" role="alert">
                    <strong>Verification required:</strong> Your account is pending approval. Please wait for admin verification before accessing surveys.
                </div>
            @else
                @if ($surveys->count())
                    @foreach ($surveys as $survey)
                        <div class="card card-premium mb-4">
                            <div class="card-body">
                                <h5 class="card-title">{{ $survey->title }}</h5>
                                <p class="card-text text-muted">{{ $survey->description }}</p>
                                @php
                                    $userResponse = null;
                                    if (Auth::check()) {
                                        $userResponse = $survey->responses->where('user_id', Auth::id())->sortByDesc('created_at')->first();
                                    }
                                @endphp
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <small class="text-muted">
                                        <i class="fas fa-question-circle"></i> {{ $survey->questions->count() }} questions
                                        • <i class="fas fa-users"></i> {{ $survey->responses->count() }} responses
                                    </small>
                                    <div class="d-flex flex-column align-items-end gap-2">
                                        @if(!$userResponse)
                                            <a href="{{ route('surveys.show', $survey) }}" class="btn btn-premium btn-premium-primary">
                                                <i class="fas fa-edit"></i> Take Survey
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-secondary" disabled>
                                                <i class="fas fa-check"></i> Survey Completed
                                            </button>
                                        @endif
                                        @if($userResponse)
                                            <button type="button" class="btn btn-premium btn-premium-primary" data-bs-toggle="collapse" data-bs-target="#surveyResponse{{ $survey->id }}" aria-expanded="false" aria-controls="surveyResponse{{ $survey->id }}">
                                                <i class="fas fa-eye"></i> View My Response
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                @if($userResponse)
                                    <div class="collapse mt-3" id="surveyResponse{{ $survey->id }}">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body" style="max-height: 70vh; overflow-y: auto;">
                                                @php
                                                    $userResponse->loadMissing(['answers.question', 'answers.option']);
                                                    $meta = is_array($userResponse->meta) ? $userResponse->meta : [];
                                                    $answerGroups = $userResponse->answers->groupBy('survey_question_id');
                                                @endphp

                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <h6 class="mb-0">Your Survey Response</h6>
                                                    <small class="text-muted">Submitted at: {{ $userResponse->created_at->format('F j, Y, g:i a') }}</small>
                                                </div>

                                                <div class="mt-2">
                                                    @if (!empty($meta['batch']) || !empty($meta['course']))
                                                        <div class="mb-3">
                                                            <strong>Profile Info</strong>
                                                            <ul class="mb-0">
                                                                @if (!empty($meta['batch']))
                                                                    <li><strong>Batch:</strong> {{ $meta['batch'] }}</li>
                                                                @endif
                                                                @if (!empty($meta['course']))
                                                                    <li><strong>Course:</strong> {{ $meta['course'] }}</li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    @endif

                                                    @if ($answerGroups->count())
                                                        <ul class="mb-0">
                                                            @foreach ($answerGroups as $group)
                                                                @php
                                                                    $questionText = optional($group->first()->question)->text ?? 'Question';
                                                                    $values = $group->map(function ($answer) {
                                                                        if (!is_null($answer->text_answer) && $answer->text_answer !== '') {
                                                                            return $answer->text_answer;
                                                                        }
                                                                        if ($answer->option) {
                                                                            return $answer->option->value ?? $answer->option->label ?? '';
                                                                        }
                                                                        return '';
                                                                    })->filter()->unique()->values();
                                                                @endphp
                                                                <li><strong>{{ $questionText }}:</strong> {{ $values->isEmpty() ? 'No answer' : $values->join(', ') }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p class="text-muted mb-0">No response details.</p>
                                                    @endif
                                                </div>

                                                <div class="d-flex gap-2 mt-4 border-top pt-3">
                                                    <a href="{{ route('surveys.edit', $survey) }}" class="btn btn-sm btn-premium btn-premium-primary" title="Edit Response">
                                                        <i class="fas fa-pencil-alt"></i> Edit Response
                                                    </a>
                                                    <form action="{{ route('surveys.destroy', $survey) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this response? You can retake the survey afterward.');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-secondary" title="Delete Response">
                                                            <i class="fas fa-trash-alt"></i> Delete Response
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    {{ $surveys->links() }}
                @else
                    <div class="card card-premium">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-clipboard-list" style="font-size: 4rem; color: var(--accent-gold); opacity: 0.3;"></i>
                            <h3 class="mt-4 mb-3">No Active Surveys</h3>
                            <p class="text-muted">There are currently no surveys available. Check back later!</p>
                            <a href="{{ route('alumni.dashboard') }}" class="btn btn-premium btn-premium-primary mt-3">
                                <i class="fas fa-arrow-left"></i> Back to Dashboard
                            </a>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
