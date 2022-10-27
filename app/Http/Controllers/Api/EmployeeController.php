<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $user = User::with('roles', 'teams')->orderBy('users.id', 'ASC')->get();

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Success',
            'data' => $user
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $attrs = $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email',
            'phone'     => 'required|string',
            'password'  => 'required|string',
            'role_id'   => 'required|exists:roles,id', //validation with existing roles tables
            'team_id'   => 'required|exists:teams,id', //validation with existing teams tables
            'image'     => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $image_path = $request->file('image')->store('public/images/users');

        $user = User::create([
            'name'      => $attrs['name'],
            'email'     => $attrs['email'],
            'phone'     => $attrs['phone'],
            'password'  => Hash::make($attrs['password']),
            'team_id'   => $attrs['team_id'],
            'image'     => $image_path
        ]);

        // assign role
        $role = Role::find($attrs['role_id']);
        $user->assignRole($role);

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Create Employee Successfully',
            'data' => $user
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request, User $userHash): JsonResponse
    {
        $request->validate([
            'name'      => 'string',
            'email'     => 'email',
            'phone'     => 'string',
            'role_id'   => 'exists:roles,id',
            'team_id'   => 'exists:teams,id',
        ]);

        $user = $userHash;

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ]);

            if (Storage::exists($request->image)) {
                Storage::delete($user->image);
                $path = $request->file('image')->store('public/images/users');
            } else {
                $path = $request->file('image')->store('public/images/users');
            }
            $user->image = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->team_id = $request->team_id;
        $user->save();

        // update roles
        $role = Role::find($request->role_id);
        $user->syncRoles($role);

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Update Employee Successfully',
            'data' => $user
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(User $userHash): JsonResponse
    {
        $user = $userHash;
        Storage::delete($user->image);
        $user->delete();

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Delete Employee Successfully',
        ], 200);
    }
}
