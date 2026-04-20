@extends('layouts.alumni')

@section('title', $survey->title . ' - MPSU Alumni Network')

@section('content')
<div class="container">
    <div class="page-header-premium">
        <div class="container">
            <h1 class="page-title"><i class="fas fa-poll"></i> {{ $survey->title }}</h1>
            <p class="page-subtitle">{{ $survey->description }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            @if (Auth::user() && !Auth::user()->is_verified)
                <div class="alert alert-warning" role="alert">
                    <strong>Verification required:</strong> Your account is pending approval. Please wait for admin verification before accessing surveys.
                </div>
                <a href="{{ route('surveys.index') }}" class="btn btn-outline-secondary">Back to Surveys</a>
            @else
                <form action="{{ route('surveys.store', $survey) }}" method="POST">
                    @csrf

                    @foreach ($survey->questions as $question)
                        <div class="card card-premium mb-4">
                            <div class="card-body">
                                <h6 class="card-title mb-3">
                                    {{ $loop->iteration }}. {{ $question->text }}
                                    @if ($question->is_required)
                                        <span class="text-danger">*</span>
                                    @endif
                                </h6>

                                @if ($question->type === 'single')
                                    @foreach ($question->options as $option)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" 
                                                   name="question_{{ $question->id }}" 
                                                   value="{{ $option->id }}" 
                                                   id="option_{{ $option->id }}"
                                                   @if ($question->is_required) required @endif>
                                            <label class="form-check-label" for="option_{{ $option->id }}">
                                                {{ $option->label }}
                                            </label>
                                        </div>
                                    @endforeach

                                @elseif ($question->type === 'multiple')
                                    @foreach ($question->options as $option)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="question_{{ $question->id }}[]" 
                                                   value="{{ $option->id }}" 
                                                   id="option_{{ $option->id }}">
                                            <label class="form-check-label" for="option_{{ $option->id }}">
                                                {{ $option->label }}
                                            </label>
                                        </div>
                                    @endforeach

                                @else
                                    <textarea class="form-control" 
                                              name="question_{{ $question->id }}" 
                                              rows="4"
                                              @if ($question->is_required) required @endif></textarea>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-4">
                        <button type="submit" class="btn btn-premium btn-premium-primary">
                            <i class="fas fa-check"></i> Submit Survey
                        </button>
                        <a href="{{ route('surveys.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
 