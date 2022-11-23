<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\AnswerSupervisor;
use App\Models\Competency;
use App\Models\EvaluationOperator;
use App\Models\FormEvaluationOperator;
use App\Models\FormEvaluationSupervisor;
use App\Models\NoteOperator;
use App\Models\QuestionSupervisor;
use App\Models\Role;
use App\Models\Progress;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
        $user = $user = User::selectRaw('users.id as userid, users.nip, users.name, SUM(progress.progress) as data, roles.name as role')
                            ->join('model_has_roles', function ($join) {
                                $join->on('users.id', '=', 'model_has_roles.model_id')
                                     ->where('model_has_roles.model_type', User::class);
                            })
                            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                            ->join('progress', 'progress.user_id', '=', 'users.id')
                            ->where('users.team_id', Auth::user()->team_id)
                            ->where('roles.name', 'LIKE', '%Operator%')
                            ->groupBy('users.name')
                            ->get();
        //
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
        $competencyid = Session::get('competencyid');

        NoteOperator::create([
            'competency_id' => $competencyid,
            'note'          => $request->note
        ]);

        return redirect()->route('spv.coaching.evaluation', $competencyid);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        Session::put('userid', $user->id);
        Session::put('usernip', $user->nip);
        Session::put('username', $user->name);
        Session::put('userrole', $user->roles->first()->name);

        $competency = Competency::where('role', 'LIKE', '%Operator%')->groupBy('name')->get();
        $outercompetency = Competency::all();
        $formevaluasi = FormEvaluationOperator::select('tools')->groupBy('tools')->get();

        $pgasturbin = Competency::selectRaw('SUM(progress.progress) as data')
                                ->join('progress', 'progress.competency_id', '=', 'competencies.id')
                                ->where('progress.user_id', $user->id)
                                ->where('competencies.name', 'LIKE', '%Tools Gas Turbin%')
                                ->groupBy('competencies.name')
                                ->pluck('data');

        $data = $pgasturbin->values();

        $rgasturbin['gasturbin'] = $data;

        $gasturbin = app()->chartjs
        ->name('gasturbin')
        ->type('doughnut')
        ->size(['width' => 200, 'height' => 200])
        ->labels(['Tools Gas Turbin'])
        ->datasets([
            [
                'backgroundColor' => ['#FF6384'],
                'hoverBackgroundColor' => ['#FF6384'],
                'data' => $rgasturbin['gasturbin']
            ]
        ])
        ->options([]);

        $phrsg = Competency::selectRaw('SUM(progress.progress) as data')
                                ->join('progress', 'progress.competency_id', '=', 'competencies.id')
                                ->where('progress.user_id', $user->id)
                                ->where('competencies.name', 'LIKE', '%Tools HRSG%')
                                ->groupBy('competencies.name')
                                ->pluck('data');

        $data = $phrsg->values();

        $rhrsg['hrsg'] = $data;

        $hrsg = app()->chartjs
        ->name('hrsg')
        ->type('doughnut')
        ->size(['width' => 200, 'height' => 200])
        ->labels(['Tools HRSG'])
        ->datasets([
            [
                'backgroundColor' => ['#36A2EB'],
                'hoverBackgroundColor' => ['#36A2EB'],
                'data' => $rhrsg['hrsg']
            ]
        ])
        ->options([]);

        $ppltgu = Competency::selectRaw('SUM(progress.progress) as data')
                                ->join('progress', 'progress.competency_id', '=', 'competencies.id')
                                ->where('progress.user_id', $user->id)
                                ->where('competencies.name', 'LIKE', '%Tools PLTGU%')
                                ->groupBy('competencies.name')
                                ->pluck('data');

        $data = $ppltgu->values();

        $rpltgu['pltgu'] = $data;

        $pltgu = app()->chartjs
        ->name('pltgu')
        ->type('doughnut')
        ->size(['width' => 200, 'height' => 200])
        ->labels(['Tools PLTGU'])
        ->datasets([
            [
                'backgroundColor' => ['#ff00dc'],
                'hoverBackgroundColor' => ['#ff00dc'],
                'data' => $rpltgu['pltgu']
            ]
        ])
        ->options([]);

        $psteamturbin = Competency::selectRaw('SUM(progress.progress) as data')
                                ->join('progress', 'progress.competency_id', '=', 'competencies.id')
                                ->where('progress.user_id', $user->id)
                                ->where('competencies.name', 'LIKE', '%Tools Steam Turbin%')
                                ->groupBy('competencies.name')
                                ->pluck('data');

        $data = $psteamturbin->values();

        $rsteamturbin['steamturbin'] = $data;

        $steamturbin = app()->chartjs
        ->name('steamturbin')
        ->type('doughnut')
        ->size(['width' => 200, 'height' => 200])
        ->labels(['Tools Stream Turbin'])
        ->datasets([
            [
                'backgroundColor' => ['#1fff00'],
                'hoverBackgroundColor' => ['#1fff00'],
                'data' => $rsteamturbin['steamturbin']
            ]
        ])
        ->options([]);

        return view('layouts.supervisor.mentoring.detail', compact(['user', 'formevaluasi', 'competency', 'outercompetency', 'gasturbin', 'hrsg', 'pltgu', 'steamturbin']));
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
     * Get competency id by sub category
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCompetencyId(Request $request)
    {
        $subcategory = $request->sub_category;

        $id = Competency::select('competencies.id')->where('sub_category', $subcategory)->get();

        $response['data'] = $id;

        return response()->json($response);
    }

    /**
     * Get form evaluation by tools name.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEvaluation(Request $request)
    {
        $tools = $request->tools;

        $data = FormEvaluationOperator::select('form_evaluation_operators.id', 'tools', 'unit', 'competence_test', 'test_material', 'evaluation_operators.result as e_result', 'evaluation_operators.description as e_description')
        ->leftJoin('evaluation_operators', function($join){
            $id = Session::get('userid');
            $join->on('evaluation_operators.formevaluation_id', '=', 'form_evaluation_operators.id');
            $join->where('evaluation_operators.user_id', $id);
        })
        ->where('form_evaluation_operators.tools', $tools)
        ->get();

        $response['data'] = $data;

        return response()->json($response);
    }

    /**
     * post result score evaluation
     *
     * @return \Illuminate\Http\Response
     */
    public function postResult(Request $request)
    {
        $id = Session::get('userid');
        $competencyid = $request->competencyid;
        $formevaluationid = $request->formevaluationid;
        $result = $request->result;

        $validation = EvaluationOperator::where('formevaluation_id', $formevaluationid)
        ->where('user_id', $id)
        ->count();

        if($validation == 0){
            EvaluationOperator::create([
                'user_id'               => $id,
                'competency_id'         => $competencyid,
                'formevaluation_id'     => $formevaluationid,
                'result'                => $result
            ]);
        }else{
            EvaluationOperator::where('formevaluation_id', $formevaluationid)->update([
                'user_id'               => $id,
                'competency_id'         => $competencyid,
                'formevaluation_id'     => $formevaluationid,
                'result'                => $result
            ]);

        }
        return response()->json(['success' => true]);
    }

    /**
     * post description score evaluation
     *
     * @return \Illuminate\Http\Response
     */
    public function postDescription(Request $request)
    {
        $id = Session::get('userid');
        $competencyid = $request->competencyid;
        $formevaluationid = $request->formevaluationid;
        $description = $request->description;

        $validation = EvaluationOperator::where('formevaluation_id', $formevaluationid)
        ->where('user_id', $id)
        ->count();

        if($validation == 0){
            EvaluationOperator::create([
                'user_id'               => $id,
                'competency_id'         => $competencyid,
                'formevaluation_id'     => $formevaluationid,
                'description'           => $description
            ]);
        }else{
            EvaluationOperator::where('formevaluation_id', $formevaluationid)->update([
                'user_id'               => $id,
                'competency_id'         => $competencyid,
                'formevaluation_id'     => $formevaluationid,
                'description'           => $description
            ]);

        }
        return response()->json(['success' => true]);
    }

    /**
     * Get form note by competency id.
     *
     * @return \Illuminate\Http\Response
     */
    public function getnote(Request $request)
    {
        $competencyid = $request->competencyid;

        $note = NoteOperator::where('competency_id', $competencyid)->get();

        $response['data'] = $note;

        return response()->json($response);
    }

    /**
     * post note evaluation
     *
     * @return \Illuminate\Http\Response
     */
    public function saveNote(Request $request)
    {
        $userid = Session::get('userid');
        $validation = NoteOperator::where('competency_id', $request->competencyid)
        ->where('user_id', $userid)
        ->count();

        if($validation == 0){
            NoteOperator::create([
                'user_id'       => $userid,
                'competency_id' => $request->competencyid,
                'note'          => $request->note
            ]);
        }else{
            NoteOperator::where('competency_id', $request->competencyid)
            ->where('user_id', $userid)->update([
                'user_id'       => $userid,
                'competency_id' => $request->competencyid,
                'note'          => $request->note
            ]);
        }

        return response()->json(['success' => true]);
    }
}
