<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Progress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MonitoringProgressController extends Controller
{
    public function getDataProgress(): JsonResponse
    {
        $teams = Progress::select('teams.name as name')
                        ->selectRaw('SUM(progress.progress) as total')
                        ->join('teams', 'teams.id', '=', 'progress.team_id')
                        ->groupBy('name')
                        ->pluck('total', 'name');

        $label = $teams->keys();
        $data = $teams->values();

        $response['label'] = $label;
        $response['data'] = $data;

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => '',
            'data' => $response
        ], 200);
    }
}
