@extends('layouts.master')
@section('title', 'Competency Score')
@section('content')
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="example1">
                        <thead class="thead-dark">
                            <tr>
                                <th>Competency Name</th>
                                <th>Competency Sub Category</th>
                                <th>Average Score</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($evaluation as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->sub_category }}</td>
                                    <td>
                                        {{ $data->avg_evaluation }}
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-primary btn-block mb-2" href="{{ route('competency-score.show', $data->id) }}">Detail</a>
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
