@extends('layouts.master')
@section('title', 'Coaching Mentoring')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                        <div>
                            <label class="main-content-label mb-2">List Employee</label>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="mentoringtable">
                            <thead>
                                <tr>
                                    <th class="wd-20p">NIP</th>
                                    <th class="wd-20p">Name</th>
                                    <th class="wd-20p">Position</th>
                                    <th class="wd-20p">Progress</th>
                                    <th class="wd-20p">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $data)
                                    <tr>
                                        <td>{{ $data->nip }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->role }}</td>
                                        <td>
                                            <a href="{{ route('spv.senior.coaching.show', $data->userid) }}">
                                                <div class="progress mg-b-10">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar-lg" role="progressbar" aria-valuenow="{{ $data->data }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $data->data }}%"></div>
                                                </div>
                                            </a>
                                        </td>
                                        <td>
                                            @if ($data->data == 0)
                                                <p class="text-danger">Not working yet</p>
                                            @elseif ($data->data > 0 && $data->data < 100)
                                                <p class="text-warning">In progress</p>
                                            @elseif ($data->data >= 100)
                                                <p class="text-success">Complete</p>
                                            @endif
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
