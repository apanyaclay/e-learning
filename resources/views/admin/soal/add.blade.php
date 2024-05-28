@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Tambah Soal</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin/soal', ['id' => $id]) }}">Soal</a></li>
                                <li class="breadcrumb-item active">Tambah Soal</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('admin/soal/add_store', ['id' => $id]) }}" method="POST"
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
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Pertanyaan<span
                                                class="login-danger">*</span></label>
                                        <div class="col-md-10">
                                            <textarea rows="5" cols="5" class="form-control @error('pertanyaan') is-invalid @enderror"
                                                placeholder="Masukkan pertanyaan disini" id="pertanyaan" name="pertanyaan" value="{{ old('pertanyaan') }}"></textarea>
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
                                                value="{{ old('pilihanA') }}">
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
                                                value="{{ old('pilihanB') }}">
                                        </div>
                                        @error('pilihanB')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row" id="pilihanC-row" style="display:none;">
                                        <label class="col-form-label col-md-2">Pilihan C</label>
                                        <div class="col-md-10">
                                            <input type="text"
                                                class="form-control @error('pilihanC') is-invalid @enderror"
                                                placeholder="Pilihan C" id="pilihanC" name="pilihanC"
                                                value="{{ old('pilihanC') }}">
                                        </div>
                                        @error('pilihanC')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row" id="pilihanD-row" style="display:none;">
                                        <label class="col-form-label col-md-2">Pilihan D</label>
                                        <div class="col-md-10">
                                            <input type="text"
                                                class="form-control @error('pilihanD') is-invalid @enderror"
                                                placeholder="Pilihan D" id="pilihanD" name="pilihanD"
                                                value="{{ old('pilihanD') }}">
                                        </div>
                                        @error('pilihanD')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row" id="pilihanE-row" style="display:none;">
                                        <label class="col-form-label col-md-2">Pilihan E</label>
                                        <div class="col-md-10">
                                            <input type="text"
                                                class="form-control @error('pilihanE') is-invalid @enderror"
                                                placeholder="Pilihan E" id="pilihanE" name="pilihanE"
                                                value="{{ old('pilihanE') }}">
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
                                        <div class="col-md-10">
                                            <select
                                                class="form-control form-select @error('kunciJawaban') is-invalid @enderror"
                                                id="kunciJawaban" name="kunciJawaban" value="{{ old('kunciJawaban') }}">
                                                <option>-- Select --</option>
                                                <option value="A" id="kunciJawaban-A" style="display:none;">Pilihan
                                                    A</option>
                                                <option value="B" id="kunciJawaban-B" style="display:none;">Pilihan
                                                    B</option>
                                                <option value="C" id="kunciJawaban-C" style="display:none;">Pilihan
                                                    C</option>
                                                <option value="D" id="kunciJawaban-D" style="display:none;">Pilihan
                                                    D</option>
                                                <option value="E" id="kunciJawaban-E" style="display:none;">Pilihan
                                                    E</option>
                                            </select>
                                        </div>
                                        @error('kunciJawaban')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Bobot<span
                                                class="login-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text"
                                                class="form-control @error('bobot') is-invalid @enderror"
                                                placeholder="Bobot" id="bobot" name="bobot"
                                                value="{{ old('bobot') }}">
                                        </div>
                                        @error('bobot')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentOption = 3; // Start with C

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
            document.getElementById('pilihanA').addEventListener('input', checkOptions);
            document.getElementById('pilihanB').addEventListener('input', checkOptions);
            document.getElementById('pilihanC').addEventListener('input', checkOptions);
            document.getElementById('pilihanD').addEventListener('input', checkOptions);
            document.getElementById('pilihanE').addEventListener('input', checkOptions);
            checkOptions();
        });

        function checkOptions() {
            const pilihanA = document.getElementById('pilihanA').value;
            const pilihanB = document.getElementById('pilihanB').value;
            const pilihanC = document.getElementById('pilihanC').value;
            const pilihanD = document.getElementById('pilihanD').value;
            const pilihanE = document.getElementById('pilihanE').value;

            // Show kunci jawaban options based on input
            if (pilihanA) {
                document.getElementById('kunciJawaban-A').style.display = 'block';
            }
            if (pilihanB) {
                document.getElementById('kunciJawaban-B').style.display = 'block';
            }
            if (pilihanC) {
                document.getElementById('kunciJawaban-C').style.display = 'block';
            }
            if (pilihanD) {
                document.getElementById('kunciJawaban-D').style.display = 'block';
            }
            if (pilihanE) {
                document.getElementById('kunciJawaban-E').style.display = 'block';
            }
        }
    </script>
@endsection
