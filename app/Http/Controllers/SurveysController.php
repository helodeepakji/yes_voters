<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\User;
use App\Models\Team;

class SurveysController extends Controller
{
    public function index()
    {
        $users = User::all();
        $team = Team::all();
        $surveys = Survey::withCount(['responses', 'questions','assignedUsers'])->get();
        return view('survey-list', compact('surveys','team','users'));
    }

    public function saveSurveys(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        Survey::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => $request->status,
        ]);

        return back()->with('success', 'Survey created successfully.');
    }

    public function getSurvey($id)
    {
        $survey = Survey::where('id', $id)->first();
        return response()->json($survey);
    }

    public function deleteSurveys($id)
    {
        $survey = Survey::where('id', $id)->first();
        $survey->delete();
        return back()->with('success', 'Delete Survey Successfully.');
    }

    public function editSurveys(Request $request)
    {

        $request->validate([
            'id' => 'required|integer|exists:surveys,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $survey = Survey::where('id', $request->id)->first();
        if (!$survey) {
            return back()->with('error', 'Survey not found.');
        }

        $survey->title = $request->title;
        $survey->description = $request->description;
        $survey->is_active = $request->status;
        $survey->save();

        return back()->with('success', 'Survey Save Successfully');
    }
}
