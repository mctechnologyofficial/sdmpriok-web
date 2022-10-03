@extends('layouts.master')
@section('title', 'Monitoring Chart')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Monitoring Team Progress Chart</h6>
                        {{-- <p class="text-muted  card-sub-title">Below is the basic bar chart example.</p> --}}
                    </div>
                    <canvas id="chartBar"></canvas>
                    {{-- <div class="chartjs-wrapper-demo">
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection