<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{$title}} - {{ config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon" href="assets/img/favicon.png">

        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"
            rel="stylesheet">

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
        <div class="main-wrapper login-body">
            <div class="login-wrapper">
                <div class="container">
                @yield('content')
                </div>
            </div>
        </div>

        <script src="{{URL::to('assets/js/jquery-3.6.0.min.js')}}"></script>

        <script src="{{URL::to('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <script src="{{URL::to('assets/js/feather.min.js')}}"></script>

        <script src="{{URL::to('assets/js/script.js')}}"></script>
    </body>
</html>
