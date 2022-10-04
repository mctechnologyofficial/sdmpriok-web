@extends('layouts.master')
@section('title', 'Assessment Chart')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Assessment Chart (Team)</h6>
                    </div>
                    <canvas id="teamChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
