@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Tambah Mata Pelajaran</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin/mapel') }}">Mata Pelajaran</a></li>
                                <li class="breadcrumb-item active">Tambah Mata Pelajaran</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('admin/mapel/add_store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informasi Mata Pelajaran
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nama Mata Pelajaran <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                name="nama" placeholder="Masukkan Nama Mata Pelajaran"
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
                                            <label>KKM <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('kkm') is-invalid @enderror"
                                                name="kkm" placeholder="Masukkan KKM" value="{{ old('kkm') }}">
                                            @error('kkm')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Guru <span class="login-danger">*</span></label>
                                            <select class="form-control select  @error('guru_nuptk') is-invalid @enderror"
                                                name="guru_nuptk">
                                                <option selected disabled>Pilih Guru</option>
                                                @foreach ($guru as $value)
                                                    <option value="{{ $value->nuptk }}"
                                                        {{ old('guru_nuptk') == $value->nuptk ? 'selected' : '' }}>
                                                        {{ $value->nuptk }} - {{ $value->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('guru_nuptk')
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
@endsection
