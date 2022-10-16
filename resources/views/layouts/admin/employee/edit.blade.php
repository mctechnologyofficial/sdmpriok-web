@extends('layouts.master')
@section('title', 'Employee')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Edit Employee</h6>
                    </div>
                    <div class="">
                        <form action="{{ route('employee.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
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
                                    <label class="mg-b-0">Position</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select name="role_id" class="form-control">
                                        <option value="" @if($user->roles->first() == null) selected disabled @endif>Choose position</option>
                                        @foreach ($role as $roles)
                                            {{-- <option value="{{ $roles->id }}" @if($user->role_id == $roles->id) selected @endif>{{ $user->roles->first()->name }}</option> --}}
                                            <option value="{{ $roles->id }}" @if($user->roles->first()->id == $roles->id) selected @endif>{{ $roles->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="mg-b-0">Team</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select name="team_id" class="form-control">
                                        <option value="" @if($user->id == '') selected disabled @endif>Choose team</option>
                                        @foreach ($team as $teams)
                                            <option value="{{ $teams->id }}" @if($user->team_id == $teams->id) selected @endif>{{ $teams->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center">
                                <div class="col-md-4">
                                    <label class="mg-b-0">Picture</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <div class="input-group file-browser">
                                        <input type="text" class="form-control border-right-0 browse-file" placeholder="choose" id="textFileSlider" readonly>
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
                                <div class="col-md-8">
                                    <img src="{{ Storage::url($user->image) }}" alt="..." class="img-thumbnail w-50" id="image">
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
