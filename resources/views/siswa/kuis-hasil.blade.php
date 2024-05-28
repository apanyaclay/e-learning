@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Hasil Kuis</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Hasil Kuis</li>
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
                                        <h3 class="page-title">Hasil Kuis</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>ID</th>
                                            <th>Pertanyaan</th>
                                            <th>Jawaban</th>
                                            <th>Benar/Salah</th>
                                            <th>Bobot</th> <!-- Tambahkan kolom bobot -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jawaban as $value)
                                            <tr>
                                                <td>{{ $value->soal->id }}</td>
                                                <td>{{ $value->soal->pertanyaan }}</td>
                                                <td>{{ $value->jawaban }}</td>
                                                <td>
                                                    @if ($value->benar)
                                                        <span class="text-success">Benar</span>
                                                    @else
                                                        <span class="text-danger">Salah</span>
                                                    @endif
                                                </td>
                                                <td>{{ $value->soal->bobot }}</td> <!-- Tampilkan bobot -->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                <h4>Total Nilai: {{ $totalNilai }}</h4> <!-- Tampilkan total nilai -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
