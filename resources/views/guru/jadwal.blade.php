@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Jadwal Mapel</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Jadwal Mapel</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Jadwal Mapel</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Hari</th>
                                            <th>Mapel</th>
                                            <th>Jam</th>
                                            <th>Kelas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($groupedJadwals as $hari => $jadwals)
                                            <tr>
                                                <td rowspan="{{ count($jadwals) }}">{{ $hari }}</td>
                                                @foreach ($jadwals as $index => $jadwal)
                                                    @if ($index > 0)
                                                        <tr>
                                                    @endif
                                                    <td>{{ $jadwal->mataPelajaran->nama }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</td>
                                                    <td>{{ $jadwal->kelas->nama }} {{$jadwal->jurusan->nama}}</td>
                                                    </tr>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
