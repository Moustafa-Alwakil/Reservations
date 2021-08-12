@extends('dashboard.layouts.auth')
@section('title', 'Login')
@section('form')
<div class="login-right">
    <div class="login-right">
        <div class="login-right-wrap">
            <h1>Login</h1>
            <p class="account-subtitle">Access to our dashboard</p>
            @include('website.includes.sessionDisplay')
            <!-- Form -->
            <form method="POST" action="{{ route('store.admin.login') }}">
                @csrf
                <div class="form-group">
                    <input class="form-control" name="email" type="email" placeholder="Email"
                        value="{{ old('email') }}">
                </div>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <input class="form-control" name="password" type="password" placeholder="Password">
                </div>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Login</button>
                </div>
            </form>
            <!-- /Form -->

            <div class="text-center forgotpass"><a href="{{route('admin.password.request')}}">Forgot Password?</a></div>

            <div class="text-center dont-have">Don’t have an account? <a href="{{route('admin.register')}}">Register</a></div>
        </div>
    </div>
</div>
@endsection
