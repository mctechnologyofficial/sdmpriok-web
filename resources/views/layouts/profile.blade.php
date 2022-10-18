@extends('layouts.master')
@section('title', 'Edit Profile')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                                <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-lg-12 d-flex justify-content-center">
                                        <div class="circle">
                                            <img class="profile-pic avatar-profile img-thumbnail mb-3 mt-2" src="{{ Storage::url($user->image) }}" width="150" height="150">
                                            <input class="file-upload" type="file" accept="image/*" style="display: none;" name="image" />
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="mg-b-0">Name</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input class="form-control" placeholder="Enter name" type="text" name="name" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="mg-b-0">Phone Number</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input class="form-control" placeholder="Enter phone number" type="text" name="phone" value="{{ $user->phone }}">
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="mg-b-0">Email</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input class="form-control" placeholder="Enter email" type="email" name="email" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="mg-b-0">Password</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input class="form-control" placeholder="Enter password" type="text" name="password" value=''>
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
        $(document).ready(function() {
            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function(){
                readURL(this);
            });

            $(".profile-pic").on('click', function() {
                $(".file-upload").click();
            });

            $(".profile-pic").on('mouseover', function() {
                $(this).css('cursor', 'pointer');
            });
        });
    </script>
@endsection
