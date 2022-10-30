<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /** 
     * @return Team Model
     */
    public function index(): JsonResponse
    {
        $data = Team::all();

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Success',
            'data' => $data
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = Team::create(
            [
                'name' => $request->name
            ]
        );

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Create Team Success',
            'data' => $data
        ], 200);
    }

    /**
     * @param Team $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = Team::find($id);

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Success',
            'data' => $data
        ], 200);
    }

    /**
     * @param Request $request
     * @param Team $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $data = Team::find($id);
        $data->update(['name' => $request->name]);

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Update Team Success',
            'data' => $data
        ], 200);
    }

    /**
     * @param Team $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $data = Team::find($id);
        $data->delete();

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Delete Team Success',
        ], 200);
    }
}
