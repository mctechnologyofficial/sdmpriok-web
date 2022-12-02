<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Progress;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AssessmentChartSupervisorSeniorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNameSpv(): JsonResponse
    {
        $team = User::role('supervisor')
        ->where('team_id', '=', auth('sanctum')->user()->team_id)
        ->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $team
        ], 200);
    }

    public function getDataRadarChartTeam(Request $request): JsonResponse
    {
        $userid = $request->userid;

        $team  = Progress::select('progress.progress as progress', 'competencies.name as competency')
        ->join('users', 'users.id', '=', 'progress.user_id')
        ->join('competencies', 'competencies.id', '=', 'progress.competency_id')
        ->where('progress.user_id', '=', $userid)
        ->where('progress.team_id', auth('sanctum')->user()->team_id)
        ->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $team
        ], 200);
    }
}
