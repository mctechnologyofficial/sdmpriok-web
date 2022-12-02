<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Progress;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MonitoringProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.admin.monitoring-chart.progress-chart');
    }

    /**
     * Get data chart
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataProgress(){
        $teams = Progress::select('teams.name as name')
                        ->selectRaw('SUM(progress.progress) as total')
                        ->join('teams', 'teams.id', '=', 'progress.team_id')
                        ->groupBy('name')
                        ->pluck('total', 'name');

        $label = $teams->keys();
        $data = $teams->values();

        $response['label'] = $label;
        $response['data'] = $data;

        return response()->json($response);
    }
}
