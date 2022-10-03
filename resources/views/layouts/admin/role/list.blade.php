@extends('layouts.master')
@section('title', 'Role')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card mg-b-20">
                <div class="card-body">
                    <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                        <div>
                            <label class="main-content-label mb-2">List Role</label>
                        </div>
                        <div class="ml-auto">
                            <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/admin/add-role">Add Role</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-15p">Name</th>
                                    <th class="wd-5p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Supervisor Senior</td>
                                    <td>
                                        <a class="btn btn-outline-primary btn-block" href="/admin/edit-role">Edit</a>
                                        <a class="modal-effect btn btn-outline-danger btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">Delete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Supervisor</td>
                                    <td>
                                        <a class="btn btn-outline-primary btn-block" href="/admin/edit-role">Edit</a>
                                        <a class="modal-effect btn btn-outline-danger btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">Delete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Supervisor Operator</td>
                                    <td>
                                        <a class="btn btn-outline-primary btn-block" href="/admin/edit-role">Edit</a>
                                        <a class="modal-effect btn btn-outline-danger btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">Delete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Operator Senior Control Room</td>
                                    <td>
                                        <a class="btn btn-outline-primary btn-block" href="/admin/edit-role">Edit</a>
                                        <a class="modal-effect btn btn-outline-danger btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
    
                        <!-- Modal effects -->
                        <div class="modal" id="modaldemo8">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Delete Role Data</h6>
                                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body tx-center pd-y-20 pd-x-20">
                                        {{-- <i class="icon ion-ios-checkmark-circle-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i> --}}
                                        <i class="fas fa-exclamation-triangle tx-100 tx-warning lh-1 mg-t-20 d-inline-block"></i>
                                        <h4 class="tx-warning tx-semibold mg-b-20">Warning</h4>
                                        <p class="mg-b-20 mg-x-20">Are you sure want to delete this role data?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn ripple btn-primary" type="button">Delete</button>
                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal effects-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection