<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;

class SurveyQuestionController extends Controller
{
    public function index($id = null)
    {
        $question = Survey::with('questions')->where('id', $id)->first();
        $surveys = Survey::where('is_active',1)->get();
        return view('survey-question', compact('question','surveys'));
    }

    public function getSurveyQuestion($id)
    {
        $question = Question::where('id', $id)->first();
        return response()->json($question);
    }
    
    public function deleteSurveyQuestion($id)
    {
        $question = Question::where('id', $id)->first();
        $question->delete();
        return back()->with('success', 'Question delete successfully.');
    }

    public function addSurveyQuestion(Request $request)
    {

        $request->validate([
            'id' => 'required|integer|exists:surveys,id',
            'question' => 'required|string',
            'type' => 'required|string',
            'options' => 'nullable|string',
        ]);

        Question::create([
            'survey_id' => $request->id,
            'question' => $request->question,
            'type' => $request->type,
            'options' => $request->options,
        ]);

        return back()->with('success', 'Question created successfully.');
    }

    public function editSurveyQuestion(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:questions,id',
            'question' => 'required|string',
            'type' => 'required|string',
            'options' => 'nullable|string',
        ]);

        $question = Question::findOrFail($request->id);

        $question->update([
            'question' => $request->question,
            'type' => $request->type,
            'options' => $request->options,
        ]);

        return back()->with('success', 'Question updated successfully.');
    }
}
