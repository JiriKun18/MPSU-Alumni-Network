@extends('admin.layout')

@section('title', 'Create Survey - MPSU Alumni Network')

@section('content')
<div class="admin-page-header">
    <div class="container-fluid">
        <h1 class="admin-page-title"><i class="fas fa-plus-circle"></i> Create Survey</h1>
        <p class="admin-page-subtitle">Create a new survey for alumni</p>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <form action="{{ route('admin.surveys.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Survey Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" required value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="is_active" value="1" 
                                       @if(old('is_active')) checked @endif>
                                Publish immediately
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">Survey Questions</h5>
                    </div>
                    <div class="card-body">
                        <div id="questions-container">
                            <div class="question-group mb-4 p-3 border rounded" data-index="0">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6>Question 1</h6>
                                    <button type="button" class="btn btn-sm btn-danger btn-remove-question" style="display:none;">
                                        <i class="fas fa-trash"></i> Remove
                                    </button>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Question Text</label>
                                    <input type="text" class="form-control question-text" 
                                           name="questions[0][text]" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Question Type</label>
                                    <select class="form-control question-type" name="questions[0][type]" required>
                                        <option value="">-- Select Type --</option>
                                        <option value="single">Single Choice</option>
                                        <option value="multiple">Multiple Choice</option>
                                        <option value="text">Text Answer</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" 
                                               name="questions[0][is_required]" value="1" checked>
                                        Required
                                    </label>
                                </div>

                                <div class="options-group" style="display:none;">
                                    <label class="form-label">Options</label>
                                    <div class="options-container mb-3">
                                        <input type="text" class="form-control mb-2" placeholder="Option 1" 
                                               name="questions[0][options][]">
                                        <input type="text" class="form-control mb-2" placeholder="Option 2" 
                                               name="questions[0][options][]">
                                    </div>
                                    <button type="button" class="btn btn-sm btn-secondary btn-add-option">
                                        <i class="fas fa-plus"></i> Add Option
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary mt-3" id="btn-add-question">
                            <i class="fas fa-plus"></i> Add Question
                        </button>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Survey
                    </button>
                    <a href="{{ route('admin.surveys.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('questions-container');

    function updateQuestionNumbers() {
        document.querySelectorAll('.question-group').forEach((group, index) => {
            group.dataset.index = index;
            group.querySelector('h6').textContent = `Question ${index + 1}`;
            group.querySelectorAll('[name*="["]').forEach(el => {
                el.name = el.name.replace(/\[questions?\]?\[\d+\]/, `[questions][${index}]`);
            });
            const removeBtn = group.querySelector('.btn-remove-question');
            removeBtn.style.display = document.querySelectorAll('.question-group').length > 1 ? 'block' : 'none';
        });
    }

    document.getElementById('btn-add-question').addEventListener('click', function() {
        const count = document.querySelectorAll('.question-group').length;
        const template = document.querySelector('.question-group').cloneNode(true);
        template.dataset.index = count;
        template.querySelector('h6').textContent = `Question ${count + 1}`;
        template.querySelectorAll('[name*="["]').forEach(el => {
            el.name = el.name.replace(/\[\d+\]/, `[${count}]`);
            el.value = '';
        });
        container.appendChild(template);
        updateQuestionNumbers();
    });

    container.addEventListener('change', function(e) {
        if (e.target.classList.contains('question-type')) {
            const optionsGroup = e.target.closest('.question-group').querySelector('.options-group');
            optionsGroup.style.display = ['single', 'multiple'].includes(e.target.value) ? 'block' : 'none';
        }
    });

    container.addEventListener('click', function(e) {
        if (e.target.closest('.btn-remove-question')) {
            e.target.closest('.question-group').remove();
            updateQuestionNumbers();
        }
        if (e.target.closest('.btn-add-option')) {
            const count = e.target.closest('.question-group').querySelectorAll('[name*="options"]').length;
            const input = document.createElement('input');
            input.type = 'text';
            input.className = 'form-control mb-2';
            input.placeholder = `Option ${count + 1}`;
            input.name = e.target.closest('.question-group').querySelector('[name*="options"]').name.replace(/\[\d*\]/, `[${count}]`);
            e.target.closest('.options-container').appendChild(input);
        }
    });

    updateQuestionNumbers();
});
</script>
@endsection
