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
        $team = User::role('operator')
        ->where('team_id', '=', Auth::user()->team_id)
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get radar chart data team
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataRadarChartTeam(Request $request){
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
    public function getDataRadarChartPersonal(){
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
