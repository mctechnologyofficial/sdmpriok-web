@extends('layouts.master')
@section('title', 'Competency Tools')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20">
            <div class="card-body">
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
