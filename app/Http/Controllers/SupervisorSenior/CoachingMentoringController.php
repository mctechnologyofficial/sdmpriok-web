<?php

namespace App\Http\Controllers\SupervisorSenior;

use App\Http\Controllers\Controller;
use App\Models\Competency;
use App\Models\EvaluationSupervisor;
use App\Models\FormEvaluationSupervisor;
use App\Models\NoteSupervisor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
                            ->where('roles.name', '=', 'Supervisor')
                            ->groupBy('users.name')
                            ->get();
        return view('layouts.supervisor-senior.coaching-mentoring.list', compact(['user']));
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
        $user = User::find($id);
        Session::put('userid', $user->id);
        Session::put('usernip', $user->nip);
        Session::put('username', $user->name);
        Session::put('userrole', $user->roles->first()->name);

        $competency = Competency::where('role', 'LIKE', '%Supervisor%')->groupBy('name')->get();
        $outercompetency = Competency::all();
        $formevaluasi = FormEvaluationSupervisor::select('tools')->groupBy('tools')->get();

        $psistemproteksi = Competency::selectRaw('SUM(progress.progress) as data')
                                ->join('progress', 'progress.competency_id', '=', 'competencies.id')
                                ->where('progress.user_id', $user->id)
                                ->where('competencies.name', 'LIKE', '%Sistem Proteksi%')
                                ->groupBy('competencies.name')
                                ->pluck('data');

        $data = $psistemproteksi->values();

        $rsistemproteksi['sistemproteksi'] = $data;

        $sistemproteksi = app()->chartjs
        ->name('sistemproteksi')
        ->type('doughnut')
        ->size(['width' => 200, 'height' => 200])
        ->labels(['Sistem Proteksi'])
        ->datasets([
            [
                'backgroundColor' => ['#FF6384'],
                'hoverBackgroundColor' => ['#FF6384'],
                'data' => $rsistemproteksi['sistemproteksi']
            ]
        ])
        ->options([]);

        $ppengaturandaya = Competency::selectRaw('SUM(progress.progress) as data')
                                ->join('progress', 'progress.competency_id', '=', 'competencies.id')
                                ->where('progress.user_id', $user->id)
                                ->where('competencies.name', 'LIKE', '%Pengaturan Daya dan Eksitasi%')
                                ->groupBy('competencies.name')
                                ->pluck('data');

        $data = $ppengaturandaya->values();

        $rpengaturandaya['pengaturandaya'] = $data;

        $pengaturandaya = app()->chartjs
        ->name('pengaturandaya')
        ->type('doughnut')
        ->size(['width' => 200, 'height' => 200])
        ->labels(['Pengaturan Daya dan Eksitasi'])
        ->datasets([
            [
                'backgroundColor' => ['#FF6384'],
                'hoverBackgroundColor' => ['#FF6384'],
                'data' => $rpengaturandaya['pengaturandaya']
            ]
        ])
        ->options([]);

        $pperencanaan = Competency::selectRaw('SUM(progress.progress) as data')
                                ->join('progress', 'progress.competency_id', '=', 'competencies.id')
                                ->where('progress.user_id', $user->id)
                                ->where('competencies.name', 'LIKE', '%Perencanaan dan Pengendalian Operasi%')
                                ->groupBy('competencies.name')
                                ->pluck('data');

        $data = $pperencanaan->values();

        $rperencanaan['perencanaan'] = $data;

        $perencanaan = app()->chartjs
        ->name('perencanaan')
        ->type('doughnut')
        ->size(['width' => 200, 'height' => 200])
        ->labels(['Perencanaan dan Pengendalian'])
        ->datasets([
            [
                'backgroundColor' => ['#FF6384'],
                'hoverBackgroundColor' => ['#FF6384'],
                'data' => $rperencanaan['perencanaan']
            ]
        ])
        ->options([]);

        $poptimalisasi = Competency::selectRaw('SUM(progress.progress) as data')
                                ->join('progress', 'progress.competency_id', '=', 'competencies.id')
                                ->where('progress.user_id', $user->id)
                                ->where('competencies.name', 'LIKE', '%Optimalisasi Operasi PLTGU%')
                                ->groupBy('competencies.name')
                                ->pluck('data');

        $data = $poptimalisasi->values();

        $roptimalisasi['optimalisasi'] = $data;

        $optimalisasi = app()->chartjs
        ->name('optimalisasi')
        ->type('doughnut')
        ->size(['width' => 200, 'height' => 200])
        ->labels(['Optimalisasi Operasi PLTGU'])
        ->datasets([
            [
                'backgroundColor' => ['#FF6384'],
                'hoverBackgroundColor' => ['#FF6384'],
                'data' => $roptimalisasi['optimalisasi']
            ]
        ])
        ->options([]);

        $panalisa = Competency::selectRaw('SUM(progress.progress) as data')
                                ->join('progress', 'progress.competency_id', '=', 'competencies.id')
                                ->where('progress.user_id', $user->id)
                                ->where('competencies.name', 'LIKE', '%Analisa Air Pembangkit%')
                                ->groupBy('competencies.name')
                                ->pluck('data');

        $data = $panalisa->values();

        $ranalisa['analisa'] = $data;

        $analisa = app()->chartjs
        ->name('analisa')
        ->type('doughnut')
        ->size(['width' => 200, 'height' => 200])
        ->labels(['Analisa Air Pembangkit'])
        ->datasets([
            [
                'backgroundColor' => ['#FF6384'],
                'hoverBackgroundColor' => ['#FF6384'],
                'data' => $ranalisa['analisa']
            ]
        ])
        ->options([]);

        return view('layouts.supervisor-senior.coaching-mentoring.detail', compact(['user', 'formevaluasi', 'competency', 'outercompetency', 'sistemproteksi', 'pengaturandaya', 'perencanaan', 'optimalisasi', 'analisa']));
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
     * Get form evaluation by tools name.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEvaluation(Request $request)
    {
        $tools = $request->tools;

        $data = FormEvaluationSupervisor::select('tools', 'unit', 'competence_test', 'test_material', 'evaluation_supervisors.user_id', 'evaluation_supervisors.result as e_result', 'evaluation_supervisors.description as e_description')
        ->leftJoin('evaluation_supervisors', function($join){
            $id = Session::get('userid');
            $join->on('evaluation_supervisors.formevaluation_id', '=', 'form_evaluation_supervisors.id');
            $join->where('evaluation_supervisors.user_id', $id);
        })
        ->where('form_evaluation_supervisors.tools', $tools)
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

        $validation = EvaluationSupervisor::where('formevaluation_id', $formevaluationid)
        ->where('user_id', $id)
        ->count();

        if($validation == 0){
            EvaluationSupervisor::create([
                'user_id'               => $id,
                'competency_id'         => $competencyid,
                'formevaluation_id'     => $formevaluationid,
                'result'                => $result
            ]);
        }else{
            EvaluationSupervisor::where('formevaluation_id', $formevaluationid)->update([
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

        $validation = EvaluationSupervisor::where('formevaluation_id', $formevaluationid)
        ->where('user_id', $id)
        ->count();

        if($validation == 0){
            EvaluationSupervisor::create([
                'user_id'               => $id,
                'competency_id'         => $competencyid,
                'formevaluation_id'     => $formevaluationid,
                'description'           => $description
            ]);
        }else{
            EvaluationSupervisor::where('formevaluation_id', $formevaluationid)->update([
                'user_id'               => $id,
                'competency_id'         => $competencyid,
                'formevaluation_id'     => $formevaluationid,
                'description'           => $description
            ]);

        }
        return response()->json(['success' => true]);
    }

    /**
     * post note evaluation
     *
     * @return \Illuminate\Http\Response
     */
    public function saveNote(Request $request)
    {
        $userid = Session::get('userid');
        $validation = NoteSupervisor::where('competency_id', $request->competencyid)
        ->where('user_id', $userid)
        ->count();

        if($validation == 0){
            NoteSupervisor::create([
                'user_id'       => $userid,
                'competency_id' => $request->competencyid,
                'note'          => $request->note
            ]);
        }else{
            NoteSupervisor::where('competency_id', $request->competencyid)
            ->where('user_id', $userid)->update([
                'user_id'       => $userid,
                'competency_id' => $request->competencyid,
                'note'          => $request->note
            ]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Get form evaluation by tools name.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCompetencyId(Request $request)
    {
        $subcategory = $request->sub_category;

        $id = Competency::select('competencies.id')
        // ->join('note_supervisors', function($join){
        //     $userid = Session::get('userid');
        //     $join->on('note_supervisors.competency_id', '=', 'competencies.id');
        //     $join->where('note_supervisors.user_id', $userid);
        // })
        ->where('competencies.sub_category', $subcategory)
        ->get();

        $response['data'] = $id;

        return response()->json($response);
    }

    /**
     * Get form note by competency id.
     *
     * @return \Illuminate\Http\Response
     */
    public function getnote(Request $request)
    {
        $competencyid = $request->competencyid;

        $note = NoteSupervisor::where('competency_id', $competencyid)->get();

        $response['data'] = $note;

        return response()->json($response);
    }
}
