@extends('website.layouts.layout')
@section('title')
    {{__('website\doctor\auth\resetPass.doctorreset')}}
@endsection
@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <!-- Account Content -->
                    <div class="account-content">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-7 col-lg-6 login-left">
                                <img src="{{ url('website/assets/img/login-banner.png') }}" class="img-fluid"
                                    alt="Login Banner">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right">
                                <div class="login-header">
                                    <h3>{{__('website\doctor\auth\resetPass.forgot')}}</h3>
                                    <p class="small text-muted">{{__('website\doctor\auth\resetPass.sen')}}</p>
                                </div>
                                @include('website.includes.sessionDisplay')
                                <!-- Forgot Password Form -->
                                <form method="POST" action="{{ route('doctor.password.email') }}">
                                    @csrf
                                    <div class="form-group form-focus">
                                        <input type="email" class="form-control floating" name="email">
                                        <label class="focus-label">{{__('website\doctor\auth\resetPass.email')}}</label>
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                    <div class="text-right">
                                        <a class="forgot-link" href="{{ route('doctor.login') }}">{{__('website\doctor\auth\resetPass.ques')}}</a>
                                    </div>
                                    <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">{{__('website\doctor\auth\resetPass.reset')}}</button>
                                </form>
                                <!-- /Forgot Password Form -->

                            </div>
                        </div>
                    </div>
                    <!-- /Account Content -->

                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->
@endsection
