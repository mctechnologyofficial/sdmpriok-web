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
        $data = Competency::all();

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Success',
            'data' => $data
        ], 200);
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
    public function store(Request $request): JsonResponse
    {
        $attrs = $request->validate([
            'idcompetency'  => 'required|integer',
            'questionid'    => 'required|integer',
            'essay'         => '',
            'image'         => 'mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:2048'
        ]);

        if($request->hasFile('image')){
            $path = $request->file('image')->store('public/answer/supervisor-answer');
        }else{
            $path = null;
        }

        $data = AnswerSupervisor::create([
            'user_id'       => auth('sanctum')->user()->id,
            'competency_id' => $attrs['idcompetency'],
            'question_id'   => $attrs['questionid'],
            'essay'         => $attrs['essay'],
            'file'          => $path
        ]);

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
            'code' => 200,
            'status' => true,
            'message' => 'Answer has been submitted successfully.',
            'data' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * Get all category questions by competency
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCategoryByCompetency(Request $request): JsonResponse
    {
        $competency = $request->competency;

        $category = QuestionSupervisor::select('category')
                    ->where('competency', 'LIKE','%'.$competency.'%')
                    ->groupBy('category')
                    ->orderBy('category', 'desc')
                    ->get();

        $response['data'] = $category;

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Success',
            'data' => $response
        ], 200);
    }

    /**
     * Get all sub category questions by category
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSubCategoryByCategory(Request $request)
    {
        $category = $request->category;

        $category = QuestionSupervisor::select('sub_category')
                    ->where('category', 'LIKE','%'.$category.'%')
                    ->groupBy('sub_category')
                    ->orderBy('sub_category', 'desc')
                    ->get();

        $response['data'] = $category;

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Success',
            'data' => $response
        ], 200);
    }

    /**
     * Get all questions by sub category
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getQuestionBySubCategory(Request $request)
    {
        $subcategory = $request->subcategory;

        $subcategory = QuestionSupervisor::select('*')
                    ->where('sub_category', 'LIKE','%'.$subcategory.'%')
                    ->get();

        $response['data'] = $subcategory;

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Success',
            'data' => $response
        ], 200);
    }

    /**
     * Get id competency
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getIdCompetency(Request $request){
        $competency = $request->competency;

        $id = Competency::select('id')->where('name', 'LIKE', '%'.$competency.'%')->get();

        $response['data'] = $id;

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Success',
            'data' => $response
        ], 200);
    }
}
