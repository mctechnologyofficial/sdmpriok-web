<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Competency;
use App\Models\Progress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssessmentChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function team()
    {
        // $team = User::role('supervisor')
        //     ->where('team_id', '=', Auth::user()->team_id)
        //     ->get();
        $team = User::selectRaw('users.id, users.name')
        ->join('model_has_roles', function ($join) {
            $join->on('users.id', '=', 'model_has_roles.model_id')
                    ->where('model_has_roles.model_type', User::class);
        })
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->where('users.team_id', Auth::user()->team_id)
        ->where('roles.name', 'LIKE', '%Operator%')
        ->get();

        return view('layouts.supervisor.assessment-chart.team', compact(['team']));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function personal()
    {
        return view('layouts.supervisor.assessment-chart.personal');
    }

    /**
     * Get radar chart data team
     *
     * @return \Illuminate\Http\Response
     */
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
