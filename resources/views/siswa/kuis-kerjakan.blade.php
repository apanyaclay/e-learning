@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Kuis Info</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Kuis Info</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <h4 class="mb-4">Detail Kuis</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Nama Kuis:</strong>
                                    <p>{{ $kuis->nama }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Tenggat Waktu:</strong>
                                    <p>{{ \Carbon\Carbon::parse($kuis->tenggat)->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Durasi:</strong>
                                    <p>{{ $kuis->durasi }} menit</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Banyak Soal:</strong>
                                    <p>{{ $soal }} soal</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Mulai:</strong>
                                    <p>{{ $kuis->mulai ? \Carbon\Carbon::parse($kuis->mulai)->format('d M Y H:i') : '-' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Hasil:</strong>
                                    <p>{{ isset($nilai) && $nilai->nilai ? $nilai->nilai : '-' }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 text-center">
                                    @if (isset($nilai) && $nilai->nilai)
                                        <button class="btn btn-success" disabled>Sudah Dikerjakan</button>
                                    @elseif (now() <= \Carbon\Carbon::parse($kuis->tenggat))
                                        <button class="btn btn-primary" onclick="location.href='{{ url('siswa/kuis/kerjakan/'. $kuis->id.'/soal') }}'">Mulai Kuis</button>
                                    @else
                                        <button class="btn btn-secondary" disabled>Tenggat Waktu Terlewati</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
