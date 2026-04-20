@extends('layouts.alumni')

@section('title', $survey->title . ' (Edit) - MPSU Alumni Network')

@section('content')
<div class="container">
    <div class="page-header-premium">
        <div class="container">
            <h1 class="page-title"><i class="fas fa-poll"></i> {{ $survey->title }}</h1>
            <p class="page-subtitle">Edit your response</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <form action="{{ route('surveys.update', $survey) }}" method="POST">
                @csrf
                @method('PUT')

                @foreach ($survey->questions as $question)
                    <div class="card card-premium mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-3">
                                {{ $loop->iteration }}. {{ $question->text }}
                                @if ($question->is_required)
                                    <span class="text-danger">*</span>
                                @endif
                            </h6>

                            @php
                                $userAnswers = $userResponse->answers()
                                    ->where('survey_question_id', $question->id)
                                    ->get();
                                $selectedOptions = $userAnswers->pluck('survey_option_id')->filter()->toArray();
                                $textAnswer = $userAnswers->where('text_answer', '!=', null)->first()?->text_answer ?? '';
                            @endphp

                            @if ($question->type === 'single')
                                @foreach ($question->options as $option)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" 
                                               name="question_{{ $question->id }}" 
                                               value="{{ $option->id }}" 
                                               id="option_{{ $option->id }}"
                                               {{ in_array($option->id, $selectedOptions) ? 'checked' : '' }}
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
                                               id="option_{{ $option->id }}"
                                               {{ in_array($option->id, $selectedOptions) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option_{{ $option->id }}">
                                            {{ $option->label }}
                                        </label>
                                    </div>
                                @endforeach

                            @else
                                <textarea class="form-control" 
                                          name="question_{{ $question->id }}" 
                                          rows="4"
                                          @if ($question->is_required) required @endif>{{ $textAnswer }}</textarea>
                            @endif
                        </div>
                    </div>
                @endforeach

                <div class="mt-4">
                    <button type="submit" class="btn btn-premium btn-premium-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                    <a href="{{ route('surveys.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
