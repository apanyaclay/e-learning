@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Tambah Jadwal</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin/jadwal') }}">Jadwal</a></li>
                                <li class="breadcrumb-item active">Tambah Jadwal</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('admin/jadwal/add_store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informasi Jadwal
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Kelas <span class="login-danger">*</span></label>
                                            <select class="form-control select  @error('kelas') is-invalid @enderror"
                                                name="kelas">
                                                <option selected disabled>Pilih Kelas</option>
                                                @foreach ($kelas as $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ old('kelas') == $value->id ? 'selected' : '' }}>
                                                        {{ $value->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('kelas')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Jurusan <span class="login-danger">*</span></label>
                                            <select class="form-control select  @error('jurusan') is-invalid @enderror"
                                                name="jurusan">
                                                <option selected disabled>Pilih Jurusan</option>
                                                @foreach ($jurusan as $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ old('jurusan') == $value->id ? 'selected' : '' }}>
                                                        {{ $value->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('jurusan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Mapel <span class="login-danger">*</span></label>
                                            <select class="form-control select  @error('mapel') is-invalid @enderror" id="mapel"
                                                name="mapel">
                                                <option selected disabled>Pilih Mapel</option>
                                                @foreach ($mapel as $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ old('mapel') == $value->id ? 'selected' : '' }}>
                                                        {{ $value->nama }} - {{ $value->guru->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('mapel')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Hari <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('hari') is-invalid @enderror"
                                                name="hari">
                                                <option selected disabled>Silahkan pilih Hari </option>
                                                <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin
                                                </option>
                                                <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>
                                                    Selasa</option>
                                                <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>
                                                    Rabu</option>
                                                <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis
                                                </option>
                                                <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat
                                                </option>
                                                <option value="Sabtu" {{ old('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu
                                                </option>
                                            </select>
                                            @error('hari')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Jam Mulai <span class="login-danger">*</span></label>
                                            <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror"
                                                name="jam_mulai" placeholder="Masukkan Jam Mulai" value="{{ old('jam_mulai') }}">
                                            @error('jam_mulai')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Jam Selesai <span class="login-danger">*</span></label>
                                            <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror"
                                                name="jam_selesai" placeholder="Masukkan Jam Selesai" value="{{ old('jam_selesai') }}">
                                            @error('jam_selesai')
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
            $('#mapel').select2();
        });
    </script>
@endsection
