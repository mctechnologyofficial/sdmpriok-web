<?php

namespace App\Http\Controllers\Api\Utilities;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Slide::query()->orderBy('id', 'ASC')->get();

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
            'type'  => ['required', Rule::in(Slide::getTypeSliders())],
            'row'   => ['required', Rule::in(Slide::getTypeRows())],
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
        ]);

        if ($inputs['type'] == Slide::TYPE_SLIDER_PICTURES && $inputs['row'] == Slide::TYPE_FIRST_ROW) {
            // $image_path = $request->file('image')->store('public/images/slider/row1');
            $file = $request->file('image');
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
            $image_path = $file->move('storage/images/slider/row1', $filename);
        } elseif ($inputs['type'] == Slide::TYPE_SLIDER_PICTURES && $inputs['row'] == Slide::TYPE_SECOND_ROW) {
            // $image_path = $request->file('image')->store('public/images/slider/row2');
            $file = $request->file('image');
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
            $image_path = $file->move('storage/images/slider/row2', $filename);
        } elseif ($inputs['type'] == Slide::TYPE_SLIDER_PICTURES && $inputs['row'] == Slide::TYPE_THIRD_ROW) {
            // $image_path = $request->file('image')->store('public/images/slider/row3');
            $file = $request->file('image');
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
            $image_path = $file->move('storage/images/slider/row3', $filename);
        } elseif ($inputs['type'] == Slide::TYPE_PICTURES) {
            // $image_path = $request->file('image')->store('public/images/picture');
            $file = $request->file('image');
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
            $image_path = $file->move('storage/images/picture', $filename);
        }

        $data = Slide::create([
            'type'  => $inputs['type'],
            'row'   => $inputs['row'],
            'image' => $image_path
        ]);

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Slider has been created',
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
        $data = Slide::find($id);

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
        $attrs = $request->validate([
            'type'  => ['nullable', 'string'],
            'row'   => ['nullable', 'string']
        ]);

        $slider = Slide::find($id);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if (Storage::exists($request->image)) {
                Storage::delete($slider->image);
                if ($attrs['type'] == Slide::TYPE_SLIDER_PICTURES && $attrs['row'] == Slide::TYPE_FIRST_ROW) {
                    // $path = $request->file('image')->store('public/images/slider/row1');
                    $file = $request->file('image');
                    $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                    $image_path = $file->move('storage/images/slider/row1', $filename);
                } elseif ($attrs['type'] == Slide::TYPE_SLIDER_PICTURES && $attrs['row'] == Slide::TYPE_SECOND_ROW) {
                    // $path = $request->file('image')->store('public/images/slider/row2');
                    $file = $request->file('image');
                    $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                    $image_path = $file->move('storage/images/slider/row2', $filename);
                } elseif ($attrs['type'] == Slide::TYPE_SLIDER_PICTURES && $attrs['row'] == Slide::TYPE_THIRD_ROW) {
                    $file = $request->file('image');
                    $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                    $image_path = $file->move('storage/images/slider/row2', $filename);
                } elseif ($attrs['type'] == Slide::TYPE_PICTURES) {
                    $file = $request->file('image');
                    $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                    $image_path = $file->move('storage/images/picture', $filename);
                }
            } else {
                if ($attrs['type'] == Slide::TYPE_SLIDER_PICTURES && $attrs['row'] == Slide::TYPE_FIRST_ROW) {
                    // $path = $request->file('image')->store('public/images/slider/row1');
                    $file = $request->file('image');
                    $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                    $image_path = $file->move('storage/images/slider/row1', $filename);
                } elseif ($attrs['type'] == Slide::TYPE_SLIDER_PICTURES && $attrs['row'] == Slide::TYPE_SECOND_ROW) {
                    // $path = $request->file('image')->store('public/images/slider/row2');
                    $file = $request->file('image');
                    $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                    $image_path = $file->move('storage/images/slider/row2', $filename);
                } elseif ($attrs['type'] == Slide::TYPE_SLIDER_PICTURES && $attrs['row'] == Slide::TYPE_THIRD_ROW) {
                    $file = $request->file('image');
                    $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                    $image_path = $file->move('storage/images/slider/row2', $filename);
                } elseif ($attrs['type'] == Slide::TYPE_PICTURES) {
                    $file = $request->file('image');
                    $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                    $image_path = $file->move('storage/images/picture', $filename);
                }
            }

            $slider->image = $image_path;
        }

        $slider->type = $request->type ?? $slider->type;
        $slider->row = $request->row ?? $slider->row;
        $slider->save();

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Update Data Has Successfully',
            'data' => $slider
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
        $data = Slide::find($id);
        $data->delete();

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Delete Success',
        ], 200);
    }
}
