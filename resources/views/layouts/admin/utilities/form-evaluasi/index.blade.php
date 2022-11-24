@extends('layouts.master')
@section('title', 'Evaluation Form')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Add Evaluation Form</h6>
                    </div>
                    <div class="">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3 mb-0" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form action="{{ route('evaluation.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row justify-content-end mb-0">
                                <div class="col-lg-12 mt-3 mb-2">
                                    <select class="form-control d-block" name="role" id="">
                                        <option value="" selected disabled>Choose evaluation form role</option>
                                        <option value="Operator">Operator</option>
                                        <option value="Supervisor">Supervisor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-12">
                                    <input name="file" type="file" class="dropify" data-height="200" accept=".csv" />
                                </div>
                            </div>
                            <div class="form-group row justify-content-end mb-0">
                                <div class="col-lg-12 mt-2">
                                    <button type="submit" class="btn ripple btn-primary btn-block">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Internal Fileuploads js-->
    <script src="{{ asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>

    <!-- InternalFancy uploader js-->
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
@endsection
