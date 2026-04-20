<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\SurveyAnswer;
use App\Models\SurveyOption;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    public function index()
    {
        if (Auth::user() && !Auth::user()->is_verified) {
            return view('surveys.index', ['surveys' => collect()]);
        }

        $surveys = Survey::where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('surveys.index', compact('surveys'));
    }

    public function show(Survey $survey)
    {
        abort_if(!$survey->is_active, 404);

        if (Auth::user() && !Auth::user()->is_verified) {
            return view('surveys.show', compact('survey'));
        }

        $userResponse = $survey->responses()
            ->where('user_id', Auth::id())
            ->first();

        if ($userResponse) {
            return redirect()->route('surveys.index')
                ->with('info', 'You have already completed this survey.');
        }

        $survey->load('questions.options');

        return view('surveys.show', compact('survey'));
    }

    public function edit(Survey $survey)
    {
        abort_if(!$survey->is_active, 404);

        if (Auth::user() && !Auth::user()->is_verified) {
            return redirect()->route('surveys.index')
                ->with('warning', 'Your account is pending verification.');
        }

        $user = Auth::user();
        $userResponse = $survey->responses()
            ->where('user_id', $user->id)
            ->with('answers.option')
            ->first();

        if (!$userResponse) {
            return redirect()->route('surveys.show', $survey)
                ->with('info', 'You have not completed this survey yet.');
        }

        $survey->load('questions.options');

        return view('surveys.edit', compact('survey', 'userResponse'));
    }

    public function update(Request $request, Survey $survey)
    {
        abort_if(!$survey->is_active, 404);

        if (Auth::user() && !Auth::user()->is_verified) {
            return redirect()->route('surveys.index')
                ->with('warning', 'Your account is pending verification.');
        }

        $user = Auth::user();
        $userResponse = $survey->responses()
            ->where('user_id', $user->id)
            ->first();

        if (!$userResponse) {
            return redirect()->route('surveys.show', $survey)
                ->with('error', 'Response not found.');
        }

        DB::transaction(function () use ($survey, $user, $userResponse, $request) {
            // Delete old answers
            $userResponse->answers()->delete();

            $collected = [];
            foreach ($survey->questions as $question) {
                $fieldName = "question_{$question->id}";

                if ($question->type === 'text') {
                    $answer = $request->input($fieldName);
                    if ($answer) {
                        SurveyAnswer::create([
                            'survey_response_id' => $userResponse->id,
                            'survey_question_id' => $question->id,
                            'text_answer' => $answer,
                        ]);
                        $collected[$question->text] = $answer;
                    }
                } else {
                    $optionIds = $request->input($fieldName);
                    $optionIds = is_array($optionIds) ? $optionIds : [$optionIds];

                    foreach ($optionIds as $optionId) {
                        if ($optionId) {
                            SurveyAnswer::create([
                                'survey_response_id' => $userResponse->id,
                                'survey_question_id' => $question->id,
                                'survey_option_id' => $optionId,
                            ]);
                            $opt = SurveyOption::find($optionId);
                            if ($opt) {
                                $collected[$question->text] = $opt->value ?? $opt->label;
                            }
                        }
                    }
                }
            }

            // Update profile data (same as original store)
            $profileData = [];
            $mapText = fn($key) => $collected[$key] ?? null;
            
            if ($course = $mapText('Course/Program Graduated')) {
                $profileData['course'] = $course;
                $profileData['course_graduated'] = $course;
            }
            if ($addr = $mapText('Permanent Address')) {
                $profileData['address'] = $addr;
            }
            if ($gender = $mapText('Gender Preference')) {
                $profileData['gender'] = $gender;
            }
            if ($year = $mapText('Year Graduated')) {
                $profileData['year_graduated'] = $year;
            }
            if ($occupation = $mapText('Present Occupation')) {
                $profileData['current_position'] = $occupation;
            }
            if ($workPlace = $mapText('Place of Work (Name of Company, Agency or Institution and address)')) {
                $profileData['current_company'] = $workPlace;
            }
            if ($employment = $mapText('Employment Data (Present Employment Status)')) {
                $profileData['employment_status'] = $employment;
            }

            if (!empty($profileData)) {
                $profile = $user->alumniProfile;
                if (!$profile) {
                    $profile = new \App\Models\AlumniProfile([ 'user_id' => $user->id ]);
                }
                $profile->fill($profileData);
                $profile->save();
            }

            // Update response timestamp
            $userResponse->touch();
        });

        return redirect()->route('surveys.index')
            ->with('success', 'Survey response updated successfully!');
    }

    public function destroy(Survey $survey)
    {
        abort_if(!$survey->is_active, 404);

        $user = Auth::user();
        $userResponse = $survey->responses()
            ->where('user_id', $user->id)
            ->first();

        if (!$userResponse) {
            return redirect()->route('surveys.index')
                ->with('error', 'Response not found.');
        }

        DB::transaction(function () use ($userResponse) {
            $userResponse->answers()->delete();
            $userResponse->delete();
        });

        return redirect()->route('surveys.index')
            ->with('success', 'Survey response deleted. You can now retake this survey.');
    }

    public function store(Request $request, Survey $survey)
    {
        abort_if(!$survey->is_active, 404);

        if (Auth::user() && !Auth::user()->is_verified) {
            return redirect()->route('surveys.index')
                ->with('warning', 'Your account is pending verification.');
        }

        $user = Auth::user();

        // Check if already responded
        if ($survey->responses()->where('user_id', $user->id)->exists()) {
            return redirect()->route('surveys.index')
                ->with('warning', 'You have already completed this survey.');
        }

        $response = DB::transaction(function () use ($survey, $user, $request) {
            $response = SurveyResponse::create([
                'survey_id' => $survey->id,
                'user_id' => $user->id,
                'meta' => [
                    'batch' => $user->alumniProfile?->batch?->year,
                    'course' => $user->alumniProfile?->course,
                ],
            ]);

            $collected = [];
            foreach ($survey->questions as $question) {
                $fieldName = "question_{$question->id}";

                if ($question->type === 'text') {
                    $answer = $request->input($fieldName);
                    if ($answer) {
                        SurveyAnswer::create([
                            'survey_response_id' => $response->id,
                            'survey_question_id' => $question->id,
                            'text_answer' => $answer,
                        ]);
                        $collected[$question->text] = $answer;
                    }
                } else {
                    $optionIds = $request->input($fieldName);
                    $optionIds = is_array($optionIds) ? $optionIds : [$optionIds];

                    foreach ($optionIds as $optionId) {
                        if ($optionId) {
                            SurveyAnswer::create([
                                'survey_response_id' => $response->id,
                                'survey_question_id' => $question->id,
                                'survey_option_id' => $optionId,
                            ]);
                            $opt = SurveyOption::find($optionId);
                            if ($opt) {
                                $collected[$question->text] = $opt->value ?? $opt->label;
                            }
                        }
                    }
                }
            }

            // Map collected answers to profile fields (best-effort by question text)
            $profileData = [];
            $mapText = fn($key) => $collected[$key] ?? null;
            if ($course = $mapText('Course/Program Graduated')) {
                $profileData['course'] = $course;
                $profileData['course_graduated'] = $course;
            }
            if ($addr = $mapText('Permanent Address')) {
                $profileData['address'] = $addr;
            }
            if ($gender = $mapText('Gender Preference')) {
                $profileData['gender'] = $gender;
            }
            if ($year = $mapText('Year Graduated')) {
                $profileData['year_graduated'] = $year;
            }
            if ($occupation = $mapText('Present Occupation')) {
                $profileData['current_position'] = $occupation;
            }
            if ($workPlace = $mapText('Place of Work (Name of Company, Agency or Institution and address)')) {
                $profileData['current_company'] = $workPlace;
            }
            if ($employment = $mapText('Employment Data (Present Employment Status)')) {
                $profileData['employment_status'] = $employment;
            }

            // Persist profile updates only (survey responses should not update account identity fields)
            if (!empty($profileData)) {
                $profile = $user->alumniProfile;
                if (!$profile) {
                    $profile = new \App\Models\AlumniProfile([ 'user_id' => $user->id ]);
                }
                $profile->fill($profileData);
                $profile->save();
            }

            return $response;
        });

        return redirect()->route('surveys.index')
            ->with('success', 'Thank you for completing the survey!');
    }
}
