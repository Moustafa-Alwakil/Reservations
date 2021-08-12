@extends('dashboard.layouts.auth')
@section('title','Forgot Password')
@section('form')
<div class="login-right">
    <div class="login-right-wrap">
        <h1>Forgot Password?</h1>
        <p class="account-subtitle">Enter your email to get a password reset link</p>
        @include('website.includes.sessionDisplay')
        <!-- Form -->
        <form method="POST" action="{{route('admin.password.email')}}">
            @csrf
            <div class="form-group">
                <input class="form-control" name="email" type="email" placeholder="Email" value="{{old('email')}}">
            </div>
            @error('email')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
            <div class="form-group mb-0">
                <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
            </div>
        </form>
        <!-- /Form -->
        
        <div class="text-center dont-have">Remember your password? <a href="{{route('admin.login')}}">Login</a></div>
    </div>
</div>
@endsection