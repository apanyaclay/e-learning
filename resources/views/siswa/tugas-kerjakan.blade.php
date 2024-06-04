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
                            <h4 class="mb-4">Detail Tugas</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Nama Kuis:</strong>
                                    <p>{{ $tugas->nama }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Tenggat Waktu:</strong>
                                    <p>{{ \Carbon\Carbon::parse($tugas->tenggat)->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                            @if ($nilai)
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <strong>Nilai:</strong>
                                        <p>{{ $nilai->nilai }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Komentar:</strong>
                                        <p>{{ $nilai->komentar }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <h4 class="mb-4">Soal</h4>
                            <div class="row mb-3">
                                <div class="col-md-12">
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
                                    {!! $tugas->detail !!}
                                </div>
                                <h4 class="mb-4">Jawab</h4>
                                @if ($jawaban)
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <strong>Jawaban yang sudah ada:</strong>
                                            <p><a href="{{ Storage::url('tugas/' . $jawaban->jawaban) }}"
                                                    download>{{ $jawaban->jawaban }}</a></p>
                                        </div>
                                    </div>
                                @else
                                    @if (\Carbon\Carbon::now() < \Carbon\Carbon::parse($tugas->tenggat))
                                        <form action="{{ route('siswa/tugas/kerjakan_store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $tugas->id }}">
                                            <input type="file" name="jawaban" id="jawaban" required>
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary"
                                                    id="submitButton">Submit</button>
                                            </div>
                                        </form>
                                    @else
                                        Waktu Pengerjaan Sudah Berakhir
                                        @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
