<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SurveyResponse;
use Illuminate\Support\Facades\Auth;

class SurveyResponseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'survey_id' => 'nullable|integer',
            'response' => 'required|string',
        ]);

        SurveyResponse::create([
            'user_id' => Auth::id(),
            'survey_id' => $request->input('survey_id'),
            'response' => $request->input('response'),
        ]);

        return redirect()->back()->with('success', 'Survey response submitted!');
    }
}
