<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Competency;
use App\Models\Evaluation;
use App\Models\EvaluationSupervisor;
use App\Models\QuestionSupervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompetencyScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluation = Evaluation::selectRaw('competencies.id, competencies.name, competencies.sub_category, FORMAT(AVG(evaluations.result), 1) as avg_evaluation')
        ->join('competencies', 'competencies.id', '=', 'evaluations.competency_id')
        ->where('evaluations.user_id', Auth::user()->id)
        ->groupBy('evaluations.competency_id')
        ->get();
        return view('layouts.supervisor.competency-score.content', compact(['evaluation']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $competency = Competency::find($id);
        $competencyid = $competency->id;

        $question = QuestionSupervisor::where('competency', $competency->name)->where('sub_category', $competency->sub_category)->get();

        return view('layouts.supervisor.competency-score.detail', compact(['question', 'competencyid']));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getEvaluation(Request $request)
    {
        $user = Auth::user()->id;
        $questionid = $request->questionid;

        $data = Evaluation::where('user_id', $user)->where('formevaluation_id', $questionid)->get();

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

        $data = Comment::selectRaw('users.name, comments.id, comments.comment, DATE_FORMAT(comments.created_at, "%d %M %Y %T") AS time')
        ->join('users', function($join){
            $join->on('users.id', '=', 'comments.from');
        })
        ->where('competency_id', $competencyid)
        ->where('question_id', $id)
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
        $comments = Comment::find($request->commentid);
        $competencyid = $request->competencyid;
        $id = $request->questionid;
        $comment = $request->comment;

        $data = Comment::create([
            'competency_id' => $competencyid,
            'question_id'   => $id,
            'from'          => Auth::user()->id,
            'to'            => $comments->from,
            'comment'       => $comment
        ]);

        $response['data'] = $data;

        return response()->json($response);
    }
}
