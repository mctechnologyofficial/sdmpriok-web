<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $attributes = [];
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
        $this->attributes = $request->validate([
            'name' => ['required', 'string'],
            'guard_name' => ['required', 'in:web,api']
        ]);
        $data = Role::create([
            'name' => $this->attributes['name'],
            'guard_name' => $this->attributes['guard_name']
        ]);

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Data Has Been Added',
            'data' => $data
        ], 200);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = Role::findById($id);

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Success',
            'data' => $data
        ], 200);
    }

    /**
     * @param Request $request
     * @param Role $id
     * @return JsonResponse
     */
    public function Update(Request $request, $id): JsonResponse
    {
        $this->attributes = $request->validate([
            'name' => ['nullable', 'string'],
            'guard_name' => ['nullable', 'in:web,api']
        ]);
        $data = Role::create([
            'name' => $this->attributes['name'],
            'guard_name' => $this->attributes['guard_name']
        ]);

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Data Has Been Updated',
            'data' => $data
        ], 200);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $data = Role::findById($id);
        $data->delete();

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Delete Success',
            // 'data' => $data
        ], 200);
    }
}
