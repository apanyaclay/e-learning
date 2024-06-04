@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Edit Tahun Ajaran</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin/ta/edit', ['id' => $ta->id]) }}">Tahun Ajaran</a></li>
                                <li class="breadcrumb-item active">Edit Tahun Ajaran</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('admin/ta/edit_update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informasi Tahun Ajaran
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4" hidden>
                                        <div class="form-group local-forms">
                                            <label>ID <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('id') is-invalid @enderror"
                                                name="id" placeholder="masukkan ID" value="{{ $ta->id }}">
                                            @error('id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Tahun Ajaran <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror"
                                                name="tahun_ajaran" placeholder="Masukkan Tahun Ajaran"
                                                value="{{ $ta->tahun_ajaran }}">
                                            @error('tahun_ajaran')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Semester <span class="login-danger">*</span></label>
                                            <select
                                                class="form-control select  @error('semester') is-invalid @enderror"
                                                name="semester">
                                                <option selected disabled>Pilih Semester</option>
                                                <option value="Ganjil"
                                                    {{ $ta->semester == 'Ganjil' ? 'selected' : 'Ganjil' }}>
                                                    Ganjil</option>
                                                <option value="Genap"
                                                    {{ $ta->semester == 'Genap' ? 'selected' : '' }}>
                                                    Genap</option>
                                            </select>
                                            @error('semester')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Tanggal Mulai <span class="login-danger">*</span></label>
                                            <input
                                                class="form-control datetimepicker @error('tanggal_mulai') is-invalid @enderror"
                                                name="tanggal_mulai" type="text" placeholder="DD-MM-YYYY"
                                                value="{{ \Carbon\Carbon::parse($ta->tanggal_mulai)->format('d-m-Y') }}">
                                            @error('tanggal_mulai')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Tanggal Selesai <span class="login-danger">*</span></label>
                                            <input
                                                class="form-control datetimepicker @error('tanggal_selesai') is-invalid @enderror"
                                                name="tanggal_selesai" type="text" placeholder="DD-MM-YYYY"
                                                value="{{ \Carbon\Carbon::parse($ta->tanggal_selesai)->format('d-m-Y') }}">
                                            @error('tanggal_selesai')
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
