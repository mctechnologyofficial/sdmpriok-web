@extends('layouts.master')
@section('title', 'Home')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card mg-b-20">
                <div class="card custom-card" id="animate">
                    <div class="card-body">
                        <div class="row m-3">
                            <div class="col-lg-12">
                                <h4 class="mb-2">Competency Progress (Personal)</h4>
                                <div class="progress mg-b-10">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar-lg" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 25%"></div>
                                </div>
                                <h4 class="mt-3 mb-2">Competency Progress (Team)</h4>
                                <div class="progress mg-b-10">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar-lg" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row m-3">
                            <div class="col-lg-3">
                                <div class="d-flex justify-content-center">
                                    @foreach ($home as $picture1)
                                        @if ($picture1->type == "Picture" && $picture1->row == "Row 1")
                                            <img class="img-fluid rounded-circle w-75 mb-3" alt="100x100" src="{{ Storage::url($picture1->image) }}" data-holder-rendered="true">
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-9">
                                @include('layouts.supervisor.components.slider1')
                            </div>
                        </div>
                        <hr>
                        <div class="row m-3">
                            <div class="col-lg-9">
                                @include('layouts.supervisor.components.slider2')
                            </div>
                            <div class="col-lg-3">
                                <div class="d-flex justify-content-center">
                                    @foreach ($home as $picture2)
                                        @if ($picture2->type == "Picture" && $picture2->row == "Row 2")
                                            <img class="img-fluid rounded-circle w-75 mb-3 mt-3" alt="100x100" src="{{ Storage::url($picture2->image) }}" data-holder-rendered="true">
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row m-3">
                            <div class="col-lg-3">
                                <div class="d-flex justify-content-center">
                                    @foreach ($home as $picture3)
                                        @if ($picture3->type == "Picture" && $picture3->row == "Row 3")
                                            <img class="img-fluid rounded-circle w-75 mb-3" alt="100x100" src="{{ Storage::url($picture3->image) }}" data-holder-rendered="true">
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-9">
                                @include('layouts.supervisor.components.slider3')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
