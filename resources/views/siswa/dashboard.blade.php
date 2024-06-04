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
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active">Student</li>
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
                                    <h6>Total Guru</h6>
                                    <h3>{{ $jadwal }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/teacher.png') }}" alt="Dashboard Icon">
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
                                    <h6>Total Jurusan</h6>
                                    <h3>{{ $jurusan }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/dash-icon-03.svg') }}" alt="Dashboard Icon">
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
                                    <h6>Total Siswa</h6>
                                    <h3>{{ $kelas }}</h3>
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
                                    <h6>Total Mata Pelajaran</h6>
                                    <h3>{{ $mapel }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/teacher-icon-01.svg') }}" alt="Dashboard Icon">
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
                                    <h3>{{ $jadwal }}</h3>
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
                                    <h6>Total Absensi</h6>
                                    <h3>{{ $absen }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/absensi.png') }}" alt="Dashboard Icon">
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
                                    <h3>{{ $kuis }}</h3>
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
                                    <h3>{{ $tugas }}</h3>
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
                                <div class="col-lg-7 col-md-4">
                                    <div class="dash-details">
                                        <div class="lesson-activity">
                                            <div class="lesson-imgs">
                                                <img src="{{ URL::to('assets/img/icons/lesson-icon-01.svg') }}"
                                                    alt="">
                                            </div>
                                            <div class="views-lesson">
                                                <h5>Mapel</h5>
                                                @foreach ($datahariIni as $item)
                                                    <h4>
                                                        <span>{{ $item->mapel_nama }} </span>
                                                    </h4>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-3">
                                    <div class="dash-details">
                                        <div class="lesson-activity">
                                            <div class="lesson-imgs">
                                                <img src="{{URL::to('assets/img/icons/lesson-icon-03.svg')}}" alt="">
                                            </div>
                                            <div class="views-lesson">
                                                <h5>Jam</h5>
                                                @foreach ($datahariIni as $item)
                                                    <h4>
                                                        <span>({{ $item->jam_mulai }} -
                                                            {{ $item->jam_selesai }})</span>
                                                    </h4>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-4">
                                    <div class="dash-details">
                                        <div class="lesson-activity">
                                            <div class="lesson-imgs">
                                                <img src="assets/img/icons/lesson-icon-04.svg" alt="">
                                            </div>
                                            <div class="views-lesson">
                                                <h5>Absensi</h5>
                                                @foreach ($datahariIni as $item)
                                                    <h4>
                                                        @php
                                                            $currentTime = \Carbon\Carbon::now()->format('H:i');
                                                            $startTime = \Carbon\Carbon::parse(
                                                                $item->jam_mulai,
                                                            )->format('H:i');
                                                            $endTime = \Carbon\Carbon::parse(
                                                                $item->jam_selesai,
                                                            )->format('H:i');
                                                            $key = $siswa->nisn . '-' . $item->id;
                                                        @endphp
                                                        @if ($currentTime >= $startTime && $currentTime <= $endTime)
                                                            @if (isset($absensi[$key]))
                                                                <a href="{{ url('siswa/pertemuan/view/' . $item->id) }}"
                                                                    role="button"
                                                                    class="btn btn-primary btn-sm">Pertemuan</a>
                                                            @else
                                                                <a href="{{ url('siswa/pertemuan/' . $item->id . '/absensi/' . $siswa->nisn) }}"
                                                                    role="button"
                                                                    class="btn btn-primary btn-sm">Absensi</a>
                                                            @endif
                                                        @else
                                                            <span class="badge badge-secondary">Tidak dalam jadwal</span>
                                                        @endif
                                                    </h4>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card flex-fill comman-shadow">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">Kuis</h5>
                                </div>
                            </div>
                        </div>
                        <div class="dash-circle">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="dash-details">
                                        <div class="lesson-activity">
                                            <div class="views-lesson">
                                                @foreach ($kusin as $item)
                                                    <h4>{{ $item->nama }} -
                                                        {{ \Carbon\Carbon::parse($item->tenggat)->format('d M Y H:i') }} -
                                                        {{ $item->durasi }} Menit <a
                                                            style="margin: 10px 0; margin-left:50px"
                                                            href="{{ url('siswa/kuis/kerjakan/' . $item->id) }}"
                                                            role="button"class="btn btn-primary btn-sm">Kerjakan</a></h4>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card flex-fill comman-shadow">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">Tugas</h5>
                                </div>
                            </div>
                        </div>
                        <div class="dash-circle">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="dash-details">
                                        <div class="lesson-activity">
                                            <div class="views-lesson">
                                                @foreach ($tugasin as $item)
                                                    <h4>{{ $item->nama }} -
                                                        {{ \Carbon\Carbon::parse($item->tenggat)->format('d M Y H:i') }} <a
                                                            style="margin: 10px 0; margin-left:50px"
                                                            href="{{ url('siswa/tugas/kerjakan/' . $item->id) }}"
                                                            role="button"class="btn btn-primary btn-sm">Kerjakan</a></h4>
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
                                </div>
                                <div class="upcome-event-date">
                                    <h3>{{ $tanggalBesok }}</h3>
                                </div>
                                @foreach ($besok as $value)
                                    <div class="calendar-details">
                                        <p>{{ \Carbon\Carbon::parse($value->jam_mulai)->format('H:i') }}</p>
                                        <div class="calendar-box normal-bg">
                                            <div class="calandar-event-name">
                                                <h4>{{ $value->mapel_nama }}</h4>
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
                                                <h4>{{ $value->mapel_nama }}</h4>
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

                var eventsYesterday = [
                    @foreach ($pertemuan as $value)
                        {
                            startDate: '{{ \Carbon\Carbon::parse($value->tanggal)->setHour(explode(':', $value->jam_mulai)[0])->setMinute(explode(':', $value->jam_mulai)[1])->toIso8601String() }}',
                            endDate: '{{ \Carbon\Carbon::parse($value->tanggal)->setHour(explode(':', $value->jam_selesai)[0])->setMinute(explode(':', $value->jam_selesai)[1])->toIso8601String() }}',
                            summary: '{{ $value->mapel_nama }}'
                        },
                    @endforeach
                ];

                // Gabungkan semua data acara
                var allEvents = event.concat(eventsYesterday);

                // Inisialisasi plugin kalender
                $("#calendar-doctor").simpleCalendar({
                    fixedStartDay: 0,
                    disableEmptyDetails: true,
                    events: allEvents
                });
            });
        </script>
    @endsection
