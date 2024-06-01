@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Edit Absensi</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin/absensi/edit', ['id' => $absensi->id]) }}">Absensi</a></li>
                                <li class="breadcrumb-item active">Edit Absensi</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('admin/absensi/edit_update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informasi Absensi
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4" hidden>
                                        <div class="form-group local-forms">
                                            <label>ID <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('id') is-invalid @enderror"
                                                name="id" placeholder="masukkan ID" value="{{ $absensi->id }}">
                                            @error('id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Siswa <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('siswa_nisn') is-invalid @enderror"
                                                name="siswa_nisn">
                                                <option selected disabled>Silahkan pilih Siswa </option>
                                                @foreach ($siswa as $value)
                                                    <option
                                                        value="{{ $value->nisn }}"{{ $absensi->siswa_nisn == $value->nisn ? 'selected' : '' }}>
                                                        {{ $value->nisn }} - {{ $value->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('siswa_nisn')
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
                                                        value="{{ $value->id }}"{{ $absensi->pertemuan_id == $value->id ? 'selected' : '' }}>
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
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Status <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('status') is-invalid @enderror"
                                                name="status">
                                                <option selected disabled>Silahkan pilih Status </option>
                                                <option value="Hadir" {{ $absensi->status == 'Hadir' ? 'selected' : '' }}>Hadir
                                                </option>
                                                <option value="Sakit" {{ $absensi->status == 'Sakit' ? 'selected' : '' }}>
                                                    Sakit</option>
                                                <option value="Izin" {{ $absensi->status == 'Izin' ? 'selected' : '' }}>
                                                    Izin</option>
                                                <option value="Alpa" {{ $absensi->status == 'Alpa' ? 'selected' : '' }}>Alpa
                                                </option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>keterangan</label>
                                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                                name="keterangan" placeholder="Masukkan keterangan"
                                                value="{{ $absensi->keterangan }}">
                                            @error('keterangan')
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#siswa_nisn').select2();
        });
    </script>
@endsection
