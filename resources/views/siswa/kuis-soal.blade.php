@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Soal Kuis</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Soal</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Soal Kuis</h3>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h3 class="page-title" id="countdown"></h3>
                                    </div>
                                </div>
                            </div>

                            <form id="quizForm" action="{{ route('siswa/kuis/kerjakan/submit', $kuis->id) }}"
                                method="POST">
                                @csrf
                                <div class="table-responsive">
                                    @foreach ($soal as $key => $value)
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h4>{{ $key + 1 }}. {{ $value->pertanyaan }}</h4>
                                            </div>
                                            <div class="card-body">
                                                @foreach (['A', 'B', 'C', 'D', 'E'] as $option)
                                                    @if ($value['opsi_' . strtolower($option)])
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="soal[{{ $value->id }}]" value="{{ $option }}"
                                                                id="soal_{{ $value->id }}_{{ $option }}">
                                                            <label class="form-check-label"
                                                                for="soal_{{ $value->id }}_{{ $option }}">
                                                                {{ $value['opsi_' . strtolower($option)] }}
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Set the start time and duration from PHP
            var startTime = new Date("{{ $kuis->mulai }}");
            var durationInMinutes = parseInt("{{ $kuis->durasi }}");

            // Calculate the end time by adding the duration to the start time
            var endTime = new Date(startTime.getTime() + durationInMinutes * 60000);

            var formSubmitted = false;

            // Update the count down every 1 second
            var x = setInterval(function() {
                // Get today's date and time
                var now = new Date();

                // Find the distance between now and the count down date
                var distance = endTime - now;

                // Time calculations for hours, minutes and seconds
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="countdown"
                document.getElementById("countdown").innerHTML = hours + " jam " + minutes + " menit " +
                    seconds + " detik ";

                // If the count down is finished, submit the form
                if (distance < 0 && !formSubmitted) {
                    clearInterval(x);
                    document.getElementById("countdown").innerHTML = "EXPIRED";
                    formSubmitted = true;
                    document.getElementById('quizForm').submit();
                }
            }, 1000);
        });
    </script>
@endsection
