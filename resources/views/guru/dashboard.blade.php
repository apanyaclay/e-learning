@extends('layouts.master')
@section('content')
    @php
        date_default_timezone_set('Asia/Jakarta');
        $time = date('H');
        $greeting = '';

        if ($time >= 5 && $time < 12) {
            $greeting = 'Selamat pagi';
        } elseif ($time >= 12 && $time < 15) {
            $greeting = 'Selamat siang';
        } elseif ($time >= 15 && $time < 18) {
            $greeting = 'Selamat sore';
        } else {
            $greeting = 'Selamat malam';
        }
    @endphp
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">{{ $greeting }}, {{ Auth::user()->username }}!</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Teacher</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Total Siswa</h6>
                                    <h3>{{ count($siswa) }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/dash-icon-01.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Total Jadwal</h6>
                                    <h3>{{ count($jadwals) }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/teacher-icon-03.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Total Pertemuan</h6>
                                    <h3>{{ count($pertemuan) }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/metting.png') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Total Materi</h6>
                                    <h3>{{ count($materi) }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/teacher-icon-02.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Total E-Book</h6>
                                    <h3>{{ count($ebook) }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/ebook.png') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Total Kuis</h6>
                                    <h3>{{ count($kuis) }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/student-icon-01.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Total Tugas</h6>
                                    <h3>{{ count($tugas) }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/student-icon-01.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12 col-lg-12 col-xl-8">
                    <div class="card flex-fill comman-shadow">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">Pelajaran Hari Ini</h5>
                                </div>
                            </div>
                        </div>
                        <div class="dash-circle">
                            <div class="row">
                                <div class="col-lg-5 col-md-5">
                                    <div class="dash-details">
                                        <div class="lesson-activity">
                                            <div class="lesson-imgs">
                                                <img src="{{ URL::to('assets/img/icons/lesson-icon-01.svg') }}"
                                                    alt="">
                                            </div>
                                            <div class="views-lesson">
                                                <h5>Kelas</h5>
                                                @foreach ($hariini as $item)
                                                    <h4>
                                                        <span>{{ $item->kelas_nama }} {{ $item->jurusan_nama }}</span>
                                                    </h4>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="dash-details">
                                        <div class="lesson-activity">
                                            <div class="lesson-imgs">
                                                <img src="{{ URL::to('assets/img/icons/lesson-icon-03.svg') }}"
                                                    alt="">
                                            </div>
                                            <div class="views-lesson">
                                                <h5>Jam</h5>
                                                @foreach ($hariini as $item)
                                                    <h4>
                                                        <span>{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</span>
                                                    </h4>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-1">
                                    <div class="dash-details">
                                        <div class="lesson-activity">
                                            <div class="lesson-imgs">
                                                <img src="assets/img/icons/lesson-icon-04.svg" alt="">
                                            </div>
                                            <div class="views-lesson">
                                                <h5>Aksi</h5>
                                                @foreach ($hariini as $item)
                                                    <h4>
                                                        <a href="{{ url('guru/pertemuan/view/' . $item->id) }}"
                                                            role="button" class="btn btn-primary btn-sm">Pertemuan</a>
                                                    </h4>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-12 col-xl-4 d-flex">
                    <div class="card flex-fill comman-shadow">
                        <div class="card-body">
                            <div id="calendar-doctor" class="calendar-container"></div>
                            <div class="calendar-info calendar-info1">
                                <div class="up-come-header">
                                    <h2>Acara Mendatang</h2>
                                    <span><a href="javascript:;"><i class="feather-plus"></i></a></span>
                                </div>
                                <div class="upcome-event-date">
                                    <h3>{{ $tanggalBesok }}</h3>
                                </div>
                                @foreach ($besok as $value)
                                    <div class="calendar-details">
                                        <p>{{ \Carbon\Carbon::parse($value->jam_mulai)->format('H:i') }}</p>
                                        <div class="calendar-box normal-bg">
                                            <div class="calandar-event-name">
                                                <h4>Kelas {{ $value->kelas_nama }} {{ $value->jurusan_nama }}</h4>
                                            </div>
                                            <span>{{ \Carbon\Carbon::parse($value->jam_mulai)->format('H:i') }} -
                                                {{ \Carbon\Carbon::parse($value->jam_selesai)->format('H:i') }}</span>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="upcome-event-date">
                                    <h3>{{ $tanggalLusa }}</h3>
                                </div>
                                @foreach ($lusa as $value)
                                    <div class="calendar-details">
                                        <p>{{ \Carbon\Carbon::parse($value->jam_mulai)->format('H:i') }}</p>
                                        <div class="calendar-box normal-bg">
                                            <div class="calandar-event-name">
                                                <h4>Kelas {{ $value->kelas_nama }} {{ $value->jurusan_nama }}</h4>
                                            </div>
                                            <span>{{ \Carbon\Carbon::parse($value->jam_mulai)->format('H:i') }} -
                                                {{ \Carbon\Carbon::parse($value->jam_selesai)->format('H:i') }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script>
            $(document).ready(function() {

                var event = [];

                var events = [
                    @foreach ($pertemuan as $value)
                        {
                            startDate: '{{ \Carbon\Carbon::parse($value->tanggal)->setHour(explode(':', $value->jam_mulai)[0])->setMinute(explode(':', $value->jam_mulai)[1])->toIso8601String() }}',
                            endDate: '{{ \Carbon\Carbon::parse($value->tanggal)->setHour(explode(':', $value->jam_selesai)[0])->setMinute(explode(':', $value->jam_selesai)[1])->toIso8601String() }}',
                            summary: 'Kelas {{ $value->kelas_nama }} {{ $value->jurusan_nama }}'
                        },
                    @endforeach
                ];

                // Gabungkan semua data acara
                var allEvents = event.concat(events);

                // Inisialisasi plugin kalender
                $("#calendar-doctor").simpleCalendar({
                    fixedStartDay: 0,
                    disableEmptyDetails: true,
                    events: allEvents
                });
            });
        </script>
    @endsection
