<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @return Role Model
     */
    public function index(): JsonResponse
    {
        $data = Role::all();

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
        // todo
        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Success',
            // 'data' => $data
        ], 200);
    }

    /**
     * @param Role $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        // todo
        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Success',
            // 'data' => $data
        ], 200);
    }

    /**
     * @param Request $request
     * @param Role $id
     * @return JsonResponse
     */
    public function Update(Request $request, $id): JsonResponse
    {
        // todo
        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Success',
            // 'data' => $data
        ], 200);
    }

    /**
     * @param Role $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        // todo
        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Success',
            // 'data' => $data
        ], 200);
    }
}
