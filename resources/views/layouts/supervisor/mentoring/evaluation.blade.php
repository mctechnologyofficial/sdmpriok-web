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
                                        <input class="form-control input-sm" type="text" name="row-1-age" id="result" value="{{ $data->result }}">
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="row-1-comments" id="description" rows="1">{{ $data->description }}</textarea>
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
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            $('#example-input tbody tr').on('click', function(){
                var value = $(this).find("#idevaluation").html();
                $(document).on('focusout', '#result', function(){
                    var result = $(this).val();
                    $(document).on('focusout', '#description', function(){
                        var description = $(this).val();
                        
                    });
                });
            });
        });
    </script>
@endsection
