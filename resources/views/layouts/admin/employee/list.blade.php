@extends('layouts.master')
@section('title', 'Employee')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20">
            <div class="card-body">
                <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                    <div>
                        <label class="main-content-label mb-2">List Employee</label>
                    </div>
                    <div class="ml-auto">
                        <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/admin/edit-employee">Edit Employee</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-20p">Name</th>
                                <th class="wd-20p">Position</th>
                                <th class="wd-20p">Team</th>
                                <th class="wd-5p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Fawwaz Hudzalfah Saputra</td>
                                <td>Supervisor Operator</td>
                                <td>Team A</td>
                                <td>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection