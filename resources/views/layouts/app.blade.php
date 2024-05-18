<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{$title}} - {{ config('app.name') }}</title>
        <link rel="shortcut icon" href="{{URL::to('assets/img/favicon.png')}}">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
        <link rel="stylesheet" href="{{URL::to('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{URL::to('assets/plugins/feather/feather.css')}}">
        <link rel="stylesheet" href="{{URL::to('assets/plugins/icons/flags/flags.css')}}">
        <link rel="stylesheet" href="{{URL::to('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
        <link rel="stylesheet" href="{{URL::to('assets/plugins/fontawesome/css/all.min.css')}}">
        <link rel="stylesheet" href="{{URL::to('assets/css/style.css')}}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>

        <div class="main-wrapper">

            <div class="header">

                <div class="header-left">
                    <a href="{{ route('dashboard') }}" class="logo">
                        <img src="{{URL::to('assets/img/logo.png')}}" alt="Logo">
                    </a>
                    <a href="{{ route('dashboard') }}" class="logo logo-small">
                        <img src="{{URL::to('assets/img/logo-small.png')}}" alt="Logo" width="30" height="30">
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
                    <li class="nav-item dropdown noti-dropdown language-drop me-2">
                        <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                            <img src="{{URL::to('assets/img/icons/header-icon-01.svg')}}" alt="">
                        </a>
                        <div class="dropdown-menu ">
                            <div class="noti-content">
                                <div>
                                    <a class="dropdown-item" href="javascript:;"><i
                                            class="flag flag-lr me-2"></i>English</a>
                                    <a class="dropdown-item" href="javascript:;"><i
                                            class="flag flag-bl me-2"></i>Francais</a>
                                    <a class="dropdown-item" href="javascript:;"><i class="flag flag-cn me-2"></i>Turkce</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown noti-dropdown me-2">
                        <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                            <img src="{{URL::to('assets/img/icons/header-icon-05.svg')}}" alt="">
                        </a>
                        <div class="dropdown-menu notifications">
                            <div class="topnav-dropdown-header">
                                <span class="notification-title">Notifications</span>
                                <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                            </div>
                            <div class="noti-content">
                                <ul class="notification-list">
                                    <li class="notification-message">
                                        <a href="#">
                                            <div class="media d-flex">
                                                <span class="avatar avatar-sm flex-shrink-0">
                                                    <img class="avatar-img rounded-circle" alt="User Image"
                                                        src="{{URL::to('assets/img/profiles/avatar-02.jpg')}}">
                                                </span>
                                                <div class="media-body flex-grow-1">
                                                    <p class="noti-details"><span class="noti-title">Carlson Tech</span> has
                                                        approved <span class="noti-title">your estimate</span></p>
                                                    <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="notification-message">
                                        <a href="#">
                                            <div class="media d-flex">
                                                <span class="avatar avatar-sm flex-shrink-0">
                                                    <img class="avatar-img rounded-circle" alt="User Image"
                                                        src="{{URL::to('assets/img/profiles/avatar-11.jpg')}}">
                                                </span>
                                                <div class="media-body flex-grow-1">
                                                    <p class="noti-details"><span class="noti-title">International Software
                                                            Inc</span> has sent you a invoice in the amount of <span
                                                            class="noti-title">$218</span></p>
                                                    <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="notification-message">
                                        <a href="#">
                                            <div class="media d-flex">
                                                <span class="avatar avatar-sm flex-shrink-0">
                                                    <img class="avatar-img rounded-circle" alt="User Image"
                                                        src="{{URL::to('assets/img/profiles/avatar-17.jpg')}}">
                                                </span>
                                                <div class="media-body flex-grow-1">
                                                    <p class="noti-details"><span class="noti-title">John Hendry</span> sent
                                                        a cancellation request <span class="noti-title">Apple iPhone
                                                            XR</span></p>
                                                    <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="notification-message">
                                        <a href="#">
                                            <div class="media d-flex">
                                                <span class="avatar avatar-sm flex-shrink-0">
                                                    <img class="avatar-img rounded-circle" alt="User Image"
                                                        src="{{URL::to('assets/img/profiles/avatar-13.jpg')}}">
                                                </span>
                                                <div class="media-body flex-grow-1">
                                                    <p class="noti-details"><span class="noti-title">Mercury Software
                                                            Inc</span> added a new product <span class="noti-title">Apple
                                                            MacBook Pro</span></p>
                                                    <p class="noti-time"><span class="notification-time">12 mins ago</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="topnav-dropdown-footer">
                                <a href="#">View all Notifications</a>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item zoom-screen me-2">
                        <a href="#" class="nav-link header-nav-list win-maximize">
                            <img src="{{URL::to('assets/img/icons/header-icon-04.svg')}}" alt="">
                        </a>
                    </li>

                    <li class="nav-item dropdown has-arrow new-user-menus">
                        <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                            <span class="user-img">
                                <img class="rounded-circle" src="{{URL::to('assets/img/profiles/avatar-01.jpg')}}" width="31"
                                    alt="Soeng Souy">
                                <div class="user-text">
                                    <h6>{{ Auth::user()->name }}</h6>
                                    <p class="text-muted mb-0">Administrator</p>
                                </div>
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="user-header">
                                <div class="avatar avatar-sm">
                                    <img src="{{URL::to('assets/img/profiles/avatar-01.jpg')}}" alt="User Image"
                                        class="avatar-img rounded-circle">
                                </div>
                                <div class="user-text">
                                    <h6>{{ Auth::user()->name }}</h6>
                                    <p class="text-muted mb-0">Administrator</p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{route('profile.edit')}}">My Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        </div>
                    </li>

                </ul>

            </div>
            @include('layouts.navigation')
            <div class="page-wrapper">
                <div class="content container-fluid">
                    @yield('content')
                </div>
                <footer>
                    <p>Copyright © 2024 {{ config('app.name') }}.</p>
                </footer>
            </div>
        </div>

        <script src="{{URL::to('assets/js/jquery-3.6.0.min.js')}}"></script>
        <script src="{{URL::to('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{URL::to('assets/js/feather.min.js')}}"></script>
        <script src="{{URL::to('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{URL::to('assets/plugins/apexchart/apexcharts.min.js')}}"></script>
        <script src="{{URL::to('assets/plugins/apexchart/chart-data.js')}}"></script>
        <script src="{{URL::to('assets/js/script.js')}}"></script>
    </body>
</html>
