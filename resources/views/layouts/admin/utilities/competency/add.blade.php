@extends('layouts.master')
@section('title', 'Competency')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Add Competency</h6>
                        {{-- <p class="text-muted card-sub-title">A form control layout using basic layout.</p> --}}
                    </div>
                    <div class="">
                        <form action="{{ route('competency.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="mg-b-0">Role</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select name="role" class="form-control cmbRole">
                                        <option value="" selected disabled>Choose competency role</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Operator">Operator</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20 competency-name">
                                <div class="col-md-4">
                                    <label class="mg-b-0">Competency Name</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" placeholder="Enter competency name" type="text" name="name">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20 category-name">
                                <div class="col-md-4">
                                    <label class="mg-b-0">Category Name</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" placeholder="Enter category name" type="text" name="category">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20 sub-category-name">
                                <div class="col-md-4">
                                    <label class="mg-b-0">Sub Category Name</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" placeholder="Enter sub category name" type="text" name="sub_category">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="mg-b-0">Image</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <div class="input-group file-browser">
                                        <input type="text" class="form-control border-right-0 browse-file" placeholder="choose" readonly id="textFileSlider">
                                        <label class="input-group-btn">
                                            <span class="btn btn-primary">
                                                Browse <input type="file" style="display: none;" name="image" id="fileSlider" accept="image/png, image/gif, image/jpeg" />
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
