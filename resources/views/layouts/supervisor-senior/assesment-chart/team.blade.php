@extends('layouts.master')
@section('title', 'Assessment Chart')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h6 class="main-content-label mb-1">Assessment Chart (Team)</h6>
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="float-left">
                            <select name="userid" id="userid" class="form-control">
                                <option value="" selected disabled>Choose Team Name</option>
                                @foreach ($team as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12 container-canvas">
                            <canvas id="teamChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function() {
    $('#userid').on('change', function() {
        var id = $(this).val();

        $.ajax({
            url: '/supervisor-senior/assessment-chart/getradarteam',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                userid: id
            },
            dataType: 'json',
            success: function(response) {
                let team = Chart.getChart("teamChart"); // redraw chart if exist
                if (team != undefined) {
                    team.destroy();
                }
                let json = response['team'];
                let progressdata = [];
                let kompetensi = [];

                json.forEach(e => {
                    progressdata.push(e.progress);
                    kompetensi.push(e.competency);
                });

                var uniqueCompetency = [];
                $.each(kompetensi, function(i, el) {
                    if ($.inArray(el, uniqueCompetency) === -1) uniqueCompetency
                        .push(el);
                });
                console.log(progressdata)
                console.log(uniqueCompetency)
                const ChartData = {
                    labels: uniqueCompetency,
                    datasets: [{
                        label: 'Team Progress (Supervisor Senior)',
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
                var teamChart = document.getElementById('teamChart');;
                var radarTeamChart = new Chart(teamChart, {
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
});
</script>
@endsection
