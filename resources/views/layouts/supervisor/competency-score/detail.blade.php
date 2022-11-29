@extends('layouts.master')
@section('title', 'Competency Score')

@section('css')
    <style>
        .swal2-container {
            z-index: 20000 !important;
        }
    </style>
@endsection

@section('content')
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example-input" class="table table-bordered text-wrap table-hover">
                        <thead>
                            <tr>
                                <th class="d-none">id</th>
                                <th>Test Material</th>
                                <th>Competence Test</th>
                                <th>Answer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($question as $data)
                                <tr>
                                    <td class="d-none" id="questionid">{{ $data->id }}</td>
                                    <td>{{ $data->reference }}</td>
                                    <td>{{ $data->lesson_plan }}</td>
                                    <td>
                                        <button type="button" id="openmodal" class="btn btn-outline-primary btn-block mb-2" data-toggle='modal' data-target='#exampleModalCenter'>Open</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
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
                                <input type="hidden" id="competencyid" value="{{ $competencyid }}">
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="mg-b-0">Score</label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <input type="text" name="score" id="score" class="form-control mb-2" readonly>
                                    </div>
                                </div>

                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="mg-b-0">Development Area</label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <input type="text" name="area" id="area" class="form-control mb-2" readonly>
                                    </div>
                                </div>

                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="mg-b-0">Comment</label>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="commenttext">
                                    <div class="input-group-prepend">
                                        <button id="postcomment" type="button" class="btn btn-outline-primary">Post Comment</button>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <ul class="list-group list-group-flush" id="comment"></ul>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    <script>
        $(document).ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var questionid, commentid;
            $('#commenttext').prop('disabled', true);
            $('#postcomment').prop('disabled', true);

            $('#example-input').on('click', 'tr', function(){
                questionid = $(this).find('#questionid').text();
            });

            $(document).on('click', '#openmodal', function(){
                $.ajax({
                    url: '/supervisor/competency-score/getevaluation',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        questionid: questionid
                    },
                    dataType: 'json',
                    success: function(response){
                        createEvaluation(response);
                    }
                });

                $.ajax({
                    url: '/supervisor/competency-score/getcomment',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        competencyid: $('#competencyid').val(),
                        questionid: questionid
                    },
                    dataType: 'json',
                    success: function(response){
                        createComment(response);
                    }
                });
            });

            $(document).on('click', '#postcomment', function(){
                $.ajax({
                    type:"POST",
                    url: "{{ route('competency-score-spv.postcomment') }}",
                    data: {
                        _token: CSRF_TOKEN,
                        commentid: commentid,
                        competencyid: $('#competencyid').val(),
                        questionid: questionid,
                        comment : $('#commenttext').val(),
                    },
                    dataType: 'json',
                    success: function(response){
                        Swal.fire({
                            title: 'Success',
                            text: 'Your comment has been submitted successfully!',
                            icon: 'success'
                        }).then((value) => {
                            $('#commenttext').val('');
                            $('#commenttext').prop('disabled', true);
                            $('#postcomment').prop('disabled', true);

                            $.ajax({
                                url: '/supervisor/competency-score/getcomment',
                                type: 'GET',
                                data: {
                                    _token: CSRF_TOKEN,
                                    competencyid: $('#competencyid').val(),
                                    questionid: questionid
                                },
                                dataType: 'json',
                                success: function(response){
                                    createComment(response);
                                }
                            });
                        });
                    }
                });
            });

            $(document).on('click', '#listcomment', function(){
                commentid = $(this).find('#commentid').val();
            });

            $(document).on('click', '#replycomment', function(){
                $('#commenttext').prop('disabled', false);
                $('#postcomment').prop('disabled', false);
            });

            function createComment(response){
                var len = 0;
                $('#comment').empty();

                if(response['data'] != null){
                    len = response['data'].length;
                }

                if(len > 0){
                    for(var i=0; i < len; i++){
                        var id = response['data'][i].id;
                        var name = response['data'][i].name;
                        var comment = response['data'][i].comment;
                        var time = response['data'][i].time;

                        var tr_str = "<li class='list-group-item' id='listcomment' style='background-color: whitesmoke;'>" +
                            "<h4><input type='hidden' id='commentid' value='" + id + "'/></h4>" +
                            "<h4>" + name + "</h4>" +
                            "<p>" + comment + "</p>" +
                            "<p>" + time + "</p>" +
                            "<button type='button' id='replycomment' class='btn btn-outline-info'>Reply</button>" +
                            "</li>" + "<hr />";

                        $("#comment").append(tr_str);
                    }
                }else{
                    $("#comment tbody").empty();
                }
            }

            function createEvaluation(response) {
                var len = 0;
                $("#score").val('');
                $("#area").val('');

                if(response['data'] != null){
                    len = response['data'].length;
                }

                if(len > 0){
                    for(var i=0; i < len; i++){
                        var result = response['data'][i].result;
                        var description = response['data'][i].description;

                        $('#score').val(result).trigger('change');
                        $('#area').val(description).trigger('change');
                    }
                }else{
                    $("#score").val('');
                    $("#area").val('');
                }
            }
        });
    </script>
@endsection
