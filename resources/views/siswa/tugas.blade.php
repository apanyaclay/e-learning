@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Kuis</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Semua Kuis</li>
                            </ul>
                        </div>
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
                                        <h3 class="page-title">Kuis</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Tugas</th>
                                            <th>Tenggat</th>
                                            <th>Pertemuan</th>
                                            <th>Materi</th>
                                            <th>Mapel</th>
                                            <th>Nama Guru</th>
                                            <th class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tugas as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->nama }}</td>
                                                <td>{{ $value->tenggat }}</td>
                                                <td>{{ $value->pertemuan_nama }}</td>
                                                <td>{{ $value->materi_nama }}</td>
                                                <td>{{ $value->mapel }}</td>
                                                <td>{{ $value->guru_nama }}</td>
                                                <td>
                                                    <div class="">
                                                        <a href="{{ url('siswa/tugas/kerjakan/'.$value->id) }}" class="btn btn-primary"><span style="color: white">Kerjakan</span></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
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
