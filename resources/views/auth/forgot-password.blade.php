@extends('layouts.guest')
@section('content')
<div class="loginbox">
    <div class="login-left">
        <img class="img-fluid" src="{{URL::to('assets/img/login.png')}}" alt="Logo" />
    </div>
    <div class="login-right">
        <div class="login-right-wrap">
            <h1>Reset Password</h1>
            <p class="account-subtitle">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label>Enter your registered email address
                        <span class="login-danger">*</span></label>
                    <input class="form-control" type="email" id="email" name="email" required autofocus/>
                    <span class="profile-views"><i class="fas fa-envelope"></i></span>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">
                        Email Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
