<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\AnswerOperator;
use App\Models\Competency;
use App\Models\Progress;
use App\Models\QuestionOperator;
use Illuminate\Http\Request;

class CompetencyOperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competency = Competency::all();
        return view('layouts.operator.competency.content', compact(['competency']));
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
        $attrs = $request->validate([
            'competencyid'  => 'required|integer',
            'questionid'    => 'required|integer',
            'essay'         => '',
            'image'         => 'mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:2048'
        ]);

        if($request->hasFile('image')){
            $path = $request->file('image')->store('public/answer/operator-answer');
        }else{
            $path = null;
        }

        AnswerOperator::create([
            'user_id'       => 3,
            'competency_id' => $attrs['competencyid'],
            'question_id'   => $attrs['questionid'],
            'essay'         => $attrs['essay'],
            'file'          => $path
        ]);

        $competency = Competency::find($attrs['competencyid']);
        $total_question = QuestionOperator::where('competency', $competency->name)->count();
        $total_submit = AnswerOperator::where('user_id', '=' ,'3')
                        ->where('competency_id', '=', $competency->id)
                        ->count();
        $validation = Progress::where('user_id', '=' ,'3')
                    // ->where('competency_id', '=', $competency->name)
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
                'user_id'       => 3,
                // 'competency_id'    => $competency->id,
                'submit_time'   => $total_submit,
                'progress'      => get_percentage($total_question, $total_submit)
            ]);
        }else{
            Progress::where('user_id', '=' ,'3')
            // ->where('competency_id', '=', $competency->id)
            ->update([
                'submit_time'   => $total_submit,
                'progress'      => get_percentage($total_question, $total_submit)
            ]);
        }

        return redirect()->route('competency-tools-op.index')->with('success','Answer has been submitted successfully.');
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
     * Get all operator lessons by competency
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getLessonByCompetency(Request $request){
        $competency = $request->competency;

        $lesson = QuestionOperator::select('lesson')
                    ->where('competency', 'LIKE', '%'.$competency.'%')
                    ->groupBy('lesson')
                    ->orderBy('id', 'asc')
                    ->get();

        $response['data'] = $lesson;

        return response()->json($response);
    }

    /**
     * Get all operator questions by competency
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getQuestionByLesson(Request $request){
        $lesson = $request->lesson;

        $question = QuestionOperator::select('*')->where('lesson', 'LIKE', '%'.$lesson.'%')->get();

        $response['data'] = $question;

        return response()->json($response);
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

        return response()->json($response);
    }
}
