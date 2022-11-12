<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get user with direct relationsship roles and teams
        $user = User::with('roles', 'teams')->orderBy('users.id', 'ASC')->get();
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
            'nip'      => 'required|string',
            'name'      => 'required|string',
            'email'     => 'required|email',
            'phone'     => 'required',
            'password'  => 'required|string',
            'role_id'   => 'required|exists:roles,id', //validation with existing roles tables
            'team_id'   => 'required|exists:teams,id', //validation with existing teams tables
            'image'     => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        // $image_path = $request->file('image')->store('images/users');
        $file = $request->file('image');
        $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
        $image_path = $file->move('storage/images/users', $filename);

        $validation_existing_phone = User::where('phone', $attrs['phone'])->count();
        $validation_existing_email = User::where('email', $attrs['email'])->count();
        $validation_existing_nip = User::where('nip', $attrs['nip'])->count();

        if($validation_existing_phone > 0 || $validation_existing_email > 0 || $validation_existing_nip){
            return redirect()->route('employee.index')->with('error', 'Duplicate data!');
        }

        $user = User::create([
            'nip'      => $attrs['nip'],
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

        return redirect()->route('employee.index')->with('success', 'User has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $userHash)
    {

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
            'nip'      => 'required|string',
            'name'      => 'required|string',
            'email'     => 'required|email',
            'phone'     => 'required|string',
            'role_id'   => 'required|exists:roles,id',
            'team_id'   => 'required|exists:teams,id',
        ]);

        $user = User::find($id);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ]);

            if (Storage::exists($request->image)) {
                Storage::delete($user->image);
                // $path = $request->file('image')->store('images/users');
                $file = $request->file('image');
                $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                $image_path = $file->move('storage/images/users', $filename);
            } else {
                // $path = $request->file('image')->store('images/users');
                $file = $request->file('image');
                $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                $image_path = $file->move('storage/images/users', $filename);
            }
            $user->image = $image_path;
        }

        $user->nip = $request->nip;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->team_id = $request->team_id;
        $user->save();

        // update roles
        $role = Role::find($request->role_id);
        $user->syncRoles($role);

        return redirect()->route('employee.index')->with('success', 'User updated successfully');
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
        if ($user->image == null) {
            $user->delete();
        } else {
            Storage::delete($user->image);
            $user->delete();
        }

        return redirect()->route('employee.index')->with('success', 'User has been deleted successfully');
    }
}
