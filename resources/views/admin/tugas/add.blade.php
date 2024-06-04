@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Tambah Tugas</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin/tugas') }}">Kuis</a></li>
                                <li class="breadcrumb-item active">Tambah Tugas</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('admin/tugas/add_store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informasi Tugas
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nama Tugas <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                name="nama" placeholder="Masukkan Nama Tugas"
                                                value="{{ old('nama') }}">
                                            @error('nama')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Tenggat <span class="login-danger">*</span></label>
                                            <input type="datetime-local" class="form-control @error('tenggat') is-invalid @enderror"
                                                name="tenggat" placeholder="Masukkan Tenggat"
                                                value="{{ old('tenggat') }}">
                                            @error('tenggat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Pertemuan <span class="login-danger">*</span></label>
                                            <select class="form-control select  @error('pertemuan_id') is-invalid @enderror" id="pertemuan_id"
                                                name="pertemuan_id">
                                                <option selected disabled>Pertemuan - Kelas - Guru - Mapel - Tanggal</option>
                                                @foreach ($pertemuan as $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ old('pertemuan_id') == $value->id ? 'selected' : '' }}>
                                                        {{ $value->pertemuan }} - {{ $value->jadwal->kelas->nama }} {{ $value->jadwal->jurusan->nama }} - {{ $value->jadwal->mataPelajaran->guru->nama }} - {{ $value->jadwal->mataPelajaran->nama }} - {{ \Carbon\Carbon::parse($value->tanggal)->format('d M Y') }}</option>
                                                @endforeach
                                            </select>
                                            @error('pertemuan_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Detail<span class="login-danger">*</span></label>
                                            <textarea class="form-control @error('detail') is-invalid @enderror" name="detail" id="editor">{{ old('detail') }}</textarea>
                                            @error('detail')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#guru_nuptk, #pertemuan_id').select2();
        });
    </script>
@endsection
