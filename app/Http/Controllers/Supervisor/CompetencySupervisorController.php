<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\AnswerSupervisor;
use App\Models\Competency;
use App\Models\QuestionSupervisor;
use Illuminate\Http\Request;

class CompetencySupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competency = Competency::all();
        return view('layouts.supervisor.competency.content', compact(['competency']));
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
            'questionid'    => 'required|integer',
            'essay'         => '',
            'image'         => 'mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:2048'
        ]);

        // if($request->hasAny('essay')){
        //     $jawaban = $request->essay;
        // }

        if($request->hasFile('image')){
            $path = $request->file('image')->store('public/answer/supervisor-answer');
        }else{
            $path = null;
        }

        AnswerSupervisor::create([
            'user_id'       => 2,
            'question_id'   => $attrs['questionid'],
            'essay'         => $attrs['essay'],
            'file'          => $path
        ]);

        return redirect()->route('competency-tools-spv.index')->with('success','Answer has been submitted successfully.');
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
    public function getCategoryByCompetency(Request $request)
    {
        $competency = $request->competency;

        $category = QuestionSupervisor::select('category')
                    ->where('competency', 'LIKE','%'.$competency.'%')
                    ->groupBy('category')
                    ->orderBy('category', 'desc')
                    ->get();

        $response['data'] = $category;

        return response()->json($response);
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

        return response()->json($response);
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
                    // ->groupBy('sub_category')
                    // ->orderBy('sub_category', 'desc')
                    ->get();

        $response['data'] = $subcategory;

        return response()->json($response);
    }
}
