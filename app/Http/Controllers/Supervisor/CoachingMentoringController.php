<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\AnswerSupervisor;
use App\Models\Competency;
use App\Models\Progress;
use App\Models\QuestionSupervisor;
use App\Models\Role;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\XmlConfiguration\Group;

class CoachingMentoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('roles')
                ->join('progress', 'progress.user_id', '=', 'users.id')
                ->join('model_has_roles', function($join){
                    $join->on('users.id', '=', 'model_has_roles.model_id')
                    ->where('model_has_roles.model_type', User::class);
                })
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->where('users.team_id', Auth::user()->team_id)
                ->groupBy('users.name')
                ->get();
        return view('layouts.supervisor.mentoring.list', compact(['user']));
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $competency = Competency::all();
        $name = Competency::select('name')
        ->groupBy('name')
        ->get();
        $category = Competency::select('category')
        ->groupBy('category')
        ->get();
        $totalcompetency = Competency::select('name')
        ->groupBy('name')
        ->count();

        $pgasturbin = Competency::select('progress.progress')
                                ->join('progress', 'progress.competency_id', '=', 'competencies.id')
                                ->where('progress.user_id', $user->id)
                                ->where('competencies.name', 'LIKE', '%Tools Gas Turbin%')
                                ->groupBy('competencies.name')
                                ->pluck('progress.progress');

        $data = $pgasturbin->values();

        $response['data'] = $data;

        $gasturbin = app()->chartjs
        ->name('gasturbin')
        ->type('doughnut')
        ->size(['width' => 200, 'height' => 200])
        ->labels(['Tools Gas Turbin'])
        ->datasets([
            [
                'backgroundColor' => ['#FF6384'],
                'hoverBackgroundColor' => ['#FF6384'],
                'data' => $response['data']
            ]
        ])
        ->options([]);

        $phrsg = Competency::select('progress.progress')
                                ->join('progress', 'progress.competency_id', '=', 'competencies.id')
                                ->where('progress.user_id', $user->id)
                                ->where('competencies.name', 'LIKE', '%Tools Gas Turbin%')
                                ->groupBy('competencies.name')
                                ->pluck('progress.progress');

        $data = $phrsg->values();

        $rhrsg['data'] = $data;

        $hrsg = app()->chartjs
        ->name('hrsg')
        ->type('doughnut')
        ->size(['width' => 200, 'height' => 200])
        ->labels(['Tools HRSG'])
        ->datasets([
            [
                'backgroundColor' => ['#36A2EB'],
                'hoverBackgroundColor' => ['#36A2EB'],
                'data' => $rhrsg['data']
            ]
        ])
        ->options([]);

        $ppltgu = Competency::select('progress.progress')
                                ->join('progress', 'progress.competency_id', '=', 'competencies.id')
                                ->where('progress.user_id', $user->id)
                                ->where('competencies.name', 'LIKE', '%Tools PLTGU%')
                                ->groupBy('competencies.name')
                                ->pluck('progress.progress');

        $data = $ppltgu->values();

        $rpltgu['data'] = $data;

        $pltgu = app()->chartjs
        ->name('pltgu')
        ->type('doughnut')
        ->size(['width' => 200, 'height' => 200])
        ->labels(['Tools PLTGU'])
        ->datasets([
            [
                'backgroundColor' => ['#ff00dc'],
                'hoverBackgroundColor' => ['#ff00dc'],
                'data' => $rpltgu['data']
            ]
        ])
        ->options([]);

        $psteamturbin = Competency::select('progress.progress')
                                ->join('progress', 'progress.competency_id', '=', 'competencies.id')
                                ->where('progress.user_id', $user->id)
                                ->where('competencies.name', 'LIKE', '%Tools PLTGU%')
                                ->groupBy('competencies.name')
                                ->pluck('progress.progress');

        $data = $psteamturbin->values();

        $rsteamturbin['data'] = $data;

        $steamturbin = app()->chartjs
        ->name('steamturbin')
        ->type('doughnut')
        ->size(['width' => 200, 'height' => 200])
        ->labels(['Tools Stream Turbin'])
        ->datasets([
            [
                'backgroundColor' => ['#1fff00'],
                'hoverBackgroundColor' => ['#1fff00'],
                'data' => $rsteamturbin['data']
            ]
        ])
        ->options([]);

        return view('layouts.supervisor.mentoring.detail', compact(['user', 'competency', 'name', 'category','totalcompetency', 'gasturbin', 'hrsg', 'pltgu', 'steamturbin']));
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
}
