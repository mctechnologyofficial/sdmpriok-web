<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('layouts.profile', compact(['user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

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

        if($request->password == null){
            $user->password = $user->password;
        }else{
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();

        return Redirect()->route('profile.index')->with(['success', 'Profile data has been updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
