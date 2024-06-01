@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Tambah Absensi</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin/absensi') }}">Absensi</a></li>
                                <li class="breadcrumb-item active">Tambah Absensi</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('admin/absensi/add_store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informasi Absensi
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Siswa <span class="login-danger">*</span></label>
                                            <select class="form-control select  @error('siswa_nisn') is-invalid @enderror" id="siswa_nisn"
                                                name="siswa_nisn">
                                                <option selected disabled>Pilih Siswa</option>
                                                @foreach ($siswa as $value)
                                                    <option value="{{ $value->nisn }}"
                                                        {{ old('siswa_nisn') == $value->nisn ? 'selected' : '' }}>
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
                                            <select class="form-control select  @error('pertemuan_id') is-invalid @enderror" id="pertemuan_id"
                                                name="pertemuan_id">
                                                <option selected disabled>Pertemuan - Kelas - Jurusan - Mapel - Tanggal</option>
                                                @foreach ($pertemuan as $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ old('pertemuan_id') == $value->id ? 'selected' : '' }}>
                                                        {{ $value->pertemuan }} - {{ $value->jadwal->kelas->nama }} - {{ $value->jadwal->jurusan->nama }} - {{ $value->jadwal->mataPelajaran->nama }} - {{  \Carbon\Carbon::parse($value->tanggal)->format('d M Y') }}</option>
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
                                                <option value="Hadir" {{ old('status') == 'Hadir' ? 'selected' : '' }}>Hadir
                                                </option>
                                                <option value="Sakit" {{ old('status') == 'Sakit' ? 'selected' : '' }}>
                                                    Sakit</option>
                                                <option value="Izin" {{ old('status') == 'Izin' ? 'selected' : '' }}>
                                                    Izin</option>
                                                <option value="Alpa" {{ old('status') == 'Alpa' ? 'selected' : '' }}>Alpa
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
                                            <label>Keterangan</label>
                                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                                name="keterangan" placeholder="Masukkan Keterangan"
                                                value="{{ old('keterangan') }}">
                                            @error('keterangan')
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
            $('#siswa_nisn, #pertemuan_id').select2();
        });
    </script>
@endsection
