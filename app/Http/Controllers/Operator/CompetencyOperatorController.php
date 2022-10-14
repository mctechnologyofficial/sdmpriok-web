<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Competency;
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
                    ->where('competency', $competency)
                    ->groupBy('lesson')
                    ->orderBy('lesson', 'asc')
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

        $question = QuestionOperator::select('*')->where('lesson', $lesson)->get();

        $response['data'] = $question;

        return response()->json($response);
    }
}
