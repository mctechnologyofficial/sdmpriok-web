@extends('layouts.master')
@section('title', 'Competency')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20">
            <div class="card-body">
                <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                    <div>
                        <label class="main-content-label mb-2">List Competency</label>
                    </div>
                    <div class="ml-auto">
                        <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('competency.create') }}">Add Competency</a>
                            {{-- <a class="dropdown-item" href="/admin/edit-competency">Edit Competency</a> --}}
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-20p">Competency</th>
                                {{-- <th class="wd-20p">Competency</th> --}}
                                <th class="wd-5p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($competency as $data)
                            <tr>
                                <td>{{ $data->name }}</td>
                                <td>
                                    <a class="btn btn-outline-primary btn-block mb-2"href="{{ route('competency.edit', $data->id) }}">Edit</a>
                                    <form action="{{ route('competency.destroy', $data->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger btn-block" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
