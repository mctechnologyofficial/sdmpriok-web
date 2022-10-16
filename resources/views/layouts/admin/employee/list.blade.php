@extends('layouts.master')
@section('title', 'Employee')

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
                <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                    <div>
                        <label class="main-content-label mb-2">List Employee</label>
                    </div>
                    <div class="ml-auto">
                        <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('employee.create') }}">Add Employee</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="example1">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Position</th>
                                <th>Team</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->phone }}</td>
                                    <td>{{ $data->roles->first()->name }}</td>
                                    <td>{{ $data->teams->name }}</td>
                                    <td class="text-center">
                                        <img src="{{ Storage::url($data->image) }}" alt="..." class="img-fluid w-75">
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-primary btn-block mb-2" href="{{ route('employee.edit', $data->id) }}">Edit</a>
                                        <form action="{{ route('employee.destroy', $data->id) }}" method="post">
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
