@extends('layouts.master')
@section('title', 'Organization')

@section('css')
    <style>
        .swal2-container {
            z-index: 20000 !important;
        }
        .list-group{
            max-height: 200px;
            overflow:scroll;
            -webkit-overflow-scrolling: touch;
        }
    </style>
@endsection

@section('content')
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 text-center my-auto">
                        <canvas id="leftChart" width="200" height="200"></canvas>
                    </div>
                    <div class="col-lg-6 text-center my-auto">
                        <canvas id="rightChart"></canvas>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 text-center">
                        <select name="team" class="form-control mt-2 mb-2 d-block" id="teamleft">
                            <option value="" selected disabled>Choose Team</option>
                            @foreach ($team as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        <ul class="list-group list-group-flush text-justify" id="teamleft-list"></ul>
                    </div>
                    <div class="col-lg-2 text-center my-auto">
                        <button type="button" class="btn btn-outline-primary justify-content-center align-self-center btn-block" id="moveright">=></button>
                        <button type="button" class="btn btn-outline-primary justify-content-center align-self-center btn-block" id="moveleft"><=</button>
                    </div>
                    <div class="col-lg-5 text-center">
                        <select name="team" class="form-control mt-2 mb-2 d-block" id="teamright">
                            <option value="" selected disabled>Choose Team</option>
                            @foreach ($team as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        <ul class="list-group list-group-flush text-justify" id="teamright-list"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        const radarleft = document.getElementById('leftChart').getContext('2d');
        const radarright = document.getElementById('rightChart').getContext('2d');
        var idleft, idright;

        function createTeamLeft(response) {
            var len = 0;
            $('#teamleft-list').empty();

            if(response['data'] != null){
                len = response['data'].length;
            }

            if(len > 0){
                for(var i=0; i < len; i++){
                    var id = response['data'][i].id;
                    var name = response['data'][i].name;

                    var tr_str = "<li class='list-group-item' id='listteamleft' style='background-color: #f9f9f9;'>" +
                        "<input type='hidden' id='useridleft' value='" + id + "'/>" +
                        "<a href='javascript:void(0)' class='text-dark'>" + name + "</a>" +
                        "</li>";

                    $("#teamleft-list").append(tr_str);
                }
            }else{
                $("#teamleft-list").empty();
            }
        }

        function createTeamRight(response) {
            var len = 0;
            $('#teamright-list').empty();

            if(response['data'] != null){
                len = response['data'].length;
            }

            if(len > 0){
                for(var i=0; i < len; i++){
                    var id = response['data'][i].id;
                    var name = response['data'][i].name;

                    var tr_str = "<li class='list-group-item' id='listteamright' style='background-color: #f9f9f9;'>" +
                        "<input type='hidden' id='useridright' value='" + id + "'/>" +
                        "<a href='javascript:void(0)' class='text-dark'>" + name + "</a>" +
                        "</li>";

                    $("#teamright-list").append(tr_str);
                }
            }else{
                $("#teamright-list").empty();
            }
        }

        $('#teamleft').on('change', function(){
            var value = $(this).val();

            $.ajax({
                url: '/admin/organization/getteam',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: value
                },
                dataType: 'json',
                success: function(response){
                    createTeamLeft(response);
                }
            });

            $.ajax({
                url: '/admin/organization/getradar',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: value
                },
                dataType: 'json',
                success: function(response){
                    let kiri = Chart.getChart("leftChart"); // redraw chart if exist
                    if (kiri != undefined) {
                        kiri.destroy();
                    }

                    let json = response['team'];
                    let progressdata = [];
                    let user = [];

                    json.forEach(e => {
                        progressdata.push(e.progress);
                        user.push(e.users);
                    });

                    const ChartData = {
                        labels: user,
                        datasets: [{
                            label: 'Team Progress',
                            data: progressdata,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            borderWidth: 1
                        }]
                    };

                    var radarTeamChart = new Chart(radarleft, {
                        type: 'radar',
                        data: ChartData,
                        options: {
                            scales: {
                                // y: {
                                //     beginAtZero: true
                                // }
                            }
                        },
                    });
                }
            });
        })

        $('#teamright').on('change', function(){
            var value = $(this).val();

            $.ajax({
                url: '/admin/organization/getteam',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: value
                },
                dataType: 'json',
                success: function(response){
                    createTeamRight(response);
                }
            });

            $.ajax({
                url: '/admin/organization/getradar',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: value
                },
                dataType: 'json',
                success: function(response){
                    let kanan = Chart.getChart("rightChart"); // redraw chart if exist
                    if (kanan != undefined) {
                        kanan.destroy();
                    }

                    let json = response['team'];
                    let progressdata = [];
                    let user = [];

                    json.forEach(e => {
                        progressdata.push(e.progress);
                        user.push(e.users);
                    });

                    const ChartData = {
                        labels: user,
                        datasets: [{
                            label: 'Team Progress',
                            data: progressdata,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            borderWidth: 1
                        }]
                    };

                    var radarTeamChart = new Chart(radarright, {
                        type: 'radar',
                        data: ChartData,
                        options: {
                            scales: {
                                // y: {
                                //     beginAtZero: true
                                // }
                            }
                        },
                    });
                }
            });
        });

        $(document).on('click', '#listteamleft', function(){
            idleft = $(this).find('#useridleft').val();
        });

        $(document).on('click', '#listteamright', function(){
            idright = $(this).find('#useridright').val();
        });
    });
</script>
@endsection
