@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Guru</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Guru</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Guru</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <td>No</td>
                                            <th>NUPTK</th>
                                            <th>Nama</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Tempat Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Agama</th>
                                            <th>No HP</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($guru as $index => $value)
                                            <tr>
                                                <Td>{{$index + 1}}</Td>
                                                <td>{{ $value->nuptk }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{url('siswa/guru/profile/'. $value->nuptk)}}" class="avatar avatar-sm me-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ Storage::url('foto/' . $value->foto) }}"
                                                                alt="User Image"></a>
                                                        <a href="{{url('siswa/guru/profile/'. $value->nuptk)}}">{{ $value->nama }}</a>
                                                    </h2>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($value->tanggal_lahir)->format('d-m-Y') }}</td>
                                                <td>{{ $value->tempat_lahir }}</td>
                                                <td>
                                                    @if ($value->jenis_kelamin == 'L')
                                                        Laki-Laki
                                                    @else
                                                        Perempuan
                                                    @endif
                                                </td>
                                                <td>{{ $value->agama }}</td>
                                                <td>{{ $value->no_hp }}</td>
                                                <td>{{ $value->alamat }}</td>
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
