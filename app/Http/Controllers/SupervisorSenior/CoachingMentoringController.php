<?php

namespace App\Http\Controllers\SupervisorSenior;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoachingMentoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $user = User::selectRaw('users.id as userid, users.nip, users.name, SUM(progress.progress) as data, roles.name as role')
                            ->join('model_has_roles', function ($join) {
                                $join->on('users.id', '=', 'model_has_roles.model_id')
                                     ->where('model_has_roles.model_type', User::class);
                            })
                            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                            ->join('progress', 'progress.user_id', '=', 'users.id')
                            ->where('users.team_id', Auth::user()->team_id)
                            ->where('roles.name', '=', 'Supervisor')
                            ->groupBy('users.name')
                            ->get();
        return view('layouts.supervisor-senior.coaching-mentoring.list', compact(['user']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
