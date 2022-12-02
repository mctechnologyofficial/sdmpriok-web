<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $team = Team::all();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $team,
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getTeam(Request $request): JsonResponse
    {
        $id = $request->id;

        $team = User::where('team_id', $id)->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $team,
        ], 200);
    }

    /**
     * Get radar chart data team
     *
     * @return \Illuminate\Http\Response
     */
    public function getRadar(Request $request): JsonResponse
    {
        // $userid = $request->userid;
        $teamid = $request->id;

        $team  = Evaluation::selectRaw('AVG(evaluations.result) as score, users.name as users')
        ->join('users', 'users.id', '=', 'evaluations.user_id')
        ->where('users.team_id', $teamid)
        ->groupBy('evaluations.user_id')
        ->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $team,
        ], 200);
    }

    /**
     * Move Employee
     *
     * @return \Illuminate\Http\Response
     */
    public function moveEmployee(Request $request): JsonResponse
    {
        $user = User::where('id', $request->id)->update([
            'team_id'   => $request->to,
        ]);

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $user,
        ], 200);
    }
}
