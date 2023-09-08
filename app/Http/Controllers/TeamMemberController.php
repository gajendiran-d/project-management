<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($projectId)
    {
        try {
            $projects = Project::where('status', '1')->where('owner_id', Auth::user()->id)->get();
            $teams = User::where('id', '!=', Auth::user()->id)->get();
            $adminId = '';
            $memberId = [];
            if ($projectId != 'null') {
                $projectMembers = TeamMember::where('project_id', $projectId)->get();
                if (count($projectMembers) > 0) {
                    $adminDetails = collect($projectMembers)->firstWhere('role', 'admin');
                    $adminId = $adminDetails->user_id;
                    $memberDetails = collect($projectMembers)->where('role', '!=', 'admin')->pluck('user_id');
                    $memberId = $memberDetails->toArray();
                }
            }
            return view('teams.index', ['projects' => $projects, 'teams' => $teams, 'projectId' => $projectId, 'adminId' => $adminId, 'memberId' => $memberId]);
        } catch (\Exception $e) {
            return redirect()->route('teams.index', 'null')->with('error', $e->getMessage());
        }
    }

    public function assign(Request $request)
    {
        try {
            $delete = TeamMember::where('project_id', $request->input('project'))->delete();
            $memberIds = $request->input('members');
            $admin = new TeamMember();
            $admin->user_id  = $request->input('admin');
            $admin->project_id = $request->input('project');
            $admin->role = 'admin';
            $admin->save();
            foreach ($memberIds as $memberId) {
                $member = new TeamMember();
                $member->user_id  = $memberId;
                $member->project_id = $request->input('project');
                $member->role = 'member';
                $member->save();
            }
            return redirect()->route('teams.index', $request->input('project'))->with('success', 'Team assigned successfully!');
        } catch (\Exception $e) {
            return redirect()->route('teams.index', 'null')->with('error', $e->getMessage());
        }
    }
}
