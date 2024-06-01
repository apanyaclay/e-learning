@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Kelas</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('home')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Semua Siswa</li>
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
                                        <h3 class="page-title">Siswa {{$kelas->nama}} {{$jurusan->nama}}</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>No</th>
                                            <th>NISN</th>
                                            <th>Nama Siswa</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Agama</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa as $index => $value)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $value->nisn }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{url('siswa/siswa/profile/'. $value->nisn)}}" class="avatar avatar-sm me-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ Storage::url('foto/' . $value->foto) }}"
                                                                alt="User Image"></a>
                                                        <a href="{{url('siswa/siswa/profile/'. $value->nisn)}}">{{ $value->nama }}</a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    @if ($value->jenis_kelamin == 'L')
                                                        Laki-Laki
                                                    @else
                                                        Perempuan
                                                    @endif
                                                </td>
                                                <td>{{ $value->agama }}</td>
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
