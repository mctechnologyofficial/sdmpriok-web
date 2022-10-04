@extends('layouts.master')
@section('title', 'Employee')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20">
            <div class="card-body">
                <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                    {{-- <div>
                        <label class="main-content-label mb-2">List Employee</label>
                    </div> --}}
                    <div class="ml-auto">
                        <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Sistem Proteksi Turbin</a>
                            <a class="dropdown-item" href="#">Sistem Proteksi HRSG</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover tableCompetency" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-20p">Acuan Kinerja</th>
                                <th class="wd-20p">Rancangan Sesi Pembelajaran</th>
                                <th class="wd-20p">Waktu Penugasan</th>
                                <th class="wd-5p">Realisasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Modal effects -->
                    <div class="modal fade" id="modaldemo8" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <!-- <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5> -->
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Answer</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            <button class="btn btn-danger form-control mt-2">
                                                Record <i class="fas fa-microphone"></i>
                                            </button>
                                        </div>

                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-success">Upload Files</button>
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
