@extends('layouts.master')
@section('title', 'Slider')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Edit Slider</h6>
                        {{-- <p class="text-muted card-sub-title">A form control layout using basic layout.</p> --}}
                    </div>
                    <div class="">
                        <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="mg-b-0">Type</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    {{-- <input class="form-control" placeholder="Enter full name" type="text"> --}}
                                    <select name="type" class="form-control">
                                        <option value="" selected disabled>Choose type</option>
                                        <option value="Picture" @if($slider->type == 'Picture') selected @endif>Picture</option>
                                        <option value="Slider Picture" @if($slider->type == 'Slider Picture') selected @endif>Slider Picture</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="mg-b-0">Row</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    {{-- <input class="form-control" placeholder="Enter full name" type="text"> --}}
                                    <select name="row" class="form-control">
                                        <option value="" selected disabled>Choose row</option>
                                        <option value="Row 1" @if($slider->row == 'Row 1') selected @endif>Row 1</option>
                                        <option value="Row 2" @if($slider->row == 'Row 2') selected @endif>Row 2</option>
                                        <option value="Row 3" @if($slider->row == 'Row 3') selected @endif>Row 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center">
                                <div class="col-md-4">
                                    <label class="mg-b-0">Picture</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <div class="input-group file-browser">
                                        <input type="text" class="form-control border-right-0 browse-file" placeholder="choose" readonly id="textFileSlider">
                                        <label class="input-group-btn">
                                            <span class="btn btn-primary">
                                                Browse <input type="file" style="display: none;" name="image" id="fileSlider">
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="mg-b-0"></label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <img src="{{ Storage::url($slider->image) }}" alt="..." class="img-thumbnail w-50" id="image">
                                </div>
                            </div>
                            <div class="form-group row justify-content-end mb-0">
                                <div class="col-md-8 pl-md-2">
                                    <button class="btn ripple btn-primary pd-x-30 mg-r-5">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
