@extends('layouts.master')
@section('title', 'Coaching Mentoring')

@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body text-center">
                    <h4 class="font-weight-bold">{{ $user->name }} ({{ $user->nip }})</h4>
                    <h5>{{ $user->roles->first()->name }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        @foreach ($competency as $key => $data)
            <div class="col-lg-6">
                <div class="card custom-card">
                    <div class="card-header text-center">
                        <h4 class="name">
                            {{ $data->name }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mt-0 mb-4">
                                @if ($data->name == "Tools Gas Turbin")
                                    <div class="w-50 m-auto p-auto">
                                        {!! $gasturbin->render() !!}
                                    </div>
                                @elseif ($data->name == "Tools HRSG")
                                    <div class="w-50 m-auto p-auto">
                                        {!! $hrsg->render() !!}
                                    </div>
                                @elseif ($data->name == "Tools PLTGU")
                                    <div class="w-50 m-auto p-auto">
                                        {!! $pltgu->render() !!}
                                    </div>
                                @elseif ($data->name == "Tools Steam Turbin")
                                    <div class="w-50 m-auto p-auto">
                                        {!! $steamturbin->render() !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- <h6>{{ $data->category }}</h6> --}}
                        <ul class="list-group list-group-flush">
                            @foreach ($outercompetency as $value)
                                @if ($value->name == $data->name)
                                    <li class="list-group-item bg-dark">
                                        <a href="{{ route('spv.coaching.evaluation', $value->id) }}" class="text-light mb-0 mt-0">
                                            {{ $value->sub_category }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            // let chartStatus = Chart.getChart("gasturbin"); // <canvas> id
            // chartStatus.destroy();
        });
    </script>
@endsection
