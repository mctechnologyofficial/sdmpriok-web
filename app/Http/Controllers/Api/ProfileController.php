<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    /**
     * @param Request $request
     * @return Json
     */
    public function update(Request $request)
    {
        $request->validate(
            [
                'name' => 'nullable',
                'email' => 'email|unique:users,email',
                'password' => 'nullable',
                'phone' => 'numeric|unique:users,phone'
            ]
        );
        $user = $request->user('sanctum');

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ]);
            if (Storage::exists($user->image) || !Storage::exists($user->image)) {
                Storage::delete($user->image);
                $path = $request->file('image')->store('public/images/users');
            } else {
                $path = $request->file('image')->store('public/images/users');
            }
        } else {
            $path = $user->image;
        }
        $user->image = $path;

        if ($request->password == null) {
            $user->password = $user->password;
        } else {
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Update Successfully',
        ], 200);
    }
}
