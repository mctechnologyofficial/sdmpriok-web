@extends('layouts.master')
@section('title', 'Employee')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Add Employee</h6>
                        {{-- <p class="text-muted card-sub-title">A form control layout using basic layout.</p> --}}
                    </div>
                    <div class="">
                        <form action="" method="POST">
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="mg-b-0">Full Name</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" placeholder="Enter full name" type="text">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="mg-b-0">Phone</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" placeholder="Enter phone" type="text">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="mg-b-0">Email</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" placeholder="Enter email" type="email">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="mg-b-0">Position</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    {{-- <input class="form-control" placeholder="Enter email" type="email"> --}}
                                    <select name="" class="form-control">
                                        <option value="" selected disabled>Choose position</option>
                                        <option value="Supervisor Senior">Supervisor Senior</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Supervisor Operator">Supervisor Operator</option>
                                        <option value="Operator Senior">Operator Senior</option>
                                        <option value="Ahli Muda Operator">Ahli Muda Operator</option>
                                        <option value="Operator Senior Control Room">Operator Senior Control Room</option>
                                        <option value="Operator GT RSG">Operator GT RSG</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="mg-b-0">Team</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    {{-- <input class="form-control" placeholder="Enter email" type="email"> --}}
                                    <select name="" class="form-control">
                                        <option value="" selected disabled>Choose team</option>
                                        <option value="Team A">Team A</option>
                                        <option value="Team B">Team B</option>
                                        <option value="Team C">Team C</option>
                                        <option value="Team D">Team D</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="mg-b-0">Password</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" placeholder="Enter password" type="password">
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