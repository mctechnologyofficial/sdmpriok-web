<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnswerOperator;
use App\Models\AnswerSupervisor;
use App\Models\Comment;
use App\Models\Competency;
use App\Models\EvaluationOperator;
use App\Models\EvaluationSupervisor;
use App\Models\QuestionOperator;
use App\Models\QuestionSupervisor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::selectRaw('users.id as userid, users.nip, users.name, SUM(progress.progress) as data, roles.name as role, teams.name as team')
        ->join('model_has_roles', function ($join) {
            $join->on('users.id', '=', 'model_has_roles.model_id')
                    ->where('model_has_roles.model_type', User::class);
        })
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->leftJoin('progress', 'progress.user_id', '=', 'users.id')
        ->leftJoin('teams', 'teams.id', '=', 'users.team_id')
        ->where('roles.name', 'NOT LIKE', '%Admin%')
        ->where('roles.name', 'NOT LIKE', '%Supervisor Senior%')
        ->groupBy('users.name')
        ->get();

        return view('layouts.admin.mentoring.index', compact(['user']));
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
        $outercompetency = Competency::all();

        if($user->roles->first()->name == "supervisor"){
            $competency = Competency::where('role', 'LIKE', '%Supervisor%')->groupBy('name')->get();
        }else{
            $competency = Competency::where('role', 'LIKE', '%Operator%')->groupBy('name')->get();
        }

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

        return view('layouts.admin.mentoring.detail', compact(['user', 'competency', 'outercompetency', 'gasturbin', 'hrsg', 'pltgu', 'steamturbin', 'sistemproteksi', 'pengaturandaya', 'perencanaan', 'optimalisasi', 'analisa']));
    }

    /**
     * Get category spv
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCategorySpv(Request $request)
    {
        $subcategory = $request->subcategory;

        $data = Competency::select('*')
        ->where('sub_category', $subcategory)
        ->get();

        $response['data'] = $data;

        return response()->json($response);
    }

    /**
     * Get question spv
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getQuestionSpv(Request $request)
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
     * Get answer spv
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAnswerSpv(Request $request)
    {
        $id = $request->questionid;
        $user = $request->userid;

        $data = AnswerSupervisor::where('user_id', $user)->where('question_id', $id)->get();

        $response['data'] = $data;

        return response()->json($response);
    }

    /**
     * Get comment spv by question id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCommentSpv(Request $request)
    {
        $competencyid = $request->competencyid;
        $id = $request->questionid;
        $userid = $request->userid;

        $data = Comment::selectRaw('users.name, comments.comment, DATE_FORMAT(comments.created_at, "%d %M %Y %T") AS time')
        ->join('users', function($join){
            $join->on('users.id', '=', 'comments.from');
        })
        ->where('competency_id', $competencyid)
        ->where('question_id', '=', $id)
        // ->where('to', $userid)
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
     * Get evaluation spv
     *
     * @return \Illuminate\Http\Response
     */
    public function getEvaluationSpv(Request $request)
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
     * Post comment spv
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCommentSpv(Request $request)
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
     * Save Evaluation spv
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveEvaluationSpv(Request $request)
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

    /**
     * Get question op
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getQuestionOp(Request $request)
    {
        $reference = $request->reference;

        $data = QuestionOperator::where('lesson', $reference)->get();

        $response['data'] = $data;

        return response()->json($response);
    }

    /**
     * Get answer op
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAnswerOp(Request $request)
    {
        $id = $request->questionid;
        $user = $request->userid;

        $data = AnswerOperator::where('user_id', $user)->where('question_id', $id)->get();

        $response['data'] = $data;

        return response()->json($response);
    }

    /**
     * Get comment op
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCommentOp(Request $request)
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
     * Post comment op
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCommentOp(Request $request)
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
     * Save Evaluation op
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveEvaluationOp(Request $request)
    {
        $competencyid = $request->competencyid;
        $questionid = $request->questionid;
        $user = $request->userid;
        $result = $request->result;
        $area = $request->area;

        $validation = EvaluationOperator::where('user_id', $user)->where('formevaluation_id', $questionid)->count();

        if($validation == 0){
            $data = EvaluationOperator::create([
                'user_id'               => $user,
                'competency_id'         => $competencyid,
                'formevaluation_id'     => $questionid,
                'result'                => $result,
                'description'           => $area,
            ]);
        }else{
            $data = EvaluationOperator::where('user_id', $user)->where('formevaluation_id', $questionid)->update([
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

    /**
     * Get competency id op
     *
     * @return \Illuminate\Http\Response
     */
    public function getCompetencyIdOp(Request $request)
    {
        $subcategory = $request->sub_category;

        $id = Competency::select('competencies.id')
        ->where('competencies.sub_category', $subcategory)
        ->get();

        $response['data'] = $id;

        return response()->json($response);
    }

    /**
     * Get evaluation op
     *
     * @return \Illuminate\Http\Response
     */
    public function getEvaluationOp(Request $request)
    {
        $questionid = $request->questionid;
        $user = $request->userid;

        $id = EvaluationOperator::where('user_id', $user)
        ->where('formevaluation_id', $questionid)
        ->get();

        $response['data'] = $id;

        return response()->json($response);
    }
}
