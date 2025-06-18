<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        // $page = Page::where('slug', 'team-management')->first();
        // $roleIds = $page->roles->pluck('id');
        // $users = User::whereIn('role_id', [1])->where('role_id' ,'!=', 2)->where('role_id' ,'!=', 1)->with('role')->get();

        // $page = Page::where('slug', 'team-management')->first();
        // $roleIds = $page->roles->where('company_id', $company_id)->pluck('id');

        $teamMember = User::with('role')
            // ->whereNotIn('role_id', $roleIds)
            // ->where('role_id', '!=', 1)
            // ->where('role_id', '!=', 2)
            ->get();

        $users = User::with('role')->get();

        $team = Team::all();
        // $members = User::with(['team', 'role'])->where('is_team_leader',1)->whereNotNull('team_id')->get();
        $members = User::with(['team' => function ($q) {
            $q->withCount('users');
        }, 'role'])->where('is_team_leader', 1)
            ->whereNotNull('team_id')
            ->get();


        return view('team-list', compact('members', 'users', 'team', 'teamMember'));
    }

    public function createTeam(Request $request)
    {
        $request->validate([
            'team_name' => 'required|string|max:255',
            'team_leader_id' => 'required|integer|exists:users,id',
        ]);

        $existingLeader = User::where('id', $request->team_leader_id)->where('is_team_leader', 1)->whereNotNull('team_id')->first();

        if ($existingLeader) {
            return redirect()->back()->withErrors(['team_leader_id' => 'This user is already leading another team.']);
        }

        // Create team with company_id
        $team = Team::create([
            'team_name' => $request->team_name,
        ]);

        // Update user as team leader and assign team
        User::where('id', $request->team_leader_id)->update([
            'is_team_leader' => 1,
            'team_id' => $team->id,
        ]);

        return redirect('/team-list')->with('success', 'Team created successfully.');
    }

    public function updateTeam(Request $request)
    {
        $request->validate([
            'team_name' => 'required|string|max:255',
            'team_id' => 'required|integer|exists:teams,id',
            'team_leader_id' => 'required|integer|exists:users,id',
            'team_member' => 'nullable|array',
            'team_member.*' => 'integer|exists:users,id',
        ]);

        $team = Team::findOrFail($request->team_id);
        $existingLeader = User::where('id', $request->team_leader_id)
            ->where('is_team_leader', 1)
            ->where('team_id', '!=', $team->id)
            ->first();

        if ($existingLeader) {
            return redirect()->back()->withErrors(['team_leader_id' => 'This user is already leading another team.']);
        }

        $team->team_name = $request->team_name;
        $team->save();

        $teamLeader = User::findOrFail($request->team_leader_id);
        $teamLeader->is_team_leader = 1;
        $teamLeader->team_id = $team->id;
        $teamLeader->save();

        User::where('team_id', $team->id)->where('id', '!=', $teamLeader->id)->update(['team_id' => null, 'is_team_leader' => 0]);
        if (is_array($request->team_member) && count($request->team_member) > 0) {
            User::whereIn('id', $request->team_member)->update(['team_id' => $team->id]);
        }

        return redirect('/team-list')->with('success', 'Team updated successfully.');
    }

    public function getTeamLeaderDetails($id)
    {
        $team = Team::with(['members.role', 'leader.role'])->findOrFail($id);

        return response()->json([
            'team_name' => $team->team_name,
            'leader' => [
                'id' => $team->leader->id ?? null,
                'name' => $team->leader->name ?? null,
                'role' => $team->leader->role->role_name ?? null,
                'email' => $team->leader->email ?? null,
            ],
            'members' => $team->members
                ->filter(fn($member) => $member->is_team_leader == 0)
                ->map(function ($member) {
                    return [
                        'id' => $member->id,
                        'name' => $member->name,
                        'email' => $member->email,
                        'role' => $member->role->role_name ?? null,
                        'is_team_leader' => $member->is_team_leader,
                    ];
                })->values(),
        ]);
    }

    public function deleteTeam($id)
    {
        $team = Team::findOrFail($id);
        $leader = User::where('team_id', $team->id)->where('is_team_leader', 1)->first();

        if ($leader) {
            $leader->update([
                'is_team_leader' => 0,
                'team_id' => null,
            ]);
        }

        User::where('team_id', $team->id)->update([
            'team_id' => null,
            'is_team_leader' => 0
        ]);

        $team->delete();
        return redirect()->back()->with(['success' => 'Team deleted successfully.']);
    }

    public function getMembersByTeam($id)
    {
        $members = User::with(['company', 'team', 'role'])->withCount('leads')
            ->where('team_id', $id)
            ->whereNotNull('team_id')
            ->get();

        return response()->json($members);
    }
}
