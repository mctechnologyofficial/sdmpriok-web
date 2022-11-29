<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
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

        $team = User::where('team_id', $id)->get();

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

        $team  = Evaluation::selectRaw('AVG(evaluations.result) as score, users.name as users')
            ->join('users', 'users.id', '=', 'evaluations.user_id')
            ->where('users.team_id', $teamid)
            ->groupBy('evaluations.user_id')
            ->get();
            $response['team'] = $team;

        return response()->json($response);
    }

    /**
     * Move Employee
     *
     * @return \Illuminate\Http\Response
     */
    public function moveEmployee(Request $request)
    {
        $user = User::where('id', $request->id)->update([
            'team_id'   => $request->tujuan,
        ]);

        $response['data'] = $user;

        return response()->json($response);
    }
}
