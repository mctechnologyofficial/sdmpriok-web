@extends('layouts.master')
@section('title', 'Home')

@section('css')
    <style>
        #progress {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: #7F8C8C;
            display: inline-block;
            margin: 0 1em;
            width: 120px;
        }

        #tp {
            margin: 0;
        }

        [data-progress] {
            width: 120px;
            height: 60px;
            border-radius: 180px 180px 0 0;
            position: relative;
            overflow: hidden;
            background: #76C7C0
        }

        [data-progress]:before {
            content: attr(data-progress);
            display: block;
            margin: 18px;
            background: white;
            text-align: center;
            font-size: 30px;
            line-height: 50px;
            font-weight: bold;
            font-family: helvetica;
            border-radius: inherit;
            position: relative;
            z-index: 1;
        }

        [data-progress]:after {
            content: '';
            background: #E2534B;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            height: 60px;
            transform-origin: top center;
            z-index:0;
            border-radius:0 0 180px 180px ;
            box-shadow: 0 0 5px black;
        }

        [data-progress="20"]:after {
        transform: rotate(36deg);
        }

        [data-progress="50"]:after {
        transform: rotate(90deg);
        }

        [data-progress="80"]:after {
        transform: rotate(144deg);
        }

        [data-progress="100"]:after {
        transform: rotate(180deg);
        }

        @keyframes color {
            50% {
                color:tomato;
            }
        }
        @keyframes spin {
            to{
                content:'100';
                transform: rotate(360deg);
            }
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card mg-b-20">
                <div class="card custom-card" id="animate">
                    <div class="card-body">
                        <div class="row m-3">
                            <div class="col-lg-12">
                                <h4 class="mb-3">Competency Progress</h4>
                                <div id="progress">
                                    <p id="tp" data-progress="{{ $result_total }}">{{ $result_total }}%</p>
                                    <p id="tp">Team</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row m-3">
                            <div class="col-lg-3">
                                <div class="d-flex justify-content-center">
                                    @foreach ($slide as $picture1)
                                        @if ($picture1->type == "Picture" && $picture1->row == "Row 1")
                                            <!--<img class="img-fluid rounded-circle w-75 mb-3" alt="100x100" src="{{ Storage::url($picture1->image) }}" data-holder-rendered="true">-->
                                            <img class="img-fluid rounded-circle w-75 mb-3" alt="100x100" src="{{ asset($picture1->image) }}" data-holder-rendered="true">
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
                                    @foreach ($slide as $picture2)
                                        @if ($picture2->type == "Picture" && $picture2->row == "Row 2")
                                            <!--<img class="img-fluid rounded-circle w-75 mb-3 mt-3" alt="100x100" src="{{ Storage::url($picture2->image) }}" data-holder-rendered="true">-->
                                            <img class="img-fluid rounded-circle w-75 mb-3 mt-3" alt="100x100" src="{{ asset($picture2->image) }}" data-holder-rendered="true">
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row m-3">
                            <div class="col-lg-3">
                                <div class="d-flex justify-content-center">
                                    @foreach ($slide as $picture3)
                                        @if ($picture3->type == "Picture" && $picture3->row == "Row 3")
                                            <!--<img class="img-fluid rounded-circle w-75 mb-3" alt="100x100" src="{{ Storage::url($picture3->image) }}" data-holder-rendered="true">-->
                                            <img class="img-fluid rounded-circle w-75 mb-3" alt="100x100" src="{{ asset($picture3->image) }}" data-holder-rendered="true">
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
@section('js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.1.min.js"></script>
    <script>
        const progress = document.querySelector('.progress-done');
        progress.style.width = progress.getAttribute('data-done') + '%';
        progress.style.opacity = 1;
    </script>
@endsection
