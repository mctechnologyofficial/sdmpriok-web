@extends('layouts.master')
@section('title', 'Evaluation Form')

@section('content')
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-body text-center">
                <h4 class="font-weight-bold">{{ $name }} ({{ $nip }})</h4>
                    <h5>{{ $role }}</h5>
            </div>
        </div>
    </div>
</div>

<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card custom-card overflow-hidden">
            <div class="card-body">
                <input type="hidden" name="competencyid" class="competencyid" value="{{ $competency->id }}" />
                <div class="table-responsive">
                    <table id="example-input" class="table table-bordered text-wrap">
                        <thead>
                            <tr>
                                <th class="d-none">id</th>
                                <th>No</th>
                                <th>Test Material</th>
                                <th>Competence Test</th>
                                <th>Result</th>
                                <th>Description</th>
                                {{-- <th rowspan="10">Note</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($formevaluasi as $key => $data)
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
                                    {{-- <td>
                                        <textarea class="form-control" name="row-1-comments" id="description" rows="1" spellcheck="false">{{ $data->evaluation_description }}
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

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
    <script>
        $(document).ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var id = $('.competencyid').val();
            var result, description, formevaluationid;

            $('#example-input tbody tr').on('click', function(){
                formevaluationid = $(this).find("#idevaluation").text();
            });
            $(document).on('focusout', '#result', function(){
                result = $(this).val();
            });
            $(document).on('focusout', '#description', function(){
                description = $(this).val();

                $.ajax({
                    type:"POST",
                    url: "{{ route('spv.coaching.store') }}",
                    data: {
                        _token: CSRF_TOKEN,
                        competencyid: id,
                        formevaluationid : formevaluationid,
                        result: result,
                        description: description,
                    },
                    dataType: 'json',
                    success: function(response){
                        Swal.fire({
                            title: 'Success',
                            text: 'Your evaluation has been submitted successfully!',
                            icon: 'success'
                        })
                    }
                });
            });
        });
    </script>
@endsection
