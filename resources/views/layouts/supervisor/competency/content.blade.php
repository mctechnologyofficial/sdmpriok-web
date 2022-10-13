@extends('layouts.master')
@section('title', 'Competency Tools')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20">
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @error('file')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror

                <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                    <div class="mr-auto mb-2 d-flex">
                        <select name="category" id="category" class="form-control">
                            <option value="" selected disabled>Choose category</option>
                        </select>
                        <select name="subcategory" id="subcategory" class="form-control ml-2">
                            <option value="" selected disabled>Choose sub category</option>
                        </select>
                    </div>
                    <div class="ml-auto">
                        <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                        <div class="dropdown-menu">
                            @foreach ($competency as $data)
                                @if ($data->role == "Supervisor")
                                    <a class="dropdown-item tools-competency-spv" href="javascript:void(0)">{{ $data->name }}</a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="tblSupervisorQuestion">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th class="">Competency</th>
                                {{-- <th class="">Lesson</th> --}}
                                <th class="">Reference</th>
                                <th class="">Lesson Plan</th>
                                <th class="">Processing Time</th>
                                <th class="">Realization</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <div class="modal" tabindex="-1" role="dialog" id="answerSupervisorModal">
                        <form action="{{ route('competency-tools-spv.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
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
                                                <input type="text" name="competency" class="form-control" id="competency">
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="mg-b-0">Category</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input type="text" name="category" class="form-control" id="textCategory">
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="mg-b-0">Sub Category</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input type="text" name="subcategory" class="form-control" id="textSubCategory">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
