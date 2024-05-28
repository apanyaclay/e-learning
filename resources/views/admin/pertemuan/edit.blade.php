@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Edit Pertemuan</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin/pertemuan/edit', ['id' => $pertemuan->id]) }}">Pertemuan</a></li>
                                <li class="breadcrumb-item active">Edit Pertemuan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('admin/pertemuan/edit_update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informasi Pertemuan
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4" hidden>
                                        <div class="form-group local-forms">
                                            <label>ID <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('id') is-invalid @enderror"
                                                name="id" placeholder="masukkan ID" value="{{ $pertemuan->id }}">
                                            @error('id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Pertemuan Ke <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('pertemuan') is-invalid @enderror"
                                                name="pertemuan" placeholder="Masukkan Pertemuan Ke"
                                                value="{{ $pertemuan->pertemuan }}">
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
                                            <select class="form-control select @error('materi_id') is-invalid @enderror"
                                                name="materi_id">
                                                <option selected disabled>Silahkan pilih Materi </option>
                                                @foreach ($materi as $value)
                                                    <option
                                                        value="{{ $value->id }}"{{ $pertemuan->materi_id == $value->id ? 'selected' : '' }}>
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
                                            <select class="form-control select @error('jadwal_id') is-invalid @enderror"
                                                name="jadwal_id">
                                                <option selected disabled>Silahkan pilih Jadwal </option>
                                                @foreach ($jadwal as $value)
                                                    <option
                                                        value="{{ $value->id }}"{{ $pertemuan->jadwal_id == $value->id ? 'selected' : '' }}>
                                                        {{ $value->kelas->nama }} - {{ $value->jurusan->nama }} - {{ $value->mataPelajaran->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('jadwal_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">Edit</button>
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
@endsection
