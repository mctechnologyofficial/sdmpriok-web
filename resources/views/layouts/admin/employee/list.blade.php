@extends('layouts.master')
@section('title', 'Employee')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20">
            <div class="card-body">
                <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                    <div>
                        <label class="main-content-label mb-2">Tasks</label> <span class="d-block tx-12 mb-3 text-muted">A task is accomplished by a set deadline, and must contribute toward work-related objectives.</span>
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
                                <th class="wd-25p">Position</th>
                                <th class="wd-20p">Office</th>
                                <th class="wd-15p">Age</th>
                                <th class="wd-20p">Salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>$320,800</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection