<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::join('roles', 'roles.id', '=', 'users.role_id')
                    ->join('teams', 'teams.id', '=', 'users.team_id')
                    ->get(['users.*', 'roles.name as role_name', 'teams.name as team_name']);
        return view('layouts.admin.employee.list', compact(['user']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();
        $team = Team::all();
        return view('layouts.admin.employee.add', compact(['role', 'team']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attrs = $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email',
            'phone'     => 'required|string',
            'password'  => 'required|string',
            'role_id'   => 'required|string',
            'team_id'   => 'required|string',
            'image'     => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $image_path = $request->file('image')->store('public/images/users');

        User::create([
            'name'      => $attrs['name'],
            'email'     => $attrs['email'],
            'phone'     => $attrs['phone'],
            'password'  => Hash::make($attrs['password']),
            'role_id'   => $attrs['role_id'],
            'team_id'   => $attrs['team_id'],
            'image'     => $image_path
        ]);

        return redirect()->route('employee.index')->with('success','User has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $role = Role::all();
        $team = Team::all();
        return view('layouts.admin.employee.edit', compact(['user', 'role', 'team']));
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
        $attrs = $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email',
            'phone'     => 'required|string',
            // 'password'  => 'required|string',
            'role_id'   => 'required|string',
            'team_id'   => 'required|string',
        ]);

        $user = User::find($id);

        if($request->hasFile('image')){
            $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ]);

            if(Storage::exists($request->image)){
                Storage::delete($user->image);
            }else{
                $path = $request->file('image')->store('public/images/users');
            }
            $user->image = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        // $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->team_id = $request->team_id;
        $user->save();

        return redirect()->route('employee.index')->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        Storage::delete($user->image);
        $user->delete();

        return redirect()->route('employee.index')->with('success','User has been deleted successfully');
    }
}
