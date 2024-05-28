@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Edit Soal</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin/soal', ['id' => $id]) }}">Soal</a></li>
                                <li class="breadcrumb-item active">Edit Soal</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('admin/soal/edit_update', ['id' => $id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informasi Soal
                                            <span>
                                                <a href="javascript:;"><i class="fe fe-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="form-group row" hidden>
                                        <label class="col-form-label col-md-2">ID<span class="login-danger">*</span></label>
                                        <div class="col-md-10">
                                            <textarea rows="5" cols="5" class="form-control @error('id') is-invalid @enderror"
                                                placeholder="Masukkan ID disini" id="id" name="id">{{ $soal->id }}</textarea>
                                        </div>
                                        @error('id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Pertanyaan<span
                                                class="login-danger">*</span></label>
                                        <div class="col-md-10">
                                            <textarea rows="5" cols="5" class="form-control @error('pertanyaan') is-invalid @enderror"
                                                placeholder="Masukkan pertanyaan disini" id="pertanyaan" name="pertanyaan">{{ $soal->pertanyaan }}</textarea>
                                        </div>
                                        @error('pertanyaan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Pilihan A<span
                                                class="login-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text"
                                                class="form-control @error('pilihanA') is-invalid @enderror"
                                                placeholder="Pilihan A" id="pilihanA" name="pilihanA"
                                                value="{{ $soal->opsi_a }}">
                                        </div>
                                        @error('pilihanA')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Pilihan B<span
                                                class="login-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text"
                                                class="form-control @error('pilihanB') is-invalid @enderror"
                                                placeholder="Pilihan B" id="pilihanB" name="pilihanB"
                                                value="{{ $soal->opsi_b }}">
                                        </div>
                                        @error('pilihanB')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row" id="pilihanC-row"
                                        @if (!$soal->opsi_c) style="display:none;" @endif>
                                        <label class="col-form-label col-md-2">Pilihan C</label>
                                        <div class="col-md-10">
                                            <input type="text"
                                                class="form-control @error('pilihanC') is-invalid @enderror"
                                                placeholder="Pilihan C" id="pilihanC" name="pilihanC"
                                                value="{{ $soal->opsi_c }}">
                                        </div>
                                        @error('pilihanC')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row" id="pilihanD-row"
                                        @if (!$soal->opsi_d) style="display:none;" @endif>
                                        <label class="col-form-label col-md-2">Pilihan D</label>
                                        <div class="col-md-10">
                                            <input type="text"
                                                class="form-control @error('pilihanD') is-invalid @enderror"
                                                placeholder="Pilihan D" id="pilihanD" name="pilihanD"
                                                value="{{ $soal->opsi_d }}">
                                        </div>
                                        @error('pilihanD')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row" id="pilihanE-row"
                                        @if (!$soal->opsi_e) style="display:none;" @endif>
                                        <label class="col-form-label col-md-2">Pilihan E</label>
                                        <div class="col-md-10">
                                            <input type="text"
                                                class="form-control @error('pilihanE') is-invalid @enderror"
                                                placeholder="Pilihan E" id="pilihanE" name="pilihanE"
                                                value="{{ $soal->opsi_e }}">
                                        </div>
                                        @error('pilihanE')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row" id="add-option-row">
                                        <div class="col-md-10 offset-md-2">
                                            <button type="button" class="btn btn-primary" id="add-option-btn">+</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="fileInput_hidden" value="{{ $soal->foto }}">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">File Input</label>
                                        <div class="col-md-10">
                                            <input class="form-control @error('fileInput') is-invalid @enderror"
                                                type="file" id="fileInput" name="fileInput">
                                        </div>
                                        @error('fileInput')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Kunci Jawaban<span
                                                class="login-danger">*</span></label>
                                        @error('kunciJawaban')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="col-md-10">
                                            <select
                                                class="form-control form-select @error('kunciJawaban') is-invalid @enderror"
                                                id="kunciJawaban" name="kunciJawaban">
                                                <option value="">-- Select --</option>
                                                <option value="A" id="kunciJawaban-A"
                                                    {{ $soal->opsi_benar == 'A' ? 'selected' : '' }}>Pilihan A</option>
                                                <option value="B" id="kunciJawaban-B"
                                                    {{ $soal->opsi_benar == 'B' ? 'selected' : '' }}>Pilihan B</option>
                                                <option value="C" id="kunciJawaban-C"
                                                    {{ $soal->opsi_benar == 'C' ? 'selected' : '' }}>Pilihan C</option>
                                                <option value="D" id="kunciJawaban-D"
                                                    {{ $soal->opsi_benar == 'D' ? 'selected' : '' }}>Pilihan D</option>
                                                <option value="E" id="kunciJawaban-E"
                                                    {{ $soal->opsi_benar == 'E' ? 'selected' : '' }}>Pilihan E</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Bobot<span
                                                class="login-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text"
                                                class="form-control @error('bobot') is-invalid @enderror"
                                                placeholder="Bobot" id="bobot" name="bobot"
                                                value="{{ $soal->bobot }}">
                                        </div>
                                        @error('bobot')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentOption = 3; // Start with C

            // Show options based on existing values
            if (document.getElementById('pilihanC').value) {
                document.getElementById('pilihanC-row').style.display = 'flex';
                currentOption = 4;
            }
            if (document.getElementById('pilihanD').value) {
                document.getElementById('pilihanD-row').style.display = 'flex';
                currentOption = 5;
            }
            if (document.getElementById('pilihanE').value) {
                document.getElementById('pilihanE-row').style.display = 'flex';
                currentOption = 6; // No more options to add
                document.getElementById('add-option-row').style.display = 'none';
            }

            document.getElementById('add-option-btn').addEventListener('click', function() {
                if (currentOption > 5) return; // Max 5 options (A to E)

                const row = document.getElementById('pilihan' + String.fromCharCode(64 + currentOption) +
                    '-row');
                if (row) {
                    row.style.display = 'flex';
                    currentOption++;
                }

                if (currentOption > 5) {
                    document.getElementById('add-option-row').style.display = 'none';
                }
            });
        });
    </script>
@endsection
