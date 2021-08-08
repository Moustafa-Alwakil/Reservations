@extends('website.layouts.layout')
@section('title')
    {{ __('website\doctor\auth\register.doctorreg') }}
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
                                    <h3>{{ __('website\doctor\auth\register.doctorreg') }}</h3>
                                </div>
                                @include('website.includes.SessionDisplay')
                                <form method="POST" action="{{ route('store.doctor.register') }}">
                                    @csrf
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating" name="fname_ar"
                                            value="{{ old('fname_ar') }}">
                                        <label class="focus-label">{{ __('website\doctor\auth\register.fname_ar') }}</label>
                                    </div>
                                    @error('fname_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating" name="lname_ar"
                                            value="{{ old('lname_ar') }}">
                                        <label class="focus-label">{{ __('website\doctor\auth\register.lname_ar') }}</label>
                                    </div>
                                    @error('lname_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating" name="fname_en"
                                            value="{{ old('fname_en') }}">
                                        <label class="focus-label">{{ __('website\doctor\auth\register.fname_en') }}</label>
                                    </div>
                                    @error('fname_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating" name="lname_en"
                                            value="{{ old('lname_en') }}">
                                        <label class="focus-label">{{ __('website\doctor\auth\register.lname_en') }}</label>
                                    </div>
                                    @error('lname_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group form-focus">
                                        <input type="email" class="form-control floating" name="email"
                                            value="{{ old('email') }}">
                                        <label class="focus-label">{{ __('website\doctor\auth\register.email') }}</label>
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group form-focus">
                                        <select class="form-control floating" name="gender">
                                            <option selected disabled>{{ __('website\doctor\auth\register.selectgender') }}</option>
                                            <option value="m" @if (old('gender') == 'm') {{ 'selected' }} @endif>{{ __('website\doctor\auth\register.male') }}</option>
                                            <option value="f" @if (old('gender') == 'f') {{ 'selected' }} @endif>{{ __('website\doctor\auth\register.female') }}</option>
                                        </select>
                                    </div>
                                    @error('gender')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group form-focus">
                                        <input type="date" class="form-control floating" name="birthdate"
                                            value="{{ old('birthdate') }}">
                                        <label class="focus-label">{{ __('website\doctor\auth\register.birthdate') }}</label>
                                    </div>
                                    @error('birthdate')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group form-focus">
                                        <input type="password" class="form-control floating" name="password">
                                        <label class="focus-label">{{ __('website\doctor\auth\register.pass') }}</label>
                                    </div>
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group form-focus">
                                        <input type="password" class="form-control floating" name="password_confirmation">
                                        <label class="focus-label">{{ __('website\doctor\auth\register.conpass') }}</label>
                                    </div>
                                    @error('password_confirmation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="text-right">
                                        <a class="forgot-link" href="{{ route('doctor.login') }}">{{ __('website\doctor\auth\register.ques') }}</a>
                                    </div>
                                    <button class="btn btn-primary btn-block btn-lg login-btn"
                                        type="submit">{{ __('website\doctor\auth\register.reg') }}</button>
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
    <!-- /Page Content -->
@endsection
