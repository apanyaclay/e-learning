@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-header">
                        <div class="row align-items-center">
                            <div class="col-auto profile-image">
                                <a href="#">
                                    <img class="rounded-circle" alt="{{ $admin->nama }}"
                                        src="{{ Storage::url('foto/' . $admin->foto) }}">
                                </a>
                            </div>
                            <div class="col ms-md-n2 profile-user-info">
                                <h4 class="user-name mb-0">{{ $admin->nama }}</h4>
                                <h6 class="text-muted">{{ $user->role }}</h6>
                                <div class="user-Location"><i class="fas fa-map-marker-alt"></i> {{ $admin->alamat }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#password_tab">Password</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content profile-tab-cont">

                        <div class="tab-pane fade show active" id="per_details_tab">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title d-flex justify-content-between">
                                                <span>Personal Details</span>
                                                <a class="edit-link" href="#" onclick="editProfile()"><i
                                                        class="far fa-edit me-1"></i>Edit</a>
                                            </h5>
                                            <form action="{{ route('admin/profile/edit') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Username</p>
                                                    <p id="username" class="col-sm-9">{{ $user->username }}</p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Nama</p>
                                                    <p id="nama" class="col-sm-9">{{ $admin->nama }}</p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Agama</p>
                                                    <p id="agama" class="col-sm-9">{{ $admin->agama }}</p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Tanggal Lahir
                                                    </p>
                                                    <p id="tanggal_lahir" class="col-sm-9">{{ $admin->tanggal_lahir }}</p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Tempat Lahir</p>
                                                    <p id="tempat_lahir" class="col-sm-9">{{ $admin->tempat_lahir }}</p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Jenis Kelamin
                                                    </p>
                                                    <p id="jenis_kelamin" class="col-sm-9">
                                                        @if ($admin->jenis_kelamin == 'L')
                                                            Laki-Laki
                                                        @else
                                                            Perempuan
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email</p>
                                                    <p id="email" class="col-sm-9"><a href="/cdn-cgi/l/email-protection"
                                                            class="__cf_email__"
                                                            data-cfemail="a1cbcec9cfc5cec4e1c4d9c0ccd1cdc48fc2cecc">{{ $user->email }}</a>
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">No HP</p>
                                                    <p id="no_hp" class="col-sm-9">{{ $admin->no_hp }}</p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0">Alamat</p>
                                                    <p id="alamat" class="col-sm-9 mb-0">{{ $admin->alamat }}</p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0" id="edit-foto"
                                                        style="display: none">Foto</p>
                                                    <p id="foto" class="col-sm-9 mb-0"></p>
                                                </div>
                                                <input type="hidden" name="image_hidden" value="{{ $admin->foto }}">
                                                <div class="row" id="edit-actions" style="display: none;">
                                                    <div class="col-sm-9 offset-sm-3">
                                                        <button type="button" class="btn btn-secondary"
                                                            onclick="cancelEdit()">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title d-flex justify-content-between">
                                                <span>Tentang Saya </span>
                                                <a class="edit-link" href="#" onclick="editTentang()"><i
                                                        class="far fa-edit me-1"></i>Edit</a>
                                            </h5>
                                            <form action="{{ route('admin/profile/edit/tentang') }}" method="post">
                                                @csrf
                                                <div class="skill-tags">
                                                    <p id="tentang">{{ $admin->tentang }}</p>
                                                </div>
                                                <div class="row" id="edit-about" style="display: none;">
                                                    <div class="col-sm-9 offset-sm-3">
                                                        <button type="button" class="btn btn-secondary"
                                                            onclick="cancelTentang()">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="password_tab" class="tab-pane fade">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Change Password</h5>
                                    <div class="row">
                                        <div class="col-md-10 col-lg-6">
                                            <form action="{{ route('change/password') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Old Password</label>
                                                    <input type="password"
                                                        class="form-control @error('current_password') is-invalid @enderror"
                                                        name="current_password" value="{{ old('current_password') }}">
                                                    @error('current_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input type="password"
                                                        class="form-control @error('new_password') is-invalid @enderror"
                                                        name="new_password" value="{{ old('new_password') }}">
                                                    @error('new_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input type="password"
                                                        class="form-control @error('new_confirm_password') is-invalid @enderror"
                                                        name="new_confirm_password"
                                                        value="{{ old('new_confirm_password') }}">
                                                    @error('new_confirm_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <script>
            function editProfile() {
                document.getElementById('username').innerHTML =
                    '<input type="text" name="username" value="{{ $user->username }}" class="form-control">';
                document.getElementById('nama').innerHTML =
                    '<input type="text" name="nama" value="{{ $admin->nama }}" class="form-control">';
                document.getElementById('agama').innerHTML =
                    '<select class="form-control" name="agama"><option selected disabled>Silahkan pilih Agama </option><option value="Hindu" {{ $admin->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option><option value="Kristen" {{ $admin->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option><option value="Katolik" {{ $admin->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option><option value="Islam" {{ $admin->agama == 'Islam' ? 'selected' : '' }}>Islam</option><option value="Budha" {{ $admin->agama == 'Budha' ? 'selected' : '' }}>Budha</option></select>';
                document.getElementById('tanggal_lahir').innerHTML =
                    '<input type="date" name="tanggal_lahir" value="{{ $admin->tanggal_lahir }}" class="form-control">';
                document.getElementById('tempat_lahir').innerHTML =
                    '<input type="text" name="tempat_lahir" value="{{ $admin->tempat_lahir }}" class="form-control">';
                document.getElementById('jenis_kelamin').innerHTML =
                    '<select class="form-control" name="jenis_kelamin"><option selected disabled>Select Jenis Kelamin</option><option value="P" {{ $admin->jenis_kelamin == 'P' ? 'selected' : 'P' }}>Perempuan</option><option value="L" {{ $admin->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-Laki</option></select>';
                document.getElementById('email').innerHTML =
                    '<input type="text" name="email" value="{{ $user->email }}" class="form-control">';
                document.getElementById('no_hp').innerHTML =
                    '<input type="text" name="no_hp" value="{{ $admin->no_hp }}" class="form-control">';
                document.getElementById('alamat').innerHTML =
                    '<input type="text" name="alamat" value="{{ $admin->alamat }}" class="form-control">';
                document.getElementById('foto').innerHTML =
                    '<label class="file-upload image-upbtn mb-0"><input type="file" name="foto"> </label>';

                document.getElementById('edit-foto').style.display = 'block';
                document.getElementById('edit-actions').style.display = 'block';
            }

            function cancelEdit() {
                document.getElementById('username').innerHTML = '{{ $user->username }}';
                document.getElementById('nama').innerHTML = '{{ $admin->nama }}';
                document.getElementById('agama').innerHTML = '{{ $admin->agama }}';
                document.getElementById('tanggal_lahir').innerHTML = '{{ $admin->tanggal_lahir }}';
                document.getElementById('tempat_lahir').innerHTML = '{{ $admin->tempat_lahir }}';
                document.getElementById('jenis_kelamin').innerHTML =
                    @if ($admin->jenis_kelamin == 'L')
                        'Laki-Laki'
                    @else
                        'Perempuan'
                    @endif ;
                document.getElementById('email').innerHTML = '{{ $user->email }}';
                document.getElementById('no_hp').innerHTML = '{{ $admin->no_hp }}';
                document.getElementById('alamat').innerHTML = '{{ $admin->alamat }}';
                document.getElementById('foto').innerHTML = '{{ $admin->foto }}';

                document.getElementById('edit-actions').style.display = 'none';
            }

            function editTentang() {
                document.getElementById('tentang').innerHTML =
                    '<textarea id="tentang" name="tentang" rows="10" cols="20">{{ $admin->tentang }}</textarea>';
                document.getElementById('edit-about').style.display = 'block';
            }

            function cancelTentang() {
                document.getElementById('tentang').innerHTML = '{{ $admin->tentang }}';
                document.getElementById('edit-about').style.display = 'none';
            }
        </script>
    </div>
@endsection
