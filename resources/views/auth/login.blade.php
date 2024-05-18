@extends('layouts.guest')
@section('content')
<div class="loginbox">
    <div class="login-left">
        <img class="img-fluid" src="{{URL::to('assets/img/login.png')}}" alt="Logo">
    </div>
    <div class="login-right">
        <div class="login-right-wrap">
            <h1>Welcome to Preskool</h1>
            <p class="account-subtitle">Need an account? <a href="{{ route('register') }}">Sign Up</a></p>
            <h2>Sign in</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email <span class="login-danger">*</span></label>
                    <input class="form-control" type="email" name="email" id="email" required autofocus autocomplete="username">
                    <span class="profile-views"><i class="fas fa-envelope"></i></span>
                </div>
                <div class="form-group">
                    <label>Password <span class="login-danger">*</span></label>
                    <input class="form-control pass-input" type="password" name="password" id="password" required autocomplete="current-password">
                    <span class="profile-views feather-eye toggle-password"></span>
                </div>
                <div class="forgotpass">
                    <div class="remember-me">
                        <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Remember me
                            <input type="checkbox" name="remember">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Login</button>
                </div>
            </form>

            <div class="login-or">
                <span class="or-line"></span>
                <span class="span-or">or</span>
            </div>

            <div class="social-login">
                <a href="#"><i class="fab fa-google-plus-g"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>

        </div>
    </div>
</div>
@endsection
