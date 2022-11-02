<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\AnswerSupervisor;
use App\Models\QuestionSupervisor;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoachingMentoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slide = Slide::all();

        $total_question = QuestionSupervisor::count();
        $total_submit = AnswerSupervisor::where('user_id', '=' , Auth::user()->id)->count();
        function get_percentage($total, $number)
        {
            if ( $total > 0 ) {
                return round(($number * 100) / $total, 2);
            } else {
                return 0;
            }
        }

        $total_progress = get_percentage($total_question, $total_submit);

        $teams = User::role('operator')->selectRaw('SUM(progress.progress) as total')
        ->join('progress', 'progress.user_id', '=', 'users.id')
        ->where('progress.team_id', Auth::user()->team_id)
        ->pluck('total');

        $total = $teams->values();

        $result_total = str_replace(str_split('[]'), '', $total);
        return view('layouts.supervisor.index', compact(['slide', 'total_progress', 'result_total']));
    }

    /**
     * Show list of data coaching mentoring
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return view('layouts.supervisor.mentoring.list');
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
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('layouts.supervisor.mentoring.detail');
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
}
