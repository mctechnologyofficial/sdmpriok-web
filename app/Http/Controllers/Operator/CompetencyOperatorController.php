<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\AnswerOperator;
use App\Models\Competency;
use App\Models\Progress;
use App\Models\QuestionOperator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompetencyOperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competency = Competency::select('*')->groupBy('name')->get();
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
        if(isset($_POST['submit'])){
            $attrs = $request->validate([
                'competencyid'  => 'required|integer',
                'questionid'    => 'required|integer',
                'essay'         => '',
                'image'         => 'mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:2048'
            ]);

            if($request->hasFile('image')){
                // $path = $request->file('image')->store('answer/operator-answer');
                $file = $request->file('image');
                $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                $path = $file->move('storage/answer/operator-answer', $filename);
            }else{
                $path = null;
            }

            $validation_answer = AnswerOperator::where('question_id', 'LIKE', '%'.$attrs['questionid'].'%')->count();
            if($validation_answer == 0){
                AnswerOperator::create([
                    'user_id'       => Auth::user()->id,
                    'competency_id' => $attrs['competencyid'],
                    'question_id'   => $attrs['questionid'],
                    'essay'         => $attrs['essay'],
                    'file'          => $path,
                    'status'        => 0
                ]);
            }else{
                AnswerOperator::where('question_id', 'LIKE', '%'.$attrs['questionid'].'%')
                ->where('user_id', Auth::user()->id)
                ->update([
                    'essay'         => $attrs['essay'],
                    'file'          => $path,
                    'status'        => 0
                ]);
            }

            $competency = Competency::find($attrs['competencyid']);
            $total_question = QuestionOperator::where('competency', $competency->name)->count();

            $total_submit = AnswerOperator::where('user_id', '=' , Auth::user()->id)
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
                ->where('competency_id', '=', $competency->id)
                ->update([
                    'team_id'       => Auth::user()->team_id,
                    'submit_time'   => $total_submit,
                    'progress'      => get_percentage($total_question, $total_submit)
                ]);
            }

            return redirect()->route('competency-tools-op.index')->with('success','Answer has been submitted successfully.');
        }
        else if(isset($_POST['publish'])){
            AnswerOperator::where('question_id', 'LIKE', '%'.$request->questionid.'%')
            ->where('user_id', Auth::user()->id)
            ->update(['status' => 1]);

            return redirect()->route('competency-tools-op.index')->with('success','Answer has been published successfully.');
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
     * Get all operator category by competency
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCategory(Request $request){
        $competency = $request->competency;

        $category = Competency::select('category')
                    ->where('name', 'LIKE', '%'.$competency.'%')
                    ->groupBy('category')
                    ->get();

        $response['data'] = $category;

        return response()->json($response);
    }

    /**
     * Get all operator sub category by category
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSubCategory(Request $request){
        $category = $request->category;

        $subcategory = Competency::select('sub_category')
                    ->where('category', 'LIKE', '%'.$category.'%')
                    ->groupBy('sub_category')
                    ->get();

        $response['data'] = $subcategory;

        return response()->json($response);
    }

    /**
     * Get all operator questions by sub category
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getQuestion(Request $request){
        $subcategory = $request->subcategory;

        $question = QuestionOperator::select('*')->where('lesson', 'LIKE', '%'.$subcategory.'%')->get();

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

    /**
     * Get all spesificied answer operator by questionid
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAnswer(Request $request){
        $questionid = $request->questionid;

        $answer = AnswerOperator::where('question_id', 'LIKE', '%'.$questionid.'%')
        ->where('user_id', Auth::user()->id)
        ->get();

        $response['data'] = $answer;

        return response()->json($response);
    }

    /**
     * Get all image operator question by sub_category
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getImage(Request $request){
        $subcategory = $request->subcategory;

        $image = Competency::select('*')->where('sub_category', 'LIKE', '%'.$subcategory.'%')->get();

        $response['data'] = $image;

        return response()->json($response);
    }
}
