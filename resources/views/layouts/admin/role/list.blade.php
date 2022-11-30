@extends('layouts.master')
@section('title', 'Role')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card mg-b-20">
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                        <div>
                            <label class="main-content-label mb-2">List Role</label>
                        </div>
                        <div class="ml-auto">
                            <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('role.create') }}">Add Role</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="example1">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="wd-15p">Name</th>
                                    <th class="wd-5p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($role as $data)
                                    <tr>
                                        <td>{{ ucfirst($data->name) }}</td>
                                        <td>
                                            <a class="btn btn-outline-primary btn-block mb-2" href="{{ route('role.edit', $data->id) }}">Edit</a>
                                            <form action="{{ route('role.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-outline-danger btn-block">Delete</button>
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
