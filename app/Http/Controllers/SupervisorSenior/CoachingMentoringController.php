<?php

namespace App\Http\Controllers\SupervisorSenior;

use App\Http\Controllers\Controller;
use App\Models\AnswerSupervisor;
use App\Models\Comment;
use App\Models\Competency;
use App\Models\EvaluationSupervisor;
use App\Models\FormEvaluationSupervisor;
use App\Models\NoteSupervisor;
use App\Models\QuestionSupervisor;
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
                            ->leftJoin('progress', 'progress.user_id', '=', 'users.id')
                            ->where('users.team_id', Auth::user()->team_id)
                            ->where('roles.name', '=', 'Supervisor')
                            ->groupBy('users.name')
                            ->get();
        return view('layouts.supervisor-senior.coaching-mentoring.list', compact(['user']));
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

        return view('layouts.supervisor-senior.coaching-mentoring.detail', compact(['user', 'competency', 'outercompetency', 'sistemproteksi', 'pengaturandaya', 'perencanaan', 'optimalisasi', 'analisa']));
    }

    /**
     * Get question
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCategory(Request $request)
    {
        $subcategory = $request->subcategory;

        $data = Competency::select('*')
        ->where('sub_category', $subcategory)
        ->get();

        $response['data'] = $data;

        return response()->json($response);
    }

    /**
     * Get question
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getQuestion(Request $request)
    {
        $category = $request->category;
        $sub_category = $request->sub_category;

        $data = QuestionSupervisor::where('category', 'LIKE', '%'.$category.'%')
        ->where('sub_category', $sub_category)
        ->get();

        $response['data'] = $data;

        return response()->json($response);
    }

    /**
     * Get answer
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAnswer(Request $request)
    {
        $id = $request->questionid;
        $user = $request->userid;

        $data = AnswerSupervisor::where('user_id', $user)->where('question_id', $id)->get();

        $response['data'] = $data;

        return response()->json($response);
    }

    /**
     * Get comment by question id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getComment(Request $request)
    {
        $competencyid = $request->competencyid;
        $id = $request->questionid;
        $to = $request->userid;

        $data = Comment::selectRaw('users.name, comments.comment, DATE_FORMAT(comments.created_at, "%d %M %Y %T") AS time')
        ->join('users', function($join){
            $join->on('users.id', '=', 'comments.from');
        })
        ->where('competency_id', $competencyid)
        ->where('question_id', '=', $id)
        // ->where('to', $to)
        // ->where('from', Auth::user()->id)
        ->where(function($query){
            return $query
            ->where('from', Auth::user()->id)
            ->orWhere('to', Auth::user()->id);
        })
        ->orderBy('comments.created_at', 'DESC')
        ->get();

        $response['data'] = $data;

        return response()->json($response);
    }

    /**
     * Get form evaluation by tools name.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEvaluation(Request $request)
    {
        $questionid = $request->questionid;
        $user = $request->userid;

        $id = EvaluationSupervisor::where('user_id', $user)
        ->where('formevaluation_id', $questionid)
        ->get();

        $response['data'] = $id;

        return response()->json($response);
    }

    /**
     * Post comment by question id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postComment(Request $request)
    {
        $competencyid = $request->competencyid;
        $id = $request->questionid;
        $user = $request->userid;
        $comment = $request->comment;

        $data = Comment::create([
            'competency_id' => $competencyid,
            'question_id'   => $id,
            'from'          => Auth::user()->id,
            'to'            => $user,
            'comment'       => $comment
        ]);

        $response['data'] = $data;

        return response()->json($response);
    }

    /**
     * Save Evaluation
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveEvaluation(Request $request)
    {
        $competencyid = $request->competencyid;
        $questionid = $request->questionid;
        $user = $request->userid;
        $result = $request->result;
        $area = $request->area;

        $validation = EvaluationSupervisor::where('user_id', $user)->where('formevaluation_id', $questionid)->count();

        if($validation == 0){
            $data = EvaluationSupervisor::create([
                'user_id'               => $user,
                'competency_id'         => $competencyid,
                'formevaluation_id'     => $questionid,
                'result'                => $result,
                'description'           => $area,
            ]);
        }else{
            $data = EvaluationSupervisor::where('user_id', $user)->where('formevaluation_id', $questionid)->update([
                'user_id'               => $user,
                'competency_id'         => $competencyid,
                'formevaluation_id'     => $questionid,
                'result'                => $result,
                'description'           => $area,
            ]);
        }

        $response['data'] = $data;

        return response()->json($response);
    }
}
