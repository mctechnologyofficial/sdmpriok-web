@extends('layouts.master')
@section('title', 'Competency Tools')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                        <div class="mr-auto mb-2">
                            <select name="lesson" id="lesson" class="form-control">
                                <option value="" selected disabled>Choose lesson</option>
                            </select>
                        </div>
                        <div class="ml-auto">
                            <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                            <div class="dropdown-menu">
                                @foreach ($competency as $data)
                                    @if ($data->role == "Operator")
                                        <a class="dropdown-item tools-competency-op" href="javascript:void(0)">{{ $data->name }}</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover" id="tblOperatorQuestion">
                            <thead class="thead-dark">
                                <tr>
                                    <th>id</th>
                                    <th class="">Competency</th>
                                    <th class="">Lesson</th>
                                    <th class="">Reference</th>
                                    <th class="">Lesson Plan</th>
                                    <th class="">Processing Time</th>
                                    <th class="">Realization</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <form action="{{ route('competency-tools-op.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="modal" tabindex="-1" role="dialog" id="answerOperatorModal">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="mg-b-0">Competency</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input type="hidden" name="questionid" id="questionid">
                                            <input type="text" name="competency" class="form-control" id="competency" readonly>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="mg-b-0">Lesson</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input type="text" name="lesson" class="form-control" id="lesson" readonly>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="mg-b-0">Answer</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <textarea name="essay" class="form-control mb-2" cols="30" rows="10"></textarea>

                                            <div class="input-group file-browser">
                                                <input type="text" class="form-control border-right-0 browse-file" placeholder="choose" readonly id="textFileSlider">
                                                <label class="input-group-btn">
                                                    <span class="btn btn-outline-info">
                                                        <i class="fas fa-file-upload"></i> Upload File <input type="file" style="display: none;" name="image" id="fileSlider" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel, application/pdf,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,image/*,.txt,.xlsx,.csv">
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-success"><i class="fas fa-save"></i> Save</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
