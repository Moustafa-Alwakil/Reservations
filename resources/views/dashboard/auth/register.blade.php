@extends('dashboard.layouts.auth')
@section('title', 'Register')

@section('form')
<div class="login-right">
    <div class="login-right-wrap">
        <h1>Register</h1>
        <p class="account-subtitle">Access to our dashboard</p>
        @include('website.includes.sessionDisplay')
        <!-- Form -->
        <form method="POST" action="{{ route('store.admin.register') }}">
            @csrf
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Name" name="name" value="{{ old('name') }}">
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <input class="form-control" type="email" placeholder="Email" name="email" value="{{ old('email') }}">
            </div>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <input class="form-control" type="password" placeholder="Password" name="password">
            </div>
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <input class="form-control" type="password" placeholder="Confirm Password" name="password_confirmation">
            </div>
            <div class="form-group mb-0">
                <button class="btn btn-primary btn-block" type="submit">Register</button>
            </div>
        </form>
        <!-- /Form -->

        <div class="text-center dont-have">Already have an account? <a href="{{route('admin.login')}}">Login</a></div>
    </div>
</div>
@endsection
