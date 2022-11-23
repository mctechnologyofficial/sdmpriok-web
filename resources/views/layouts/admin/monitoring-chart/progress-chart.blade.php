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
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        const data = [{
                team: 'A',
                progress: 10
            },
            {
                year: 'B',
                count: 20
            },
            {
                year: 'C',
                count: 30
            },
            {
                year: 'D',
                count: 40
            }
        ];

        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: data.map(row => row.team),
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
