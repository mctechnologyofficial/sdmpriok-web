<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * @param Request $request
     * @return Json 
     */
    public function index(Request $request)
    {
        $user = $request->user('sanctum');
        
        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Success',
            'data' => $user
        ], 200);
    }

    // Todo others function 
}
