<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\AnswerOperator;
use App\Models\Comment;
use App\Models\CommentOperator;
use App\Models\Competency;
use App\Models\Evaluation;
use App\Models\EvaluationOperator;
use App\Models\FormEvaluationOperator;
use App\Models\QuestionOperator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CoachingMentoringController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::selectRaw('users.id as userid, users.nip, users.name, SUM(progress.progress) as data, roles.name as role')
                            ->join('model_has_roles', function ($join) {
                                $join->on('users.id', '=', 'model_has_roles.model_id')
                                     ->where('model_has_roles.model_type', User::class);
                            })
                            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                            ->leftJoin('progress', 'progress.user_id', '=', 'users.id')
                            ->where('users.team_id', Auth::user()->team_id)
                            ->where('roles.name', 'LIKE', '%Operator%')
                            ->groupBy('users.name')
                            ->get();
        //
        return view('layouts.supervisor.mentoring.list', compact(['user']));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        $competency = Competency::where('role', 'LIKE', '%Operator%')->groupBy('name')->get();
        $outercompetency = Competency::all();

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

        return view('layouts.supervisor.mentoring.detail', compact(['user', 'competency', 'outercompetency', 'gasturbin', 'hrsg', 'pltgu', 'steamturbin']));
    }

    /**
     * Get question
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getQuestion(Request $request)
    {
        $reference = $request->reference;

        $data = QuestionOperator::where('lesson', $reference)->get();

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

        $data = AnswerOperator::where('user_id', $user)->where('question_id', $id)->get();

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

        $validation = Evaluation::where('user_id', $user)
        ->where('competency_id', $competencyid)
        ->where('formevaluation_id', $questionid)
        ->count();

        if($validation == 0){
            $data = Evaluation::create([
                'user_id'               => $user,
                'competency_id'         => $competencyid,
                'formevaluation_id'     => $questionid,
                'result'                => $result,
                'description'           => $area,
            ]);
        }else{
            $data = Evaluation::where('user_id', $user)
            ->where('competency_id', $competencyid)
            ->where('formevaluation_id', $questionid)
            ->update([
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
     * Get competency id
     *
     * @return \Illuminate\Http\Response
     */
    public function getCompetencyId(Request $request)
    {
        $subcategory = $request->sub_category;

        $id = Competency::select('competencies.id')
        ->where('competencies.sub_category', $subcategory)
        ->get();

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
        $competencyid = $request->competencyid;
        $questionid = $request->questionid;
        $user = $request->userid;

        $id = Evaluation::where('user_id', $user)
        ->where('competency_id', $competencyid)
        ->where('formevaluation_id', $questionid)
        ->get();

        $response['data'] = $id;

        return response()->json($response);
    }
}
