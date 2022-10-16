<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Competency;
use App\Models\Progress;
use App\Models\User;
use Illuminate\Http\Request;
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
        return view('layouts.supervisor.assessment-chart.team');
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
    public function getDataRadarChartTeam(){
        $competency = Competency::select('name')
                                ->where('role', 'Operator')->pluck('name');

        $user = User::select('name')
                    ->join('progress', 'progress.user_id', '=', 'users.id')
                    ->groupBy('name')
                    ->orderBy('users.id', 'ASC')
                    ->pluck('name');

        $progress = Progress::select('progress')
                    ->get()
                    ->pluck('progress')
                    ->toArray();

        $label = $user->values();
        // $data = $progress->values();
        $labels = $competency->values();

        $response['labeluser'] = $label;
        $response['dataprogress'] = $progress;
        $response['labelcompetency'] = $labels;

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
                                ->where('progress.user_id', '1')
                                ->groupBy('competencies.name', 'progress.progress')
                                ->orderBy('competencies.id', 'ASC')
                                ->pluck('competencies.name', 'progress.progress');

        // $user = User::select('name')
        //             ->join('progress', 'progress.user_id', '=', 'users.id')
        //             ->where('users.id', '1')
        //             ->groupBy('name')
        //             ->orderBy('users.id', 'ASC')
        //             ->pluck('name');

    // $progress = Progress::select('progress')
        //             ->get()
        //             ->pluck('progress')
        //             ->toArray();

        // $label = $user->values();
        $label = $competency->values();
        $data = $competency->keys();

        $response['label'] = $label;
        // $response['dataprogress'] = $progress;
        $response['data'] = $data;

        return response()->json($response);
    }
}
