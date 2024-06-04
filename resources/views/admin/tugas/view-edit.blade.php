@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Edit Tugas</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin/tugas/view/edit', ['id' => $id, 'nisn' => $nisn]) }}">Kuis</a></li>
                                <li class="breadcrumb-item active">Edit Tugas</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('admin/tugas/view/edit_store', ['nisn'=> $nisn]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informasi Tugas
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4" hidden>
                                        <div class="form-group local-forms">
                                            <label>ID <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('id') is-invalid @enderror"
                                                name="id" placeholder="masukkan ID" value="{{ $id }}">
                                            @error('id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nilai <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('nilai') is-invalid @enderror"
                                                name="nilai" placeholder="Masukkan Nilai"
                                                value="{{ $nilai }}">
                                            @error('nilai')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Komentar</label>
                                            <input type="text" class="form-control @error('komentar') is-invalid @enderror"
                                                name="komentar" placeholder="Masukkan Komentar"
                                                value="{{ $komentar }}">
                                            @error('komentar')
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
