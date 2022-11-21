@extends('layouts.master')
@section('title', 'Competency Score')
@section('content')
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="example1">
                        <thead class="thead-dark">
                            <tr>
                                <th>Competency Name</th>
                                <th>Competency Sub Category</th>
                                <th>Average Score</th>
                                <th>Note</th>
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
                                    <td>{{ $data->note }}</td>
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
