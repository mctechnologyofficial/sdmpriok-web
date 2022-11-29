<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Progress;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team = Team::all();
        return view('layouts.admin.organization.index', compact(['team']));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getTeam(Request $request)
    {
        $id = $request->id;

        $team = User::where('team_id', 1)->get();

        $response['data'] = $team;

        return response()->json($response);
    }

    /**
     * Get radar chart data team
     *
     * @return \Illuminate\Http\Response
     */
    public function getRadar(Request $request)
    {
        // $userid = $request->userid;
        $teamid = $request->id;

        $team  = Progress::selectRaw('SUM(progress.progress) as progress, users.name as users')
            ->join('users', 'users.id', '=', 'progress.user_id')
            // ->join('competencies', 'competencies.id', '=', 'progress.competency_id')
            // ->where('progress.user_id', '=', $userid)
            ->where('progress.team_id', $teamid)
            ->groupBy('progress.user_id')
            ->get();
            $response['team'] = $team;

        return response()->json($response);
    }
}
