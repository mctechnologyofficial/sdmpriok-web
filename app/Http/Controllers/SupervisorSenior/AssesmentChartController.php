<?php

namespace App\Http\Controllers\SupervisorSenior;

use App\Http\Controllers\Controller;
use App\Models\Competency;
use App\Models\Progress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssesmentChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function team()
    {
        $team = User::role('supervisor senior')
            ->where('team_id', '=', Auth::user()->team_id)
            ->get();

        return view('layouts.supervisor-senior.assesment-chart.team', compact(['team']));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function personal()
    {
        return view('layouts.supervisor-senior.assesment-chart.personal');
    }

    public function getDataRadarChartTeam(Request $request)
    {
        $userid = $request->userid;

        $team  = Progress::select('progress.progress as progress', 'competencies.name as competency')
            ->join('users', 'users.id', '=', 'progress.user_id')
            ->join('competencies', 'competencies.id', '=', 'progress.competency_id')
            ->where('progress.user_id', '=', $userid)
            ->where('progress.team_id', Auth::user()->team_id)
            ->get();
        
        $response['team'] = $team;
        return response()->json($response);
    }

    /**
     * Get radar chart data personal
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataRadarChartPersonal()
    {
        $competency = Competency::select('competencies.name', 'progress.progress')
            ->join('progress', 'progress.competency_id', '=', 'competencies.id')
            ->where('progress.user_id', Auth::user()->id)
            ->groupBy('competencies.name', 'progress.progress')
            ->orderBy('competencies.id', 'ASC')
            ->pluck('competencies.name', 'progress.progress');

        $label = $competency->values();
        $data = $competency->keys();

        $response['label'] = $label;
        $response['data'] = $data;

        return response()->json($response);
    }
}
