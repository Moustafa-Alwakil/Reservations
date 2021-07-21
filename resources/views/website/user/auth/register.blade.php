@extends('website.layouts.layout')
@section('title')
    {{ __('index.reg') }}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <!-- Register Content -->
                    <div class="account-content">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-7 col-lg-6 login-left">
                                <img src={{ url('website/assets/img/login-banner.png') }} class="img-fluid"
                                    alt="Doccure Register">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right">
                                <div class="login-header">
                                    <h3>User Register <a href="doctor-register.html"></a></h3>
                                </div>
                                @include('website.includes.SessionDisplay')
                                <form method="POST" action="{{ route('store.user.register') }}">
                                    @csrf
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating" name="fname"
                                            value="{{ old('fname') }}">
                                        <label class="focus-label">First Name</label>
                                    </div>
                                    @error('fname')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating" name="lname"
                                            value="{{ old('lname') }}">
                                        <label class="focus-label">Last Name</label>
                                    </div>
                                    @error('lname')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group form-focus">
                                        <input type="tel" class="form-control floating" name="phone"
                                            value="{{ old('phone') }}">
                                        <label class="focus-label">Phone</label>
                                    </div>
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group form-focus">
                                        <input type="email" class="form-control floating" name="email"
                                            value="{{ old('email') }}">
                                        <label class="focus-label">Email</label>
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group form-focus">
                                        <select class="form-control floating" name="gender">
                                            <option selected disabled>Select Your Gender</option>
                                            <option value="m" @if (old('gender') == 'm') {{ 'selected' }} @endif>Male</option>
                                            <option value="f" @if (old('gender') == 'f') {{ 'selected' }} @endif>Female</option>
                                        </select>
                                    </div>
                                    @error('gender')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group form-focus">
                                        <input type="date" class="form-control floating" name="birthdate"
                                            value="{{ old('birthdate') }}">
                                        <label class="focus-label">Birthdate</label>
                                    </div>
                                    @error('birthdate')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group form-focus">
                                        <input type="password" class="form-control floating" name="password">
                                        <label class="focus-label">Password</label>
                                    </div>
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group form-focus">
                                        <input type="password" class="form-control floating" name="password_confirmation">
                                        <label class="focus-label">Confirm Password</label>
                                    </div>
                                    @error('password_confirmation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="text-right">
                                        <a class="forgot-link" href="{{ route('user.login') }}">Already have an
                                            account?</a>
                                    </div>
                                    <button class="btn btn-primary btn-block btn-lg login-btn"
                                        type="submit">Register</button>
                                </form>
                                <!-- /Register Form -->

                            </div>
                        </div>
                    </div>
                    <!-- /Register Content -->

                </div>
            </div>
        </div>
    </div>
@endsection
