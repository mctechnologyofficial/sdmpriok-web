@extends('layouts.master')
@section('title', 'Role')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card mg-b-20">
                <div class="card custom-card">
                    <div class="card-body">
                        <div>
                            <h6 class="main-content-label mb-1">Add Role</h6>
                        </div>
                        <div class="">
                            <form action="{{ route('role.store') }}" method="POST">
                                @csrf
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="mg-b-0">Name</label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <input class="form-control" placeholder="Enter role name" type="text" name="name">
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