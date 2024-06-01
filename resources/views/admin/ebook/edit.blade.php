@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Edit E-Book</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('guru/ebook/edit', ['id' => $ebook->id]) }}">E-Book</a></li>
                                    <li class="breadcrumb-item active">Edit E-Book</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card comman-shadow">
                            <div class="card-body">
                                <form action="{{ route('guru/ebook/edit_update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title student-info">Informasi E-Book
                                                <span>
                                                    <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                                </span>
                                            </h5>
                                        </div>
                                        <div class="col-12 col-sm-4" hidden>
                                            <div class="form-group local-forms">
                                                <label>ID <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control @error('id') is-invalid @enderror"
                                                    name="id" placeholder="masukkan ID" value="{{ $ebook->id }}">
                                                @error('id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Judul <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                                    name="judul" placeholder="Masukkan Judul"
                                                    value="{{ $ebook->judul }}">
                                                @error('judul')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group students-up-files">
                                                <label>Unggah file e-book (.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.rtf)</label>
                                                <div class="uplod">
                                                    <label
                                                        class="file-upload image-upbtn mb-0 @error('upload') is-invalid @enderror">
                                                        Pilih File <input type="file" name="upload" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.rtf">
                                                    </label>
                                                    <input type="hidden" name="upload_hidden" value="{{ $ebook->file }}" >
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
    </div>
@endsection
