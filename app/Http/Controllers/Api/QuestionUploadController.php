<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\QuestionOperatorsImport;
use App\Imports\QuestionSupervisorImport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuestionUploadController extends Controller
{
    public function uploadQuestion(Request $request): JsonResponse
    {
        if ($request->role == "Operator"){
            $data = Excel::import(new QuestionOperatorsImport(), request()->file('file'));

            return response()->json([
                'code'      => 200,
                'status'    => true,
                'message'   => 'Questions operator has been uploaded successfully.',
                'data'      => $data
            ], 200);
        }else if($request->role == "Supervisor"){
            $data = Excel::import(new QuestionSupervisorImport(), request()->file('file'));

            return response()->json([
                'code'      => 200,
                'status'    => true,
                'message'   => 'Questions supervisor has been uploaded successfully.',
                'data'      => $data
            ], 200);
        }
    }
}
