<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnswerOperator;
use App\Models\AnswerSupervisor;
use App\Models\Comment;
use App\Models\Competency;
use App\Models\Evaluation;
use App\Models\QuestionOperator;
use App\Models\QuestionSupervisor;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CoachingMentoringAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
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
            
        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $user
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
        $user = User::find($id);
        if ($user->roles->first()->name == "supervisor") {
            $competency = Competency::where('role', 'LIKE', '%Supervisor%')->groupBy('name')->get();
        } else {
            $competency = Competency::where('role', 'LIKE', '%Operator%')->groupBy('name')->get();
        }

        $response['user'] = $user;
        $response['competency'] = $competency;

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $response,
        ], 200);
    }

    /**
     * Get question spv
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getQuestionSpv(Request $request): JsonResponse
    {
        $category = $request->category;
        $sub_category = $request->sub_category;

        $data = QuestionSupervisor::where('category', 'LIKE', '%' . $category . '%')
            ->where('sub_category', $sub_category)
            ->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data,
        ], 200);
    }

    /**
     * Get answer spv
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAnswerSpv(Request $request): JsonResponse
    {
        $id = $request->questionid;
        $user = $request->userid;

        $data = AnswerSupervisor::where('user_id', $user)->where('question_id', $id)->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data,
        ], 200);
    }

    /**
     * Get question op
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getQuestionOp(Request $request): JsonResponse
    {
        $reference = $request->reference;

        $data = QuestionOperator::where('lesson', $reference)->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data,
        ], 200);
    }

    /**
     * Get answer op
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAnswerOp(Request $request): JsonResponse
    {
        $id = $request->questionid;
        $user = $request->userid;

        $data = AnswerOperator::where('user_id', $user)->where('question_id', $id)->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data,
        ], 200);
    }

    /**
     * Get comment spv by question id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getComment(Request $request): JsonResponse
    {
        $competencyid = $request->competencyid;
        $id = $request->questionid;

        $data = Comment::selectRaw('users.name, comments.comment, DATE_FORMAT(comments.created_at, "%d %M %Y %T") AS time')
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'comments.from');
            })
            ->where('competency_id', $competencyid)
            ->where('question_id', '=', $id)
            ->where(function ($query) {
                return $query
                    ->where('from', auth('sanctum')->user()->id)
                    ->orWhere('to', auth('sanctum')->user()->id);
            })
            ->orderBy('comments.created_at', 'DESC')
            ->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data,
        ], 200);
    }

    /**
     * Get evaluation spv
     *
     * @return \Illuminate\Http\Response
     */
    public function getEvaluation(Request $request): JsonResponse
    {
        $competencyid = $request->competencyid;
        $questionid = $request->questionid;
        $user = $request->userid;

        $id = Evaluation::where('user_id', $user)
            ->where('competency_id', $competencyid)
            ->where('formevaluation_id', $questionid)
            ->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $id,
        ], 200);
    }

    /**
     * Post comment spv
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postComment(Request $request): JsonResponse
    {
        $competencyid = $request->competencyid;
        $id = $request->questionid;
        $user = $request->userid;
        $comment = $request->comment;

        $data = Comment::create([
            'competency_id' => $competencyid,
            'question_id'   => $id,
            'from'          => auth('sanctum')->user()->id,
            'to'            => $user,
            'comment'       => $comment
        ]);

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data,
        ], 200);
    }

    /**
     * Save Evaluation spv
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveEvaluation(Request $request): JsonResponse
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

        if ($validation == 0) {
            $data = Evaluation::create([
                'user_id'               => $user,
                'competency_id'         => $competencyid,
                'formevaluation_id'     => $questionid,
                'result'                => $result,
                'description'           => $area,
            ]);
        } else {
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

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data,
        ], 200);
    }
}
