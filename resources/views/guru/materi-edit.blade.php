@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Edit Materi</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('guru/materi/edit', ['id' => $materi->id]) }}">Materi</a></li>
                                <li class="breadcrumb-item active">Edit Materi</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('guru/materi/edit_update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informasi Materi
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4" hidden>
                                        <div class="form-group local-forms">
                                            <label>ID <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('id') is-invalid @enderror"
                                                name="id" placeholder="masukkan ID" value="{{ $materi->id }}">
                                            @error('id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nama Materi <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                name="nama" placeholder="Masukkan Nama Materi"
                                                value="{{ $materi->nama }}">
                                            @error('nama')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Deskripsi <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                                name="description" placeholder="Masukkan Deskripsi"
                                                value="{{ $materi->description }}">
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>E-Book <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('ebooks_id') is-invalid @enderror"
                                                name="ebooks_id">
                                                <option selected disabled>Silahkan pilih E-Book </option>
                                                @foreach ($ebook as $value)
                                                    <option
                                                        value="{{ $value->id }}"{{ $materi->ebook_id == $value->id ? 'selected' : '' }}>
                                                        {{ $value->judul }} - {{ $value->guru->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('ebooks_id')
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
