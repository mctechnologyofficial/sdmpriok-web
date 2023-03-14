<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Competency;
use App\Models\Evaluation;
use App\Models\QuestionOperator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompetencyScoreOperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $userId = null;
        if (!is_null(auth('sanctum')->user())) {
            $userId =  auth('sanctum')->user()->id;
        }

        $evaluation = Evaluation::selectRaw('competencies.id, competencies.name, competencies.sub_category, FORMAT(AVG(evaluations.result), 1) as avg_evaluation')
        ->join('competencies', 'competencies.id', '=', 'evaluations.competency_id')
        ->where('evaluations.user_id', $userId)
        ->groupBy('evaluations.competency_id')
        ->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $evaluation
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        $competency = Competency::find($id);
        $competencyid = $competency->id;
        
        $question = QuestionOperator::where('competency', $competency->name)->where('lesson', $competency->sub_category)->get();
        $response['competencyid'] = $competencyid;
        // $response['question'] = $question;

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $question
        ], 200);
    }

    /**
     * Get evaluation
     *
     * @return \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getEvaluation(Request $request): JsonResponse
    {
        $userId = null;
        $user = auth('sanctum')->user();
        if ($user) {
            $userId = auth('sanctum')->user()->id;
        }

        $questionid = $request->questionid;

        $data = Evaluation::where('user_id', $userId)->where('formevaluation_id', $questionid)->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data
        ], 200);
    }

    /**
     * Get comment by question id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getComment(Request $request): JsonResponse
    {
        $userId = null;
        if (auth('sanctum')->user()) {
            $userId = auth('sanctum')->user()->id;
        }

        $competencyid = $request->competencyid;
        $id = $request->questionid;

        $data = Comment::selectRaw('users.name, comments.id, comments.comment, DATE_FORMAT(comments.created_at, "%d %M %Y %T") AS time')
        ->join('users', function($join){
            $join->on('users.id', '=', 'comments.from');
        })
        ->where('competency_id', $competencyid)
        ->where('question_id', $id)
        ->where(function($query) use ($userId){
            return $query
            ->where('from', $userId)
            ->orWhere('to', $userId);
        })
        ->orderBy('comments.created_at', 'DESC')
        ->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data
        ], 200);
    }

    /**
     * Post comment by question id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postComment(Request $request): JsonResponse
    {
        $userId = null;
        $user = auth('sanctum')->user();
        if ($user) {
            $userId = $user->id;
        }

        $comments = Comment::find($request->commentid);
        $competencyid = $request->competencyid;
        $id = $request->questionid;
        $comment = $request->comment;

        $data = Comment::create([
            'competency_id' => $competencyid,
            'question_id'   => $id,
            'from'          => auth('sanctum')->user()->id,
            'to'            => $comments->from,
            'comment'       => $comment
        ]);

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data
        ], 200);
    }
}
