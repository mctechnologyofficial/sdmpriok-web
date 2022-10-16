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

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            $.ajax({
                url: '/supervisor/getradar',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN
                },
                dataType: 'json',
                success: function(response){
                    ChartData = {};
                    ChartData.labels = response['labelcompetency'];
                    ChartData.datasets = [];

                    var color = ["rgba(241,28,39,0.8)", //red
                                "rgba(231,221,28,0.8)", //yellow
                                "rgba(28,145,241,0.8)",//blue
                                "rgba(38,231,28,0.8)", //green
                                "rgba(28,231,221,0.8)", //cyan
                                "rgba(231,228,211,0.8)", //pink
                                "rgba(3,1,3,0.8)", // black
                                "rgba(236,176,179,0.8)", //light pink
                                "rgba(239,107,51,0.8)", //orange
                                "rgba(157,51,239,0.8)", //violet
                                "rgba(16,82,248,0.8)", //royalblue
                                "rgba(241,28,39,0.8)"];

                    for(var i = 0; i < response['labeluser'].length; i++){
                        ChartData.datasets.push({});
                        dataset = ChartData.datasets[i]
                        dataset.backgroundColor = color[i],
                        dataset.data = [10, 20, 30, 40]; //data on Y-Axis
                        dataset.label =  response['labeluser'][i]; //labels
                        // ChartData.datasets[i].data = response['dataprogress'][i];
                    }


                    var teamChart = document.getElementById('teamChart');;
                    var radarTeamChart = new Chart(teamChart, {
                        type: 'radar',
                        data: ChartData
                    });
                }
            });
        });
        // var rand = [ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f' ];
        // var color = '#' + rand[Math.ceil(Math.random() * 15)] + rand[Math.ceil(Math.random() * 15)] + rand[Math.ceil(Math.random() * 15)] + rand[Math.ceil(Math.random() * 15)] + rand[Math.ceil(Math.random() * 15)] + rand[Math.ceil(Math.random() * 15)];

        // var teamData = {
        // labels: labelToolsSpv,
        // datasets: [
        //         {
        //             label: labelTeamSpv,
        //             backgroundColor: color,
        //             data: dataTeamSpv
        //         }
        //     ]
        // };


    </script>
@endsection
