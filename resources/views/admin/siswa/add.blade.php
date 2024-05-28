@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Tambah Siswa</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin/siswa')}}">Siswa</a></li>
                                <li class="breadcrumb-item active">Tambah Siswa</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('admin/siswa/add_store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informasi Siswa
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>NISN <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" placeholder="masukkan NISN" value="{{ old('nisn') }}">
                                            @error('nisn')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nama Lengkap <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" name="nama_siswa" placeholder="Masukkan Nama Lengkap" value="{{ old('nama_siswa') }}">
                                            @error('nama_siswa')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Jenis Kelamin <span class="login-danger">*</span></label>
                                            <select class="form-control select  @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                                                <option selected disabled>Pilih Jenis Kelamin</option>
                                                <option value="P" {{ old('jenis_kelamin') == 'P' ? "selected" :"P"}}>Perempuan</option>
                                                <option value="L" {{ old('jenis_kelamin') == 'L' ? "selected" :""}}>Laki-Laki</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>E-Mail <span class="login-danger">*</span></label>
                                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" placeholder="Enter Email Address" value="{{ old('email') }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Tanggal Lahir <span class="login-danger">*</span></label>
                                            <input class="form-control datetimepicker @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" type="text" placeholder="DD-MM-YYYY" value="{{ old('tanggal_lahir') }}">
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
                                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" value="{{ old('tempat_lahir') }}">
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
                                            <select class="form-control select @error('agama') is-invalid @enderror" name="agama">
                                                <option selected disabled>Silahkan pilih Agama </option>
                                                <option value="Hindu" {{ old('agama') == 'Hindu' ? "selected" :""}}>Hindu</option>
                                                <option value="Kristen" {{ old('agama') == 'Kristen' ? "selected" :""}}>Kristen</option>
                                                <option value="Katolik" {{ old('agama') == 'Katolik' ? "selected" :""}}>Katolik</option>
                                                <option value="Islam" {{ old('agama') == 'Islam' ? "selected" :""}}>Islam</option>
                                                <option value="Budha" {{ old('agama') == 'Budha' ? "selected" :""}}>Budha</option>
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
                                            <label>Kelas <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('kelas_id') is-invalid @enderror" name="kelas_id">
                                                <option selected disabled>Silahkan pilih Kelas </option>
                                                @foreach ($kelas as $value)
                                                <option value="{{$value->id}}" {{ old('kelas_id') == $value->id ? "selected" :""}}>{{$value->nama}}</option>
                                                @endforeach
                                            </select>
                                            @error('kelas_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Jurusan <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('jurusan_id') is-invalid @enderror" name="jurusan_id">
                                                <option selected disabled>Silahkan pilih Jurusan </option>
                                                @foreach ($jurusan as $value)
                                                <option value="{{$value->id}}" {{ old('jurusan_id') == $value->id ? "selected" :""}}>{{$value->nama}}</option>
                                                @endforeach
                                            </select>
                                            @error('jurusan_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Alamat <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Masukkan Alamat" value="{{ old('alamat') }}">
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
                                                <label class="file-upload image-upbtn mb-0 @error('upload') is-invalid @enderror">
                                                    Pilih File <input type="file" name="upload">
                                                </label>
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
