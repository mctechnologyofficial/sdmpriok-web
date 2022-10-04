@extends('layouts.master')
@section('title', 'Coaching Mentoring')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                        <div>
                            <label class="main-content-label mb-2">List Employee</label>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="mentoringtable">
                            <thead>
                                <tr>
                                    <th class="wd-20p">NIP</th>
                                    <th class="wd-20p">Name</th>
                                    <th class="wd-20p">Position</th>
                                    <th class="wd-20p">Progress</th>
                                    <th class="wd-20p">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>3276062905020004</td>
                                    <td>Fawwaz Hudzalfah Saputra</td>
                                    <td>Senior Operator Control Room</td>
                                    <td>
                                        <div class="progress mg-b-10">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar-lg" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="/spv/detail-mentoring">
                                            <p class="text-success">Complete</p>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3276061812810003</td>
                                    <td>Agus Wijayanto</td>
                                    <td>Operator GT RSG</td>
                                    <td>
                                        <div class="progress mg-b-10">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar-lg" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="/spv/detail-mentoring">
                                            <p class="text-warning">In Progress</p>
                                        </a>
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
