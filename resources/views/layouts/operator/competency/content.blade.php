@extends('layouts.master')
@section('title', 'Competency Tools')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
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
                        <div class="mr-auto mb-2">
                            <select name="lesson" id="lesson" class="form-control">
                                <option value="" selected disabled>Choose lesson</option>
                            </select>
                        </div>
                        <div class="ml-auto">
                            {{-- <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                            <div class="dropdown-menu">
                                @foreach ($competency as $data)
                                    @if ($data->role == "Operator")
                                        <a class="dropdown-item tools-competency-op" href="javascript:void(0)">{{ $data->name }}</a>
                                    @endif
                                @endforeach
                            </div> --}}
                            <div class="btn-group dropleft">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Competency
                                </button>
                                <div class="dropdown-menu">
                                    @foreach ($competency as $data)
                                        @if ($data->role == "Operator")
                                            <a class="dropdown-item tools-competency-op" href="javascript:void(0)">{{ $data->name }}</a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover" id="tblOperatorQuestion">
                            <thead class="thead-dark">
                                <tr>
                                    <th>id</th>
                                    <th class="">Competency</th>
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

                    <form action="{{ route('competency-tools-op.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal" tabindex="-1" role="dialog" id="answerOperatorModal">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="mg-b-0">Competency</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input type="hidden" name="questionid" id="questionid">
                                            <input type="hidden" name="competencyid" id="idcompetency">
                                            <input type="text" name="competency" class="form-control" id="competency" readonly>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="mg-b-0">Lesson</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input type="text" name="lesson" class="form-control" id="textlesson" readonly>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="mg-b-0">Answer</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <textarea name="essay" class="form-control mb-2" cols="30" rows="10"></textarea>

                                            <div class="input-group file-browser">
                                                <input type="text" class="form-control border-right-0 browse-file" placeholder="choose" readonly id="textFileSlider">
                                                <label class="input-group-btn">
                                                    <span class="btn btn-outline-info">
                                                        <i class="fas fa-file-upload"></i> Upload File <input type="file" style="display: none;" name="image" id="fileSlider" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel, application/pdf,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,image/*,.txt,.xlsx,.csv">
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-success"><i class="fas fa-save"></i> Save</button>
                                </div>
                                </div>
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
    <script>
        // OPERATOR COMPETENCY TOOLS
        var valueCompetencyOp;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        function createOption(response){
            var len = 0;
            $("#lesson").find('option:not(:first)').remove();

            if(response['data'] != null){
                len = response['data'].length;
            }

            if(len > 0){
                for(var i = 0; i < len; i++){
                    var lesson =response['data'][i].lesson;

                    $("#lesson").append($('<option>', {
                        value: lesson,
                        text: lesson
                    }));
                }
            }else{
                var opt = "<option value='' selected disabled>Choose lesson</option>";
                $("#lesson").empty().append(opt).trigger('change');
            }
        }

        function createValue(response){
            var len = 0;
            // $("#lesson").find('option:not(:first)').remove();
            $('#idcompetency').empty();

            if(response['data'] != null){
                len = response['data'].length;
            }

            if(len > 0){
                for(var i = 0; i < len; i++){
                    var id =response['data'][i].id;
                    $('#idcompetency').val(id);
                    // $("#lesson").append($('<option>', {
                    //     value: lesson,
                    //     text: lesson
                    // }));
                }
            }else{
                // var opt = "<option value='' selected disabled>Choose lesson</option>";
                // $("#lesson").empty().append(opt).trigger('change');
                $('#idcompetency').val('');
            }
        }

        function createRows(response){
            var len = 0;
            $('#tblOperatorQuestion tbody').empty();

        if(response['data'] != null){
            len = response['data'].length;
        }

        if(len > 0){
            for(var i=0; i < len; i++){
            var id = response['data'][i].id;
            var competency = response['data'][i].competency;
            // var category = response['data'][i].category;
            // var sub_category = response['data'][i].sub_category;
            var lesson = response['data'][i].lesson;
            var reference = response['data'][i].reference;
            var lesson_plan = response['data'][i].lesson_plan;
            var processing_time = response['data'][i].processing_time;
            var realization = response['data'][i].realization;

            var tr_str = "<tr>" +
                "<td class='questionid' style='display: none;'>" + id + "</td>" +
                "<td>" + competency + "</td>" +
                // "<td>" + category + "</td>" +
                // "<td>" + sub_category + "</td>" +
                "<td>" + lesson + "</td>" +
                "<td>" + reference + "</td>" +
                "<td>" + lesson_plan + "</td>" +
                "<td>" + processing_time + "</td>" +
                "<td>" + realization + "</td>" +
            "</tr>";

            $("#tblOperatorQuestion tbody").append(tr_str);
            }
        }else{
            var tr_str = "<tr>" +
            "<td colspan='6' class='text-center'>No record found</td>" +
            "</tr>";

            $("#tblOperatorQuestion tbody").empty().append(tr_str);
        }
    }

    $('.tools-competency-op').on('click', function(){
        valueCompetencyOp = $(this).text();
        $.ajax({
            url: '/operator/competency-tools/getlesson',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                competency: valueCompetencyOp
            },
            dataType: 'json',
            success: function(response){
                // createRows(response);
                createOption(response);
            }
        });

        $.ajax({
            url: '/operator/competency-tools/getIdCompetency',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                competency: valueCompetencyOp
            },
            dataType: 'json',
            success: function(response){
                createValue(response);
            }
        });
    });

    $('#lesson').on('change', function(){
        var value = $(this).val();
        $.ajax({
            url: '/operator/competency-tools/getquestion',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                lesson: value
            },
            dataType: 'json',
            success: function(response){
                createRows(response);
            }
        });
    });

    $('#tblOperatorQuestion tbody').on('click', 'tr',function(){
        var id = $(this).find('.questionid').html();

        if(id == undefined){
            // alert('oke');
        }else{
            $('#competency').val(valueCompetencyOp);
            $('#textlesson').val($('#lesson').val());
            $('#answerOperatorModal').modal('show');
            $('#questionid').val(id);
        }

    });
    </script>
@endsection
