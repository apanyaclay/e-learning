@extends('layouts.guest')
@section('content')
    <div class="loginbox">
        <div class="login-left">
            <img class="img-fluid" src="{{URL::to('assets/img/login.png')}}" alt="Logo" />
        </div>
        <div class="login-right">
            <div class="login-right-wrap">
                <h1>Reset Password</h1>
                <p class="account-subtitle">Let Us Help You</p>

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->token }}">
                    <div class="form-group">
                        <label>Email<span class="login-danger">*</span></label>
                        <input class="form-control" type="email" id="email" name="email" value="{{ $request->email }}" readonly/>
                        <span class="profile-views"><i class="fas fa-envelope"></i></span>
                    </div>
                    <div class="form-group">
                        <label>Password<span class="login-danger">*</span></label>
                        <input class="form-control" type="password" id="password" name="password" required autocomplete="new-password"/>
                        <span class="profile-views"><i class="fas fa-envelope"></i></span>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password<span class="login-danger">*</span></label>
                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"/>
                        <span class="profile-views"><i class="fas fa-envelope"></i></span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">
                            Reset My Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
