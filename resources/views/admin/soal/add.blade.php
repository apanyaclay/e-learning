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
                            <form action="{{ route('admin/soal/add_store', ['id' => $id]) }}" method="POST" enctype="multipart/form-data">
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
                                        <label class="col-form-label col-md-2">Pertanyaan</label>
                                        <div class="col-md-10">
                                            <textarea rows="5" cols="5" class="form-control"
                                                placeholder="Masukkan pertanyaan disini" id="pertanyaan" name="pertanyaan"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Pilihan A</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" placeholder="Pilihan A" id="pilihanA" name="pilihanA">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Pilihan B</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" placeholder="Pilihan B" id="pilihanB" name="pilihanB">
                                        </div>
                                    </div>
                                    <div class="form-group row" id="pilihanC-row" style="display:none;">
                                        <label class="col-form-label col-md-2">Pilihan C</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" placeholder="Pilihan C" id="pilihanC" name="pilihanC">
                                        </div>
                                    </div>
                                    <div class="form-group row" id="pilihanD-row" style="display:none;">
                                        <label class="col-form-label col-md-2">Pilihan D</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" placeholder="Pilihan D" id="pilihanD" name="pilihanD">
                                        </div>
                                    </div>
                                    <div class="form-group row" id="pilihanE-row" style="display:none;">
                                        <label class="col-form-label col-md-2">Pilihan E</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" placeholder="Pilihan E" id="pilihanE" name="pilihanE">
                                        </div>
                                    </div>
                                    <div class="form-group row" id="add-option-row">
                                        <div class="col-md-10 offset-md-2">
                                            <button type="button" class="btn btn-primary" id="add-option-btn">+</button>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">File Input</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="file" id="fileInput" name="fileInput">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Kunci Jawaban</label>
                                        <div class="col-md-10">
                                            <select class="form-control form-select" id="kunciJawaban" name="kunciJawaban">
                                                <option>-- Select --</option>
                                                <option value="A" id="kunciJawaban-A" style="display:none;">Pilihan A</option>
                                                <option value="B" id="kunciJawaban-B" style="display:none;">Pilihan B</option>
                                                <option value="C" id="kunciJawaban-C" style="display:none;">Pilihan C</option>
                                                <option value="D" id="kunciJawaban-D" style="display:none;">Pilihan D</option>
                                                <option value="E" id="kunciJawaban-E" style="display:none;">Pilihan E</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nama Kelas <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                name="nama" placeholder="Masukkan Nama Kelas"
                                                value="{{ old('nama') }}">
                                            @error('nama')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}
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
        document.addEventListener('DOMContentLoaded', function () {
            let currentOption = 3; // Start with C

            document.getElementById('add-option-btn').addEventListener('click', function () {
                if (currentOption > 5) return; // Max 5 options (A to E)

                const row = document.getElementById('pilihan' + String.fromCharCode(64 + currentOption) + '-row');
                if (row) {
                    row.style.display = 'flex';
                    currentOption++;
                }

                if (currentOption > 5) {
                    document.getElementById('add-option-row').style.display = 'none';
                }
            });
            checkOptions();
        });
        function checkOptions() {
            const pilihanA = document.getElementById('pilihanA').value;
            const pilihanB = document.getElementById('pilihanB').value;
            const pilihanC = document.getElementById('pilihanC').value;
            const pilihanD = document.getElementById('pilihanD').value;
            const pilihanE = document.getElementById('pilihanE').value;

            // Reset display of all kunci jawaban options
            document.getElementById('kunciJawaban-A').style.display = 'none';
            document.getElementById('kunciJawaban-B').style.display = 'none';
            document.getElementById('kunciJawaban-C').style.display = 'none';
            document.getElementById('kunciJawaban-D').style.display = 'none';
            document.getElementById('kunciJawaban-E').style.display = 'none';

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
