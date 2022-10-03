@extends('layouts.master')
@section('title', 'Team')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card mg-b-20">
                <div class="card custom-card">
                    <div class="card-body">
                        <div>
                            <h6 class="main-content-label mb-1">Add Team</h6>
                        </div>
                        <div class="">
                            <form action="" method="POST">
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="mg-b-0">Name</label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <input class="form-control" placeholder="Enter team name" type="text">
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