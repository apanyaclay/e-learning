<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{$title}} - {{\App\Models\Setting::where('key', 'website_name')->first()->value ?? config('app.name')}}</title>
    <link rel="shortcut icon" href="{{ Storage::url(\App\Models\Setting::where('key', 'favicon')->first()->value ?? 'img/favicon.png')  }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.cs') }}s">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/icons/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/simple-calendar/simple-calendar.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/ckeditor.css')}}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
    {{-- message toastr --}}
    <link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
    <script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ URL::to('assets/img/logo.png') }}" alt="Logo">
                </a>
                <a href="{{ route('home') }}" class="logo logo-small">
                    <img src="{{ URL::to('assets/img/logo-small.png') }}" alt="Logo" width="30" height="30">
                </a>
            </div>
            <div class="menu-toggle">
                <a href="javascript:void(0);" id="toggle_btn">
                    <i class="fas fa-bars"></i>
                </a>
            </div>

            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control" placeholder="Search here">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>
            <ul class="nav user-menu">
                <li class="nav-item zoom-screen me-2">
                    <a href="#" class="nav-link header-nav-list win-maximize">
                        <img src="{{ URL::to('assets/img/icons/header-icon-04.svg') }}" alt="">
                    </a>
                </li>

                <li class="nav-item dropdown has-arrow new-user-menus">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle"
                                src="@if (Auth::user()->role == 'admin') {{ Storage::url('foto/' . Auth::user()->admin->foto) }}" width="31"alt="{{ Auth::user()->username }}
                            @elseif (Auth::user()->role == 'guru')
                            {{ Storage::url('foto/' . Auth::user()->guru->foto) }}" width="31"alt="{{ Auth::user()->username }}
                            @else
                            {{ Storage::url('foto/' . Auth::user()->siswa->foto) }}" width="31"alt="{{ Auth::user()->username }} @endif"
                                width="31"alt="{{ Auth::user()->username }}">
                            <div class="user-text">
                                <h6>{{ Auth::user()->username }}</h6>
                                <p class="text-muted mb-0">{{ ucfirst(Auth::user()->role) }}</p>
                            </div>
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img src="@if (Auth::user()->role == 'admin') {{ Storage::url('foto/' . Auth::user()->admin->foto) }}" width="31"alt="{{ Auth::user()->username }}
                                @elseif (Auth::user()->role == 'guru')
                                {{ Storage::url('foto/' . Auth::user()->guru->foto) }}" width="31"alt="{{ Auth::user()->username }}
                                @else
                                {{ Storage::url('foto/' . Auth::user()->siswa->foto) }}" width="31"alt="{{ Auth::user()->username }} @endif"
                                    alt="{{ Auth::user()->username }}" class="avatar-img rounded-circle">
                            </div>
                            <div class="user-text">
                                <h6>{{ Auth::user()->username }}</h6>
                                <p class="text-muted mb-0">{{ ucfirst(Auth::user()->role) }}</p>
                            </div>
                        </div>
                        <a class="dropdown-item"
                            href="@if (Auth::user()->role == 'admin') {{ route('admin/profile') }}
                        @elseif (Auth::user()->role == 'guru')
                            {{ route('guru/profile') }}
                        @else
                            {{ route('siswa/profile') }} @endif">My
                            Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
        {{-- side bar --}}
        @include('layouts.sidebar')
        {{-- content page --}}
        {!! Toastr::message() !!}
        @yield('content')
        <footer>
            <p>Copyright © <?php echo date('Y'); ?> {{ config('app.name') }}. All rights reserved.</p>

        </footer>
    </div>

    <script src="{{ URL::to('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/feather.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/apexchart/chart-data.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/simple-calendar/jquery.simple-calendar.js') }}"></script>
    <script src="{{ URL::to('assets/js/circle-progress.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{ URL::to('assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{ URL::to('assets/js/ckeditor.js')}}"></script>
    <script src="{{ URL::to('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js')}}"></script>
    <script src="{{ URL::to('assets/js/script.js') }}"></script>
    @yield('script')
    <script>
        $(document).ready(function() {
            $('.select2s-hidden-accessible').select2({
                closeOnSelect: false
            });
        });
    </script>
</body>

</html>
