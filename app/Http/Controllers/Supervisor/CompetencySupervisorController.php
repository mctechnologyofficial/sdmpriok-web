<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\AnswerSupervisor;
use App\Models\Competency;
use App\Models\Progress;
use App\Models\QuestionSupervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompetencySupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competency = Competency::select('*')->groupBy('name')->get();
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
        if(isset($_POST['submit'])){
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
            ->where('user_id', Auth::user()->id)
            ->count();
            if($validation_answer == 0){
                AnswerSupervisor::create([
                    'user_id'       => Auth::user()->id,
                    'competency_id' => $attrs['idcompetency'],
                    'question_id'   => $attrs['questionid'],
                    'essay'         => $attrs['essay'],
                    'file'          => $path,
                    'status'        => 0
                ]);
            }else{
                AnswerSupervisor::where('question_id', $attrs['questionid'])
                ->where('user_id', Auth::user()->id)
                ->update([
                    'essay'         => $attrs['essay'],
                    'file'          => $path,
                    'status'        => 0
                ]);
            }

            $competency = Competency::find($attrs['idcompetency']);
            $total_question = QuestionSupervisor::where('competency', $competency->name)->count();
            $total_submit = AnswerSupervisor::where('user_id', '=' , Auth::user()->id)
                            ->where('competency_id', '=', $competency->id)
                            ->count();
            $validation = Progress::where('user_id', '=' , Auth::user()->id)
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
                    'user_id'       => Auth::user()->id,
                    'team_id'       => Auth::user()->team_id,
                    'competency_id' => $competency->id,
                    'submit_time'   => $total_submit,
                    'progress'      => get_percentage($total_question, $total_submit)
                ]);
            }else{
                Progress::where('user_id', '=' , Auth::user()->id)
                ->where('competency_id', '=' , $competency->id)
                ->update([
                    'team_id'       => Auth::user()->team_id,
                    'submit_time'   => $total_submit,
                    'progress'      => get_percentage($total_question, $total_submit)
                ]);
            }

            return redirect()->route('competency-tools-spv.index')->with('success','Answer has been submitted successfully.');
        }
        else if(isset($_POST['publish'])){
            AnswerSupervisor::where('question_id', 'LIKE', '%'.$request->questionid.'%')
            ->where('user_id', Auth::user()->id)
            ->update(['status' => 1]);

            return redirect()->route('competency-tools-spv.index')->with('success','Answer has been published successfully.');
        }
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
    public function getCategory(Request $request)
    {
        $competency = $request->competency;

        $category = Competency::select('category')
        ->where('name', 'LIKE','%'.$competency.'%')
        ->groupBy('name')
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
    public function getSubCategory(Request $request)
    {
        $category = $request->category;

        $category = Competency::select('sub_category')
                    ->where('category', 'LIKE','%'.$category.'%')
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
    public function getQuestion(Request $request)
    {
        $subcategory = $request->subcategory;

        $subcategory = QuestionSupervisor::select('*')
                    ->where('sub_category', 'LIKE','%'.$subcategory.'%')
                    ->get();

        $response['data'] = $subcategory;

        return response()->json($response);
    }

    /**
     * Get all image questions by sub category
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getImage(Request $request)
    {
        $competency = $request->competency;
        $subcategory = $request->subcategory;

        $subcategory = Competency::select('*')
                    ->where('name', 'LIKE', '%'.$competency.'%')
                    ->where('sub_category', 'LIKE','%'.$subcategory.'%')
                    ->get();

        $response['data'] = $subcategory;

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

    /**
     * Get all spesificied answer supervisor by questionid
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAnswer(Request $request){
        $questionid = $request->questionid;

        $answer = AnswerSupervisor::where('question_id', 'LIKE', '%'.$questionid.'%')
        ->where('user_id', Auth::user()->id)
        ->get();

        $response['data'] = $answer;

        return response()->json($response);
    }
}
