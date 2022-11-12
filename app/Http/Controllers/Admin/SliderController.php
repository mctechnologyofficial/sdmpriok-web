<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slide::select('*')->orderBy('id', 'ASC')->get();
        return view('layouts.admin.utilities.slider.list', compact(['slider']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.admin.utilities.slider.add');
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
            'type'  => 'required|string',
            'row'   => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        if($attrs['type'] == 'Slider Picture' && $attrs['row'] == 'Row 1')
        {
            // $image_path = $request->file('image')->store('images/slider/row1');
            $file = $request->file('image');
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
            $image_path = $file->move('storage/images/slider/row1', $filename);
        }
        elseif($attrs['type'] == 'Slider Picture' && $attrs['row'] == 'Row 2'){
            // $image_path = $request->file('image')->store('images/slider/row2');
            $file = $request->file('image');
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
            $image_path = $file->move('storage/images/slider/row2', $filename);
        }
        elseif($attrs['type'] == 'Slider Picture' && $attrs['row'] == 'Row 3'){
            // $image_path = $request->file('image')->store('images/slider/row3');
            $file = $request->file('image');
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
            $image_path = $file->move('storage/images/slider/row3', $filename);
        }
        elseif($attrs['type'] == 'Picture'){
            // $image_path = $request->file('image')->store('images/picture');
            $file = $request->file('image');
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
            $image_path = $file->move('storage/images/picture', $filename);
        }

        Slide::create([
            'type'  => $attrs['type'],
            'row'   => $attrs['row'],
            'image' => $image_path
        ]);

        return redirect()->route('slider.index')->with('success','Slider has been created successfully.');
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
        $slider = Slide::find($id);
        return view('layouts.admin.utilities.slider.edit', compact(['slider']));
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
            'type'  => 'required|string',
            'row'   => 'required|string',
        ]);

        $slider = Slide::find($id);

        if($request->hasFile('image')){
            $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if(Storage::exists($request->image)){
                Storage::delete($slider->image);
                if($attrs['type'] == "Slider Picture" && $attrs['row'] == 'Row 1')
                {
                    // $path = $request->file('image')->store('images/slider/row1');
                    $file = $request->file('image');
                    $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                    $image_path = $file->move('storage/images/slider/row1', $filename);
                }
                elseif($attrs['type'] == "Slider Picture" && $attrs['row'] == 'Row 2')
                {
                    // $path = $request->file('image')->store('images/slider/row2');
                    $file = $request->file('image');
                    $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                    $image_path = $file->move('storage/images/slider/row2', $filename);
                }
                elseif($attrs['type'] == "Slider Picture" && $attrs['row'] == 'Row 3')
                {
                    // $path = $request->file('image')->store('images/slider/row3');
                    $file = $request->file('image');
                    $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                    $image_path = $file->move('storage/images/slider/row3', $filename);
                }
                elseif($attrs['type'] == "Picture")
                {
                    // $path = $request->file('image')->store('images/picture');
                    $file = $request->file('image');
                    $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                    $image_path = $file->move('storage/images/picture', $filename);
                }
            }else{
                if($attrs['type'] == "Slider Picture" && $attrs['row'] == 'Row 1')
                {
                    // $path = $request->file('image')->store('images/slider/row1');
                    $file = $request->file('image');
                    $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                    $image_path = $file->move('storage/images/slider/row1', $filename);
                }
                elseif($attrs['type'] == "Slider Picture" && $attrs['row'] == 'Row 2')
                {
                    // $path = $request->file('image')->store('images/slider/row2');
                    $file = $request->file('image');
                    $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                    $image_path = $file->move('storage/images/slider/row2', $filename);
                }
                elseif($attrs['type'] == "Slider Picture" && $attrs['row'] == 'Row 3')
                {
                    // $path = $request->file('image')->store('images/slider/row3');
                    $file = $request->file('image');
                    $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                    $image_path = $file->move('storage/images/slider/row3', $filename);
                }
                elseif($attrs['type'] == "Picture"){
                    // $path = $request->file('image')->store('images/picture');
                    $file = $request->file('image');
                    $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
                    $image_path = $file->move('storage/images/picture', $filename);
                }
            }

            $slider->image = $image_path;
        }

        $slider->type = $request->type;
        $slider->row = $request->row;
        $slider->save();

        return redirect()->route('slider.index')->with('success','Slider updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slide::find($id);
        Storage::delete($slider->image);
        $slider->delete();

        return redirect()->route('slider.index')->with('success','Slider has been deleted successfully');
    }
}
