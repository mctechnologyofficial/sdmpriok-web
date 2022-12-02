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

        if($request->hasFile('image')){
            $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ]);
            if(Storage::exists($user->image)){
                Storage::delete($user->image);
                // $image_path = $request->file('image')->store('public/images/users');
                $file = $request->file('image');
                $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                $image_path = $file->move('storage/images/users', $filename);
            }else{
                // $image_path = $request->file('image')->store('public/images/users');
                $file = $request->file('image');
                $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                $image_path = $file->move('storage/images/users', $filename);
            }
        }else{
            $image_path = $user->image;
        }
        $user->image = $image_path;

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
