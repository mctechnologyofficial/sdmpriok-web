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
                        <ul class="list-group list-group-flush">
                            @foreach ($outercompetency as $value)
                                @if ($value->name == $data->name)
                                    <li class="list-group-item">
                                        <a href="javascript:void(0)" class="text-dark mb-0 mt-0" id="subcategory">{{ $value->sub_category }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card overflow-hidden evaluation-card">
                {{-- <div class="card-header">
                    <div class="mr-auto mb-2 d-flex">
                        <input type="hidden" name="competencyid" id="competencyid">
                        <select name="material" id="material" class="form-control select2">
                            <option value="" selected disabled>Choose material</option>
                            @foreach ($formevaluasi as $data)
                                <option value="{{ $data->tools }}">{{ $data->tools }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example-input" class="table table-bordered text-wrap">
                            <thead>
                                <tr>
                                    <th class="d-none">id</th>
                                    <th>Test Material</th>
                                    <th>Competence Test</th>
                                    <th>Answer</th>
                                    {{-- <th>Description</th> --}}
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Evaluation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="mg-b-0">Answer</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <textarea name="essay" class="form-control mb-2" cols="30" rows="10" id="essay" readonly></textarea>
                                        </div>
                                    </div>

                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="mg-b-0">File</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <a class="btn btn-outline-info btn-block" id="downloadFile" download></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
        var formevaluationid, competencyid, file;

        $(document).on('click', '#subcategory', function(){
            var value = $(this).text();

            $.ajax({
                url: '/supervisor/coaching-mentoring/getquestion',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    reference: value
                },
                dataType: 'json',
                success: function(response){
                    createRows(response);
                    $('.select2').prop('disabled', false);
                }
            });
        });

        $('#example-input').on('click', 'tr', function(){
            formevaluationid = $(this).find("#evaluationid").text();
        });

        $(document).on('click', '#btnLihat', function(){
            $.ajax({
                url: '/supervisor/coaching-mentoring/getanswer',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    formevaluationid: formevaluationid
                },
                dataType: 'json',
                success: function(response){
                    createAnswer(response);
                }
            });
        });

        function createRows(response){
            var len = 0;
            $('#example-input tbody').empty();

            if(response['data'] != null){
                len = response['data'].length;
            }

            if(len > 0){
                for(var i=0; i < len; i++){

                    var id = response['data'][i].id;
                    var reference = response['data'][i].reference;
                    var lesson_plan = response['data'][i].lesson_plan;

                    var tr_str = "<tr>" +
                        "<td id='evaluationid' class='d-none'>" + id + "</td>" +
                        "<td id='reference'>" + reference + "</td>" +
                        "<td>" + lesson_plan + "</td>" +
                        "<td><button id='btnLihat' class='btn btn-outline-info btn-block' data-toggle='modal' data-target='#exampleModalCenter'>Open</button></td>" +
                        "</tr>";

                    $("#example-input tbody").append(tr_str);
                }
            }else{
                var tr_str = "<tr>" +
                "<td colspan='4' class='text-center'>No record found</td>" +
                "</tr>";

                $("#example-input tbody").empty().append(tr_str);
            }
        }

        function createAnswer(response){
            var len = 0;
            $('#essay').val('');

            if(response['data'] != null){
                len = response['data'].length;
            }

            if(len > 0){
                for(var i=0; i < len; i++){

                    var id = response['data'][i].id;
                    var essay = response['data'][i].essay;
                    file = response['data'][i].file;

                    $('#essay').val(essay);

                    var url = '{{ asset(':file') }}';
                    url = url.replace(':file', file);

                    if(file == null){
                        $('#downloadFile').text('User has not uploaded file yet.');
                        $('#downloadFile').prop('href', '#');
                    }else{
                        $('#downloadFile').text('Download');
                        $('#downloadFile').prop('href', url);
                    }
                }
            }else{
                $('#essay').val('');
            }
        }
    </script>
@endsection
