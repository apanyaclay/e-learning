@extends('layout.app')
@section('content')
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Jadwal Mata Pelajaran</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Jadwal Mata Pelajaran</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Jadwal Mata Pelajaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-center">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Hari</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Jam</th>
                                            <th>Kelas</th>
                                            <th>Jurusan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($groupedJadwals as $hari => $jadwals)
                                        <tr>
                                            <td rowspan="{{ $jadwals->count() }}">{{ $hari }}</td>
                                            <td>{{ $jadwals[0]->pengajar->mataPelajaran->nama }}</td>
                                            <td>{{ $jadwals[0]->jam_mulai }} - {{ $jadwals[0]->jam_selesai }}</td>
                                            <td>{{ $jadwals[0]->kelas->nama }}</td>
                                            <td>{{ $jadwals[0]->jurusan->nama }}</td>
                                        </tr>
                                        @foreach ($jadwals->slice(1) as $jadwal)
                                        <tr>
                                            <td>{{ $jadwal->pengajar->mataPelajaran->nama }}</td>
                                            <td>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                                            <td>{{ $jadwal->kelas->nama }}</td>
                                            <td>{{ $jadwal->jurusan->nama }}</td>
                                        </tr>
                                        @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
