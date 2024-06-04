@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Soal</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Soal</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Bobot {{$bobot}}/100</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="{{ route('admin/soal/add') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card-table comman-shadow">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-stripped table table-hover table-center mb-0"
                                                    id="dataList">
                                                    <thead class="student-thread">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Foto</th>
                                                            <th>Pertanyaan</th>
                                                            <th>Kunci Jawaban</th>
                                                            <th>Bobot</th>
                                                            <th class="text-end">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($soal as $index => $value)
                                                        <tr>
                                                            <td>{{$index + 1}}</td>
                                                            <td>{{ $value['foto'] }}</td>
                                                            <td>{{ $value['pertanyaan'] }}</td>
                                                            <td>{{ $value['opsi_benar'] }}</td>
                                                            <td>{{ $value['bobot'] }}</td>
                                                            <td class="text-end">
                                                                <div class="actions">
                                                                    <a href="{{url('admin/soal/edit/'.$value['id'])}}" class="btn btn-sm bg-danger-light">
                                                                        <i class="far fa-edit me-2"></i>
                                                                    </a>
                                                                    <a class="btn btn-sm bg-danger-light delete data_id" data-bs-toggle="modal" data-id="{{$value['id']}}" data-bs-target="#delete">
                                                                    <i class="fe fe-trash-2"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- model elete --}}
    <div class="modal custom-modal fade" id="delete" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Hapus Data</h3>
                        <p>Apakah Anda yakin ingin menghapus?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <form action="{{ route('admin/soal/delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <div class="row">
                                    <div class="col-6">
                                        <a data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn">Batal
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary paid-continue-btn"
                                            style="width: 100%;">Hapus</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('script')
    {{-- delete js --}}
    <script>
        $(document).on('click', '.delete', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.data_id').data('id'));
        });
    </script>
@endsection

@endsection
