<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Models\SurveyOption;
use App\Models\SurveyAnswer;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SurveyManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'admin') {
                return redirect('/')->with('error', 'Unauthorized access');
            }
            return $next($request);
        });
    }

    public function index(): View
    {
        $surveys = Survey::withCount('responses')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.surveys.index', compact('surveys'));
    }

    public function create(): View
    {
        return view('admin.surveys.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'questions' => ['required', 'array', 'min:1'],
            'questions.*.text' => ['required', 'string', 'max:500'],
            'questions.*.type' => ['required', 'in:single,multiple,text'],
            'questions.*.is_required' => ['boolean'],
            'questions.*.options' => ['array'],
            'questions.*.options.*' => ['nullable', 'string', 'max:255'],
        ]);

        $survey = Survey::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'is_active' => $data['is_active'] ?? false,
            'published_at' => ($data['is_active'] ?? false) ? now() : null,
            'created_by' => Auth::id(),
        ]);

        foreach ($data['questions'] as $index => $questionData) {
            $question = SurveyQuestion::create([
                'survey_id' => $survey->id,
                'text' => $questionData['text'],
                'type' => $questionData['type'],
                'is_required' => $questionData['is_required'] ?? true,
                'position' => $index,
            ]);

            if (in_array($question->type, ['single', 'multiple'], true)) {
                $options = $questionData['options'] ?? [];
                $options = array_filter($options, fn ($opt) => filled($opt));

                foreach ($options as $optIndex => $label) {
                    SurveyOption::create([
                        'survey_question_id' => $question->id,
                        'label' => $label,
                        'value' => $label,
                        'position' => $optIndex,
                    ]);
                }
            }
        }

        return redirect()->route('admin.surveys.index')
            ->with('success', 'Survey created successfully');
    }

    public function results(Survey $survey, Request $request): View
    {
        $survey->load(['questions.options', 'responses']);

        $metaCollection = $survey->responses()->get(['meta']);

        $batchOptions = $metaCollection
            ->pluck('meta.batch')
            ->filter()
            ->unique()
            ->sort()
            ->values();

        $courseOptions = $metaCollection
            ->pluck('meta.course')
            ->filter()
            ->unique()
            ->sort()
            ->values();

        $filters = [
            'batch' => $request->input('batch'),
            'course' => $request->input('course'),
        ];

        $responseQuery = $survey->responses()->with('answers');

        $responseQuery->when($filters['batch'], function ($q, $batch) {
            $q->whereJsonContains('meta->batch', $batch);
        });

        $responseQuery->when($filters['course'], function ($q, $course) {
            $q->whereJsonContains('meta->course', $course);
        });

        $responses = $responseQuery->get();

        $stats = [];
        foreach ($survey->questions as $question) {
            if (in_array($question->type, ['single', 'multiple'], true)) {
                $counts = SurveyAnswer::select('survey_option_id', DB::raw('count(*) as total'))
                    ->whereIn('survey_response_id', $responses->pluck('id'))
                    ->where('survey_question_id', $question->id)
                    ->groupBy('survey_option_id')
                    ->pluck('total', 'survey_option_id');

                $stats[$question->id] = [
                    'type' => $question->type,
                    'counts' => $counts,
                    'total' => $counts->sum(),
                ];
            } else {
                $texts = SurveyAnswer::whereIn('survey_response_id', $responses->pluck('id'))
                    ->where('survey_question_id', $question->id)
                    ->latest()
                    ->limit(10)
                    ->pluck('text_answer');

                $stats[$question->id] = [
                    'type' => $question->type,
                    'samples' => $texts,
                ];
            }
        }

        return view('admin.surveys.results', [
            'survey' => $survey,
            'responses' => $responses,
            'stats' => $stats,
            'filters' => $filters,
            'batchOptions' => $batchOptions,
            'courseOptions' => $courseOptions,
        ]);
    }
}
