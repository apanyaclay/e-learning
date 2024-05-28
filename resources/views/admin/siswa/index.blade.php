@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Siswa</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Siswa</li>
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
                                        <h3 class="page-title">Siswa</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="#" class="btn btn-outline-primary me-2">
                                            <i class="fas fa-download"></i> Unduh
                                        </a>
                                        <a href="{{ route('admin/siswa/add') }}" class="btn btn-primary">
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
                                                            <th>NISN</th>
                                                            <th>Nama</th>
                                                            <th>Kelas</th>
                                                            <th>Jurusan</th>
                                                            <th>Jenis Kelamin</th>
                                                            <th>Tanggal Lahir</th>
                                                            <th>Tempat Lahir</th>
                                                            <th>Agama</th>
                                                            <th>Alamat</th>
                                                            <th class="text-end">Aksi</th>
                                                        </tr>
                                                    </thead>
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
                            <form action="{{ route('admin/siswa/delete') }}" method="POST">
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: true,
                ajax: {
                    url: "{{ route('admin/siswa/data') }}",
                },
                columns: [{
                        data: 'nisn',
                        name: 'nisn',
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                    },
                    {
                        data: 'kelas_id',
                        name: 'kelas_id',
                    },
                    {
                        data: 'jurusan_id',
                        name: 'jurusan_id',
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin',
                    },
                    {
                        data: 'tanggal_lahir',
                        name: 'tanggal_lahir',
                    },
                    {
                        data: 'tempat_lahir',
                        name: 'tempat_lahir',
                    },
                    {
                        data: 'agama',
                        name: 'agama',
                    },
                    {
                        data: 'alamat',
                        name: 'alamat',
                    },
                    {
                        data: 'modify',
                        name: 'modify',
                    },
                ]
            });
        });
    </script>

    {{-- delete js --}}
    <script>
        $(document).on('click', '.delete', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.data_id').data('id'));
        });
    </script>
@endsection

@endsection
