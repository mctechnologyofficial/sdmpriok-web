@extends('layouts.master')
@section('title', 'Coaching Mentoring')

@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body text-center">
                    <h4 class="font-weight-bold">{{ $user->name }} ({{ $user->nip }})</h4>
                    <h5>{{ $user->roles->first()->name }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        @foreach ($competency as $key => $data)
            <div class="col-lg-6">
                <div class="card custom-card">
                    <div class="card-header text-center">
                        <input type="hidden" name="competencyid" id="competencyid">
                        <h4 class="name">
                            {{ $data->name }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mt-0 mb-4">
                                @if ($data->name == "Tools Gas Turbin")
                                    <div class="w-50 m-auto p-auto">
                                        {!! $gasturbin->render() !!}
                                    </div>
                                @elseif ($data->name == "Tools HRSG")
                                    <div class="w-50 m-auto p-auto">
                                        {!! $hrsg->render() !!}
                                    </div>
                                @elseif ($data->name == "Tools PLTGU")
                                    <div class="w-50 m-auto p-auto">
                                        {!! $pltgu->render() !!}
                                    </div>
                                @elseif ($data->name == "Tools Steam Turbin")
                                    <div class="w-50 m-auto p-auto">
                                        {!! $steamturbin->render() !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- <h6>{{ $data->category }}</h6> --}}
                        {{-- <ul class="list-group list-group-flush">
                            @foreach ($outercompetency as $value)
                                @if ($value->name == $data->name)
                                    <li class="list-group-item bg-dark">
                                        <a href="{{ route('spv.coaching.evaluation', $value->id) }}" class="text-light mb-0 mt-0">
                                            {{ $value->sub_category }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card overflow-hidden evaluation-card">
                <div class="card-header">
                    <div class="mr-auto mb-2 d-flex">
                        <input type="hidden" name="competencyid" id="competencyid-evaluation">
                        <select name="material" id="material" class="form-control select2">
                            <option value="" selected disabled>Choose material</option>
                            @foreach ($formevaluasi as $data)
                            <option value="{{ $data->tools }}">{{ $data->tools }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example-input" class="table table-bordered text-wrap">
                            <thead>
                                <tr>
                                    <th class="d-none">id</th>
                                    <th>Test Material</th>
                                    <th>Competence Test</th>
                                    <th>Result</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($formevaluasi as $key => $data)
                                    <tr>
                                        <td class="d-none" id="idevaluation">{{ $data->id }}</td>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->test_material }}</td>
                                        <td>{{ $data->competence_test }}</td>
                                        <td>
                                            <input class="form-control input-sm" type="text" name="row-1-age" id="result" value="{{ $data->evaluation_result }}">
                                        </td>
                                        <td>
                                            <textarea class="form-control" name="row-1-comments" id="description" rows="1" spellcheck="false">{{ $data->evaluation_description }}</textarea>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <form action="{{ route('spv.coaching.savenote') }}" method="post">
                        @csrf
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-4">
                                <label class="mg-b-0">Note</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <textarea name="note" class="form-control" id="note" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end mb-0">
                            <div class="col-md-8 pl-md-2">
                                <button class="btn ripple btn-primary pd-x-30 mg-r-5" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var formevaluationid, competencyid;
        var empty = "<tr>" + "<td colspan='4' class='text-center'>Please select one of the competencies above</td>" + "</tr>";


    </script>
@endsection
