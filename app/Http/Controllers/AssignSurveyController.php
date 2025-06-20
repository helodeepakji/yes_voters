<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assign;
use App\Models\User;
use App\Models\Survey;

class AssignSurveyController extends Controller
{
    public function index($id)
    {
        $survey = Survey::find($id);
        $userIds = Assign::where('survey_id', $id)->pluck('user_id');
        $users = User::whereIn('id', $userIds)->get();
        return view('assigned-user', compact('users','survey'));
    }
    
    public function deleteAssign($id , $survey_id)
    {
        $assign = Assign::where('survey_id', $survey_id)->where('user_id',$id)->firstOrFail();
        $assign->delete();
        return back()->with('success', 'Survey assign successfully removed.');
    }

    public function assignUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|array',
            'user_id.*' => 'exists:users,id',
            'survey_id' => 'required|string',
        ]);

        $surveyIds = explode(',', $request->survey_id);
        foreach ($surveyIds as $surveyId) {
            foreach ($request->user_id as $userId) {
                Assign::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'survey_id' => $surveyId,
                    ],
                    [
                        'assigned_by' => auth()->id(),
                    ]
                );
            }
        }


        return back()->with('success', 'Survey assigned to selected user(s) successfully.');
    }

    public function assignTeam(Request $request)
    {
        $request->validate([
            'team_id' => 'required|integer|exists:teams,id',
            'survey_id' => 'required|string',
        ]);

        $users = User::where('team_id', $request->team_id)->where('is_team_leader', 0)->get();
        $surveyIds = explode(',', $request->survey_id);
        foreach ($surveyIds as $surveyId) {
            foreach ($users as $user) {
                Assign::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'survey_id' => $surveyId,
                    ],
                    [
                        'assigned_by' => auth()->id(),
                    ]
                );
            }
        }
        return back()->with('success', 'Survey assigned to all members of the team successfully.');
    }
}
