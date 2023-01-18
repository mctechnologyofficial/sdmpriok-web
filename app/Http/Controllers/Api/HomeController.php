<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnswerSupervisor;
use App\Models\Competency;
use App\Models\QuestionSupervisor;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function IndexSupervisor(): JsonResponse
    {
        $slide = Slide::all();

        $total_question = QuestionSupervisor::count();
        $total_submit = AnswerSupervisor::where('user_id', '=' , auth('sanctum')->user()->id)->count();
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
        ->where('progress.team_id', auth('sanctum')->user()->team_id)
        ->pluck('total');

        // $total = $teams->values();
        // $result_total = str_replace(str_split('[]'), '', $total);
        $total = $teams->toArray();
        $result = implode("", $total);
        $totalProgress = strval($total_progress);
        
        $response['slide'] = $slide;
        $response['personal_progress'] = $totalProgress;
        $response['team_progress'] = $result;

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $response
        ], 200);
    }

    public function IndexOperator(): JsonResponse
    {
        $totalmodule = Competency::where('role', 'Operator')->count();
        $response['total_module'] = $totalmodule;

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $response
        ], 200);
    }

    public function getRadar(): JsonResponse
    {
        $competency = Competency::select('competencies.name', 'progress.progress')
        ->join('progress', 'progress.competency_id', '=', 'competencies.id')
        ->where('progress.user_id', auth('sanctum')->user()->id)
        ->groupBy('competencies.name', 'progress.progress')
        ->orderBy('competencies.id', 'ASC')
        ->pluck('competencies.name', 'progress.progress');

        $label = $competency->values();
        $data = $competency->keys();

        $response['label'] = $label;
        $response['data'] = $data;

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $response
        ], 200);
    }

    public function IndexAdmin(): JsonResponse
    {
        $totaluser = User::count();
        $totalmodule = Competency::count();

        $response['total_user'] = $totaluser;
        $response['total_module'] = $totalmodule;

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $response
        ], 200);
    }

    public function IndexSupervisorSenior(): JsonResponse
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
        ->where('progress.team_id', auth('sanctum')->user()->team_id)
        ->pluck('total');

        // $total = $teams->values();
        // $result_total = str_replace(str_split('[]'), '', $total);
        $total = $teams->toArray();
        $result = implode("", $total);

        $response['slide'] = $slide;
        $response['progress_team'] = $result;

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Success',
            'data'      => $response
        ], 200);
    }
}
