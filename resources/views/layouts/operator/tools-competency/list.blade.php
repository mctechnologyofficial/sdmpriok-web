@extends('layouts.master')
@section('title', 'Competency Tools')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
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
                                        <a class="dropdown-item tools-competency" href="javascript:void(0)">{{ $data->name }}</a>
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
                                    {{-- <th class="">Category</th> --}}
                                    {{-- <th class="">Sub Category</th> --}}
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
                </div>
            </div>
        </div>
    </div>
@endsection
