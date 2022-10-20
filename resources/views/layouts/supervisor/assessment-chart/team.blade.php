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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            function createChart(response){
                $('#teamChart').remove();
                $('.container-canvas').append('<canvas id="teamChart"><canvas>');
                
                let json = response['team'];
                let progressdata = [];
                let kompetensi = [];

                json.forEach(e => {
                    progressdata.push([+e.progress]);
                    kompetensi.push(e.competency);
                });

                var uniqueCompetency = [];
                $.each(kompetensi, function(i, el){
                    if($.inArray(el, uniqueCompetency) === -1) uniqueCompetency.push(el);
                });

                var teamChart = document.getElementById('teamChart').getContext('2d');
                
                teamChart.canvas.width = 300;
                teamChart.canvas.height = 300;

                var radarTeamChart = new Chart(teamChart, {
                    type: 'pie',
                    data: {
                        labels: uniqueCompetency,
                        datasets: [{
                            label: 'Competency Progress',
                            data: progressdata,
                            backgroundColor: [
                                "rgba(241,28,39)",
                                "rgba(28,145,241)",
                                "rgba(231,221,28)",
                                "rgba(38,231,28)"
                            ],
                            hoverOffset: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });    
            }

            $('#userid').on('change', function(){
                var id = $(this).val();

                $.ajax({
                    url: '/supervisor/assessment-chart/getradarteam',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        userid: id
                    },
                    dataType: 'json',
                    success: function(response){
                        createChart(response);
                    }
                });
            });

        });
    </script>
@endsection
