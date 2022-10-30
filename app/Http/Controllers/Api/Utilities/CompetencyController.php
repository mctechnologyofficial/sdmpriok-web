<?php

namespace App\Http\Controllers\Api\Utilities;

use App\Http\Controllers\Controller;
use App\Models\Competency;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompetencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Competency::query()->orderBy('id', 'ASC')->get();

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Success',
            'data' => $data
        ], 200);
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
        $inputs = $request->validate(
            [
                'name' => ['required', 'string'],
                'role' => ['required', Rule::in(Competency::getTypeRoles())]
            ]);

        $data = Competency::create([
            'name' => $inputs['name'],
            'role' => $inputs['role']
        ]);


        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Create Competency Has Successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Competency::find($id);

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Success',
            'data' => $data
        ], 200);
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
        $request->validate(
            [
                'name' => ['nullable', 'string'],
                'role' => ['nullable', Rule::in(Competency::getTypeRoles())]
            ]);

        $data = Competency::find($id);

        $data->name = $request->name ?? $data->name;
        $data->role = $request->role ?? $data->role;
        $data->save();


        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Update Competency Has Successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = Competency::find($id);
        $data->delete();

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Delete Success',
        ], 200);
    }
}
