@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Detail Guru</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin/guru') }}">Guru</a></li>
                                <li class="breadcrumb-item active">Detail Guru</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="about-info">
                                <h4>Profile {{ $guru->nama }} <span><a href="javascript:;"><i
                                                class="feather-more-vertical"></i></a></span>
                                </h4>
                            </div>
                            <div class="student-profile-head">
                                <div class="profile-bg-img">
                                    <img src="{{ URL::to('assets/img/profile-bg.jpg') }}" alt="Profile">
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="profile-user-box">
                                            <div class="profile-user-img">
                                                <img src="{{ Storage::url('foto/' . $guru->foto) }}" alt="Profile">
                                            </div>
                                            <div class="names-profiles">
                                                <h4>{{ $guru->nama }}</h4>
                                                @foreach ($guru->mataPelajaran as $value)
                                                    <h5>{{ $value->nama }}</h5>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="student-personals-grp">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="heading-detail">
                                            <h4>Data pribadi :</h4>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-user"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Nama</h4>
                                                <h5>{{ $guru->nama_siswa }}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <img src="{{ URL::to('assets/img/icons/book-open.svg') }}" alt="">
                                            </div>
                                            <div class="views-personal">
                                                <h4>Mapel </h4>
                                                @foreach ($guru->mataPelajaran as $value)
                                                    <h5>{{ $value->nama }}</h5>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-phone-call"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>No HP</h4>
                                                <h5>{{ $guru->no_hp }}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <img src="{{ URL::to('assets/img/icons/mail.svg') }}" alt="">
                                            </div>
                                            <div class="views-personal">
                                                <h4>Email</h4>
                                                <h5><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                        data-cfemail="81e5e0e8f2f8c1e6ece0e8edafe2eeec">{{ $user->email }}</a>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-user"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Jenis Kelamin</h4>
                                                <h5>
                                                    @if ($guru->jenis_kelamin == 'L')
                                                        Laki-Laki
                                                    @else
                                                        Perempuan
                                                    @endif
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <img src="{{ URL::to('assets/img/icons/calendar.svg') }}" alt="">
                                            </div>
                                            <div class="views-personal">
                                                <h4>Tanggal Lahir</h4>
                                                <h5>{{ \Carbon\Carbon::parse($guru->tanggal_lahir)->format('d M Y') }}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <img src="{{ URL::to('assets/img/icons/map.svg') }}" alt="">
                                            </div>
                                            <div class="views-personal">
                                                <h4>Tempat Lahir</h4>
                                                <h5>{{ $guru->tempat_lahir }}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity mb-0">
                                            <div class="personal-icons">
                                                <img src="{{ URL::to('assets/img/icons/map-pin.svg') }}" alt="">
                                            </div>
                                            <div class="views-personal">
                                                <h4>Address</h4>
                                                <h5>{{ $guru->alamat }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="student-personals-grp">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <div class="heading-detail">
                                            <h4>About Me</h4>
                                        </div>
                                        <div class="hello-park">
                                            <h5>Hello, saya {{ $guru->nama }}</h5>
                                            <p>{{ $guru->tentang }}. </p>
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
@endsection
