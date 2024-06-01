@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Pertemuan</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('home')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Semua Pertemuan</li>
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
                                        <h3 class="page-title">Pertemuan</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>No</th>
                                            <th>Pertemuan</th>
                                            <th>Materi</th>
                                            <th>Mapel</th>
                                            <th>Nama Guru</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pertemuan as $index => $value)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $value->pertemuan }}</td>
                                                <td>{{ $value->materi_nama }}</td>
                                                <td>{{ $value->mapel_nama }}</td>
                                                <td>{{ $value->guru_nama }}</td>
                                                <td>{{ \Carbon\Carbon::parse($value->tanggal)->format('d m Y') }}</td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a href="{{url('siswa/pertemuan/view/'.$value->id)}}" class="btn btn-sm bg-success-light me-2">
                                                            <i class="fe fe-eye"></i>
                                                        </a>
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
