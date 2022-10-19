@extends('layouts.master')
@section('title', 'Slider')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Add Slider</h6>
                    </div>
                    <div class="">
                        <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="mg-b-0">Type</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select name="type" class="form-control">
                                        <option value="" selected disabled>Choose type</option>
                                        <option value="Picture">Picture</option>
                                        <option value="Slider Picture">Slider Picture</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="mg-b-0">Row</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select name="row" class="form-control">
                                        <option value="row" selected disabled>Choose row</option>
                                        <option value="Row 1">Row 1</option>
                                        <option value="Row 2">Row 2</option>
                                        <option value="Row 3">Row 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
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
                                    <img src="" alt="" class="img-thumbnail w-50" id="image">
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
@section('js')
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#image').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $("#fileSlider").on('change', function(){
                readURL(this);
            });
        });
    </script>
@endsection
