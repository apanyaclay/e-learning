@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Tugas</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tugas</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-bordered nav-justified">
                                <li class="nav-item">
                                    <a href="#soal" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                        Pertanyaan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tanggapan" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                        Tanggapan
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="soal">
                                    <div class="card card-table">
                                        <div class="card-body">
                                                <style>
                                                    ol {
                                                        list-style-type: decimal;
                                                        margin-left: 20px;
                                                    }
                                                    ul {
                                                        list-style-type: disc;
                                                        margin-left: 20px;
                                                    }
                                                    li {
                                                        margin-bottom: 10px;
                                                    }
                                                    blockquote {
                                                    margin: 0;
                                                    }

                                                    blockquote p {
                                                    padding: 15px;
                                                    background: #eee;
                                                    border-radius: 5px;
                                                    }

                                                    blockquote p::before {
                                                    content: '\201C';
                                                    }

                                                    blockquote p::after {
                                                    content: '\201D';
                                                    }

                                                </style>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card card-table comman-shadow">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                {!! $tugas->detail !!}

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tanggapan">
                                    <div class="card card-table">
                                        <div class="card-body">
                                            <div class="page-header">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h3 class="page-title">Tanggapan {{$jumlahSudahMengerjakan}}/{{count($siswa)}}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card card-table comman-shadow">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table
                                                                    class="table table-stripped table table-hover table-center mb-0"
                                                                    id="dataList">
                                                                    <thead class="student-thread">
                                                                        <tr>
                                                                            <th>No</th>
                                                                            <th>NISN</th>
                                                                            <th>Nama Siswa</th>
                                                                            <th>Status</th>
                                                                            <th>Nilai</th>
                                                                            <th>Komentar</th>
                                                                            <th class="text-end">Aksi</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($siswa as $index => $value)
                                                                        <tr>
                                                                            <td>{{$index + 1}}</td>
                                                                            <td>{{ $value->nisn }}</td>
                                                                            <td>{{ $value->nama }}</td>
                                                                            <td>{{ $jawaban->get($value->nisn) ? 'Sudah Mengerjakan' : 'Belum Mengerjakan' }}</td>
                                                                            <td>{{ $nilai->get($value->nisn) ? $nilai->get($value->nisn)->nilai : '-' }}</td>
                                                                            <td>{{ $nilai->get($value->nisn) ? $nilai->get($value->nisn)->komentar : '-' }}</td>
                                                                            <td class="text-end">
                                                                                <div class="actions">
                                                                                    @if ($jawaban->get($value->nisn))
                                                                                        <a href="{{url('guru/tugas/view/'.$id.'/edit/'.$value->nisn)}}" class="btn btn-sm bg-danger-light">
                                                                                            <i class="far fa-edit me-2"></i>
                                                                                        </a>
                                                                                    @else
                                                                                        <a href="#" class="btn btn-sm bg-danger-light" disabled>
                                                                                            <i class="far fa-edit me-2-off"></i>
                                                                                        </a>
                                                                                    @endif
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
