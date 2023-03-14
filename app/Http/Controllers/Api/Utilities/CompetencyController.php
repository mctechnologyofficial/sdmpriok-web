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
        $inputs = $request->validate([
            'name'          => ['required', 'string'],
            'role'          => ['required', Rule::in(Competency::getTypeRoles())],
            'category'      => ['required', 'string'],
            'sub_category'  => ['required', 'string']
        ]);

        if(!$request->hasFile('image')){
            return response()->json([
                'code'      => 401,
                'status'    => false,
                'message'   => "Save data failed. Make sure you've filled all fields!"
            ], 401);
        }
        $file = $request->image;
        $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
        $image_path = $file->move('storage/competency/'.$request->name.'/'.$request->sub_category, $filename);

        $data = Competency::create([
            'name'          => $inputs['name'],
            'role'          => $inputs['role'],
            'category'      => $inputs['category'],
            'sub_category'  => $inputs['sub_category'],
            'image'         => $image_path
        ]);


        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Create Competency Has Successfully',
            'data'      => $data
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
        $request->validate([
            'name'          => ['nullable', 'string'],
            'role'          => ['nullable', Rule::in(Competency::getTypeRoles())],
            'category'      => ['required', 'string'],
            'sub_category'  => ['required', 'string']
        ]);

        $data = Competency::find($id);
        if($request->file('image')){
            $file = $request->image;
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
            $image_path = $file->move('storage/competency/'.$request->name.'/'.$request->sub_category, $filename);
        }else{
            $image_path = $data->image;
        }

        $data->name = $request->name ?? $data->name;
        $data->role = $request->role ?? $data->role;
        $data->category = $request->category ?? $data->category;
        $data->sub_category = $request->sub_category ?? $data->sub_category;
        $data->image = $image_path;
        $data->save();


        return response()->json([
            'code'      => 200,
            'status'    => true,
            'message'   => 'Update Competency Has Successfully',
            'data'      => $data
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
        $data->progress()->delete();
        $data->delete();

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Delete Success',
        ], 200);
    }
}
