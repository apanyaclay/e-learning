@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Tambah Pertemuan</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin/pertemuan') }}">Pertemuan</a></li>
                                <li class="breadcrumb-item active">Tambah Pertemuan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('admin/pertemuan/add_store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informasi Pertemuan
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Pertemuan Ke <span class="login-danger">*</span></label>
                                            <input type="number" class="form-control @error('pertemuan') is-invalid @enderror"
                                                name="pertemuan" placeholder="Masukkan Pertemuan Ke"
                                                value="{{ old('pertemuan') }}">
                                            @error('pertemuan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Materi <span class="login-danger">*</span></label>
                                            <select class="form-control select  @error('materi_id') is-invalid @enderror" id="materi_id"
                                                name="materi_id">
                                                <option selected disabled>Judul E-Book - Nama Materi - Nama Guru</option>
                                                @foreach ($materi as $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ old('materi_id') == $value->id ? 'selected' : '' }}>
                                                        {{ $value->ebook->judul }} - {{ $value->nama }} - {{ $value->ebook->guru->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('materi_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Jadwal <span class="login-danger">*</span></label>
                                            <select class="form-control select  @error('jadwal_id') is-invalid @enderror" id="jadwal_id"
                                                name="jadwal_id">
                                                <option selected disabled>Pilih Jadwal</option>
                                                @foreach ($jadwal as $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ old('jadwal_id') == $value->id ? 'selected' : '' }}>
                                                        {{ $value->kelas->nama }} - {{ $value->jurusan->nama }} - {{ $value->mataPelajaran->guru->nama }} - {{ $value->mataPelajaran->nama }} - {{ $value->hari }}</option>
                                                @endforeach
                                            </select>
                                            @error('jadwal_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Tanggal <span class="login-danger">*</span></label>
                                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                                name="tanggal" placeholder="Masukkan Tanggal"
                                                value="{{ old('tanggal') }}">
                                            @error('tanggal')
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
            $('#jadwal_id, #materi_id').select2();
        });
    </script>
@endsection
