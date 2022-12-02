<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnswerSupervisor;
use App\Models\Competency;
use App\Models\Progress;
use App\Models\QuestionSupervisor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompetencySupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $data = Competency::where('role', 'Supervisor')->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data
        ], 200);
    }

    /**
     * Submit answer and set status into 0
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitAnswer(Request $request): JsonResponse
    {
        $attrs = $request->validate([
            'idcompetency'  => 'required|integer',
            'questionid'    => 'required|integer',
            'essay'         => '',
            'image'         => 'mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:2048'
        ]);

        if($request->hasFile('image')){
            // $path = $request->file('image')->store('answer/supervisor-answer');
            $file = $request->file('image');
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
            $path = $file->move('storage/answer/supervisor/answer', $filename);
        }else{
            $path = null;
        }

        $validation_answer = AnswerSupervisor::where('question_id', $attrs['questionid'])
        ->where('user_id', auth('sanctum')->user()->id)
        ->count();
        if($validation_answer == 0){
            $data = AnswerSupervisor::create([
                'user_id'       => auth('sanctum')->user()->id,
                'competency_id' => $attrs['idcompetency'],
                'question_id'   => $attrs['questionid'],
                'essay'         => $attrs['essay'],
                'file'          => $path,
                'status'        => 0
            ]);
        }else{
            $data = AnswerSupervisor::where('question_id', $attrs['questionid'])
            ->where('user_id', auth('sanctum')->user()->id)
            ->update([
                'essay'         => $attrs['essay'],
                'file'          => $path,
                'status'        => 0
            ]);
        }

        $competency = Competency::find($attrs['idcompetency']);
        $total_question = QuestionSupervisor::where('competency', $competency->name)->count();
        $total_submit = AnswerSupervisor::where('user_id', '=' , auth('sanctum')->user()->id)
                        ->where('competency_id', '=', $competency->id)
                        ->count();
        $validation = Progress::where('user_id', '=' , auth('sanctum')->user()->id)
                            ->where('competency_id', '=', $competency->id)
                            ->count();

        function get_percentage($total, $number)
        {
            if ( $total > 0 ) {
                return round(($number * 100) / $total, 2);
            } else {
                return 0;
            }
        }

        if($validation == 0){
            Progress::create([
                'user_id'       => auth('sanctum')->user()->id,
                'team_id'       => auth('sanctum')->user()->team_id,
                'competency_id' => $competency->id,
                'submit_time'   => $total_submit,
                'progress'      => get_percentage($total_question, $total_submit)
            ]);
        }else{
            Progress::where('user_id', '=' , auth('sanctum')->user()->id)
            ->where('competency_id', '=' , $competency->id)
            ->update([
                'team_id'       => auth('sanctum')->user()->team_id,
                'submit_time'   => $total_submit,
                'progress'      => get_percentage($total_question, $total_submit)
            ]);
        }

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data
        ], 200);
    }

    /**
     * Publish answer and set status into 1
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function publishAnswer(Request $request): JsonResponse
    {
        $data = AnswerSupervisor::where('question_id', 'LIKE', '%'.$request->questionid.'%')
        ->where('user_id', auth('sanctum')->user()->id)
        ->update(['status' => 1]);

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data
        ], 200);
    }

    /**
     * Get all category questions by competency
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCategory(Request $request): JsonResponse
    {
        $competency = $request->competency;

        $data = Competency::select('category')
        ->where('name', 'LIKE','%'.$competency.'%')
        ->groupBy('category')
        ->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data
        ], 200);
    }

    /**
     * Get all sub category questions by category
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSubCategory(Request $request): JsonResponse
    {
        $category = $request->category;

        $data = Competency::select('sub_category')
        ->where('category', 'LIKE','%'.$category.'%')
        ->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data
        ], 200);
    }

    /**
     * Get all questions by sub category
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getQuestion(Request $request): JsonResponse
    {
        $category = $request->category;
        $subcategory = $request->subcategory;

        $data = QuestionSupervisor::where('category', 'LIKE', '%'.$category.'%')
        ->where('sub_category', $subcategory)
        ->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data
        ], 200);
    }

    /**
     * Get all image questions by sub category
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getImage(Request $request): JsonResponse
    {
        $competency = $request->competency;
        $subcategory = $request->subcategory;

        $data = Competency::select('*')
        ->where('name', 'LIKE', '%'.$competency.'%')
        ->where('sub_category', 'LIKE','%'.$subcategory.'%')
        ->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data
        ], 200);
    }

    /**
     * Get id competency
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getIdCompetency(Request $request): JsonResponse
    {
        $competency = $request->competency;

        $data = Competency::select('id')->where('name', 'LIKE', '%'.$competency.'%')->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data
        ], 200);
    }

    /**
     * Get all spesificied answer supervisor by questionid
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAnswer(Request $request): JsonResponse
    {
        $questionid = $request->questionid;

        $data = AnswerSupervisor::where('question_id', 'LIKE', '%'.$questionid.'%')
        ->where('user_id',auth('sanctum')->user()->id)
        ->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $data
        ], 200);
    }
}
