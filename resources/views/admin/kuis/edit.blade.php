@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Edit Kuis</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin/kuis/edit', ['id' => $kuis->id]) }}">Kuis</a></li>
                                <li class="breadcrumb-item active">Edit Kuis</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('admin/kuis/edit_update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informasi Kuis
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4" hidden>
                                        <div class="form-group local-forms">
                                            <label>ID <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('id') is-invalid @enderror"
                                                name="id" placeholder="masukkan ID" value="{{ $kuis->id }}">
                                            @error('id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nama Kuis <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                name="nama" placeholder="Masukkan Nama Kuis"
                                                value="{{ $kuis->nama }}">
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
                                                value="{{ $kuis->tenggat }}">
                                            @error('tenggat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Durasi <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('durasi') is-invalid @enderror"
                                                name="durasi" placeholder="Masukkan Durasi"
                                                value="{{ $kuis->durasi }}">
                                            @error('durasi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Guru <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('guru_nuptk') is-invalid @enderror"
                                                name="guru_nuptk">
                                                <option selected disabled>Silahkan pilih Guru </option>
                                                @foreach ($guru as $value)
                                                    <option
                                                        value="{{ $value->nuptk }}"{{ $kuis->guru_nuptk == $value->nuptk ? 'selected' : '' }}>
                                                        {{ $value->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('guru_nuptk')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Pertemuan <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('pertemuan_id') is-invalid @enderror"
                                                name="pertemuan_id">
                                                <option selected disabled>Silahkan pilih Pertemuan </option>
                                                @foreach ($pertemuan as $value)
                                                    <option
                                                        value="{{ $value->id }}"{{ $kuis->pertemuan_id == $value->id ? 'selected' : '' }}>
                                                        {{ $value->pertemuan }} - {{ $value->jadwal->kelas->nama }} - {{ $value->jadwal->jurusan->nama }} - {{ $value->created_at->format('d M Y') }}</option>
                                                @endforeach
                                            </select>
                                            @error('pertemuan_id')
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