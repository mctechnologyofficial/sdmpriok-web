@extends('layouts.master')
@section('title', 'Monitoring Chart')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Monitoring Team Progress Chart</h6>
                    </div>
                    <canvas id="chartMonitoringTeam"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            $.ajax({
                url: '/admin/progress-chart/getdataprogress',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN
                },
                dataType: 'json',
                success: function(response){

                    const ChartData = {
                        labels: response['label'],
                        datasets: [{
                            label: 'Monitoring Progress Team',
                            data: response['data'],
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

                    var personalChart = document.getElementById('chartMonitoringTeam');;
                    var radarPersonalChart = new Chart(personalChart, {
                        type: 'bar',
                        data: ChartData,
                        options: {
                            // scales: {
                            //     y: {
                            //         beginAtZero: true
                            //     }
                            // }
                        },
                    });
                }
            });
        });
    </script>
@endsection
