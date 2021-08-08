@extends('website.layouts.layout')
@section('title')
    {{__('website\user\auth\login.userlogin')}}
@endsection
@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <!-- Login Tab Content -->
                    <div class="account-content">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-7 col-lg-6 login-left">
                                <img src="{{ url('website/assets/img/login-banner.png') }}" class="img-fluid"
                                    alt="Doccure Login">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right">
                                <div class="login-header">
                                    <h3>{{__('website\user\auth\login.userlogin')}}</h3>
                                </div>
                                @include('website.includes.sessionDisplay')
                                <form method="POST" action="{{ route('store.user.login') }}">
                                    @csrf
                                    <div class="form-group form-focus">
                                        <input type="email" class="form-control floating" name="email"
                                            value="{{ old('email') }}">
                                        <label class="focus-label">{{__('website\user\auth\login.email')}}</label>
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group form-focus">
                                        <input type="password" class="form-control floating" name="password">
                                        <label class="focus-label">{{__('website\user\auth\login.pass')}}</label>
                                    </div>
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="text-right">
                                        <a class="forgot-link" href="{{ route('user.password.request') }}">{{__('website\user\auth\login.forgot')}}</a>
                                    </div>
                                    <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">{{__('website\user\auth\login.login')}}</button>
                                    <div class="text-center dont-have">{{__('website\user\auth\login.ques')}} <a
                                            href="{{ route('user.register') }}">{{__('website\user\auth\login.reg')}}</a></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Login Tab Content -->

                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->
@endsection
