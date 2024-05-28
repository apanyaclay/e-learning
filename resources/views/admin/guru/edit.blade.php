@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Edit Guru</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin/guru/edit', ['id' => $guru->nuptk]) }}">Guru</a></li>
                                <li class="breadcrumb-item active">Edit Guru</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('admin/guru/edit_update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informasi Guru
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>NUPTK <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('nuptk') is-invalid @enderror"
                                                name="nuptk" placeholder="masukkan NUPTK" value="{{ $guru->nuptk }}">
                                            @error('nuptk')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nama Lengkap <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                name="nama" placeholder="Masukkan Nama Lengkap"
                                                value="{{ $guru->nama }}">
                                            @error('nama')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Jenis Kelamin <span class="login-danger">*</span></label>
                                            <select
                                                class="form-control select  @error('jenis_kelamin') is-invalid @enderror"
                                                name="jenis_kelamin">
                                                <option selected disabled>Select Jenis Kelamin</option>
                                                <option value="P" {{ $guru->jenis_kelamin == 'P' ? 'selected' : 'P' }}>
                                                    Perempuan</option>
                                                <option value="L" {{ $guru->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                                    Laki-Laki</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Tanggal Lahir <span class="login-danger">*</span></label>
                                            <input
                                                class="form-control datetimepicker @error('tanggal_lahir') is-invalid @enderror"
                                                name="tanggal_lahir" type="text" placeholder="DD-MM-YYYY"
                                                value="{{ $guru->tanggal_lahir }}">
                                            @error('tanggal_lahir')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Tempat Lahir <span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                name="tempat_lahir" placeholder="Masukkan Tempat Lahir"
                                                value="{{ $guru->tempat_lahir }}">
                                            @error('tempat_lahir')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Agama <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('agama') is-invalid @enderror"
                                                name="agama">
                                                <option selected disabled>Silahkan pilih Agama </option>
                                                <option value="Hindu" {{ $guru->agama == 'Hindu' ? 'selected' : '' }}>
                                                    Hindu
                                                </option>
                                                <option value="Kristen" {{ $guru->agama == 'Kristen' ? 'selected' : '' }}>
                                                    Kristen</option>
                                                <option value="Katolik" {{ $guru->agama == 'Katolik' ? 'selected' : '' }}>
                                                    Katolik</option>
                                                <option value="Islam" {{ $guru->agama == 'Islam' ? 'selected' : '' }}>
                                                    Islam
                                                </option>
                                                <option value="Budha" {{ $guru->agama == 'Budha' ? 'selected' : '' }}>
                                                    Budha
                                                </option>
                                            </select>
                                            @error('agama')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>No HP <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                                name="no_hp" placeholder="Masukkan No HP" value="{{ $guru->no_hp }}">
                                            @error('no_hp')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Alamat <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                                name="alamat" placeholder="Masukkan Alamat" value="{{ $guru->alamat }}">
                                            @error('alamat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group students-up-files">
                                            <label>Unggah foto siswa (150px X 150px)</label>
                                            <div class="uplod">
                                                <h2 class="table-avatar">
                                                    <a class="avatar avatar-sm me-2">
                                                        <img class="avatar-img rounded-circle"
                                                            src="{{ Storage::url('foto/' . $guru->foto) }}"
                                                            alt="User Image">
                                                    </a>
                                                </h2>
                                                <label
                                                    class="file-upload image-upbtn mb-0 @error('upload') is-invalid @enderror">
                                                    Pilih File <input type="file" name="upload">
                                                </label>
                                                <input type="hidden" name="image_hidden" value="{{ $guru->foto }}">
                                                @error('upload')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
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
