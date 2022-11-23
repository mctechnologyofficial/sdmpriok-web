@extends('layouts.master')
@section('title', 'Assessment Chart')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Assessment Chart (Personal)</h6>
                    </div>
                    <canvas id="personalChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
        integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $.ajax({
                url: '/supervisor/assessment-chart/getradarpersonal',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN
                },
                dataType: 'json',
                success: function(response) {
                    const ChartData = {
                        labels: response['label'],
                        datasets: [{
                            label: 'Personal Progress (Supervisor)',
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
                    // ChartData = {};
                    // ChartData.labels = response['label'];
                    // ChartData.datasets = [];

                    // var color = ["rgba(241,28,39,0.8)", //red
                    //             "rgba(231,221,28,0.8)", //yellow
                    //             "rgba(28,145,241,0.8)",//blue
                    //             "rgba(38,231,28,0.8)", //green
                    //             "rgba(28,231,221,0.8)", //cyan
                    //             "rgba(231,228,211,0.8)", //pink
                    //             "rgba(3,1,3,0.8)", // black
                    //             "rgba(236,176,179,0.8)", //light pink
                    //             "rgba(239,107,51,0.8)", //orange
                    //             "rgba(157,51,239,0.8)", //violet
                    //             "rgba(16,82,248,0.8)", //royalblue
                    //             "rgba(241,28,39,0.8)"];

                    // for(var i = 0; i < response['data'].length; i++){
                    //     ChartData.datasets.push({});
                    //     dataset = ChartData.datasets[i]
                    //     dataset.backgroundColor = color[i],
                    //     dataset.data = response['data'][i]; //data on Y-Axis
                    //     dataset.label =  response['label'][i]; //labels
                    //     // ChartData.datasets[i].data = response['data'][i];
                    // }


                    var personalChart = document.getElementById('personalChart');;
                    var radarPersonalChart = new Chart(personalChart, {
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
    </script>
@endsection
