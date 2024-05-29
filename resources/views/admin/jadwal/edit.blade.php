@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Edit Jadwal</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin/jadwal/edit', ['id' => $jadwal->id]) }}">Jadwal</a></li>
                                <li class="breadcrumb-item active">Edit Jadwal</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('admin/jadwal/edit_update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informasi Jadwal
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4" hidden>
                                        <div class="form-group local-forms">
                                            <label>ID <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('id') is-invalid @enderror"
                                                name="id" placeholder="masukkan ID" value="{{ $jadwal->id }}">
                                            @error('id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Kelas <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('kelas') is-invalid @enderror"
                                                name="kelas">
                                                <option selected disabled>Silahkan pilih Kelas </option>
                                                @foreach ($kelas as $value)
                                                    <option
                                                        value="{{ $value->id }}"{{ $jadwal->kelas_id == $value->id ? 'selected' : '' }}>
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
                                            <select class="form-control select @error('jurusan') is-invalid @enderror"
                                                name="jurusan">
                                                <option selected disabled>Silahkan pilih Jurusan </option>
                                                @foreach ($jurusan as $value)
                                                    <option
                                                        value="{{ $value->id }}"{{ $jadwal->jurusan_id == $value->id ? 'selected' : '' }}>
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
                                            <select class="form-control select @error('mapel') is-invalid @enderror"
                                                name="mapel">
                                                <option selected disabled>Silahkan pilih Mapel </option>
                                                @foreach ($mapel as $value)
                                                    <option
                                                        value="{{ $value->id }}"{{ $jadwal->mata_pelajaran_id == $value->id ? 'selected' : '' }}>
                                                        {{ $value->nama }}</option>
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
                                                <option value="Senin" {{ $jadwal->hari == 'Senin' ? 'selected' : '' }}>Senin
                                                </option>
                                                <option value="Selasa" {{ $jadwal->hari == 'Selasa' ? 'selected' : '' }}>
                                                    Selasa</option>
                                                <option value="Rabu" {{ $jadwal->hari == 'Rabu' ? 'selected' : '' }}>
                                                    Rabu</option>
                                                <option value="Kamis" {{ $jadwal->hari == 'Kamis' ? 'selected' : '' }}>Kamis
                                                </option>
                                                <option value="Jumat" {{ $jadwal->hari == 'Jumat' ? 'selected' : '' }}>Jumat
                                                </option>
                                                <option value="Sabtu" {{ $jadwal->hari == 'Sabtu' ? 'selected' : '' }}>Sabtu
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
                                                name="jam_mulai" placeholder="Masukkan Jam Mulai"
                                                value="{{ $jadwal->jam_mulai }}">
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
                                                name="jam_selesai" placeholder="Masukkan Jam Selesai"
                                                value="{{ $jadwal->jam_selesai }}">
                                            @error('jam_selesai')
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
