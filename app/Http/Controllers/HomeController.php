<?php

namespace App\Http\Controllers;

use App\Models\AnswerSupervisor;
use App\Models\Competency;
use App\Models\Progress;
use App\Models\QuestionSupervisor;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function IndexSupervisor(){
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

        $teams = User::selectRaw('SUM(progress.progress) as total')
        ->leftJoin('model_has_roles', function ($join) {
            $join->on('model_has_roles.model_id', '=', 'users.id');
            $join->where('model_has_roles.model_type', '=', 'app\Models\User');
     	 })
      	->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
      	->where('roles.name', 'LIKE', '%Operator%')
        ->join('progress', 'progress.user_id', '=', 'users.id')
        ->where('progress.team_id', Auth::user()->team_id)
        ->pluck('total');

        $total = $teams->values();

        $result_total = str_replace(str_split('[]'), '', $total);
        return view('layouts.supervisor.index', compact(['slide', 'total_progress', 'result_total']));
    }

    public function IndexOperator(){
        $totalmodule = Competency::where('role', 'Operator')->count();

        return view('layouts.operator.index', compact(['totalmodule']));
    }

    public function getRadarIndexOperator()
    {
        $competency = Competency::select('competencies.name', 'progress.progress')
        ->join('progress', 'progress.competency_id', '=', 'competencies.id')
        ->where('progress.user_id', Auth::user()->id)
        ->groupBy('competencies.name', 'progress.progress')
        ->orderBy('competencies.id', 'ASC')
        ->pluck('competencies.name', 'progress.progress');

        $label = $competency->values();
        $data = $competency->keys();

        $response['label'] = $label;
        $response['data'] = $data;

        return response()->json($response);
    }

    public function IndexAdmin(){
        $totaluser = User::count();
        $totalmodule = Competency::count();

        return view('layouts.admin.index', compact(['totaluser', 'totalmodule']));
    }

    public function IndexSupervisorSenior()
    {
        $slide = Slide::all();

        $teams = User::selectRaw('SUM(progress.progress) as total')
        ->leftJoin('model_has_roles', function ($join) {
            $join->on('model_has_roles.model_id', '=', 'users.id');
            $join->where('model_has_roles.model_type', '=', 'app\Models\User');
     	 })
      	->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
      	->where('roles.name', 'LIKE', '%Operator%')
        ->join('progress', 'progress.user_id', '=', 'users.id')
        ->where('progress.team_id', Auth::user()->team_id)
        ->pluck('total');

        $total = $teams->values();

        $result_total = str_replace(str_split('[]'), '', $total);
        return view('layouts.supervisor-senior.index', compact(['result_total', 'slide']));
    }
}
