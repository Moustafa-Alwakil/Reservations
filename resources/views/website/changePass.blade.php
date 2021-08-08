@extends('website.layouts.layout')
@section('title')
    {{-- get the name of the user from the session --}}
    @if(Auth::guard('web')->check())
    @php
    $name = Auth::guard('web')->user()->name;
    @endphp
    {{ ucwords($name['fname'] . ' ' . $name['lname']) }} - {{__('website\changePass.changepass')}}
    @elseif(Auth::guard('doc')->check())
    @php
    $name = Auth::guard('doc')->user()->name;
    @endphp
    {{ ucwords($name['fname_' . LaravelLocalization::getCurrentLocale() . ''] . ' ' . $name['lname_' . LaravelLocalization::getCurrentLocale() . '']) }} - {{__('website\changePass.changepass')}}
    @endif
@endsection
@section('content')
    @include('website.includes.bar1')
    {{__('website\changePass.changepass')}}
    @include('website.includes.bar2')
    {{__('website\changePass.changepass')}}
    @include('website.includes.bar3')
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('website.includes.sidebar')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{__('website\changePass.changepass')}}<hr></h4>
                            @include('website.includes.sessionDisplay')<br>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <!-- Change Password Form -->
                                    @if (Auth::guard('web')->check())
                                    <form method="POST" action="{{ route('user.changepass.update') }}">
                                    @elseif(Auth::guard('doc')->check())
                                    <form method="POST" action="{{ route('doctor.changepass.update') }}">
                                    @endif
                                        @csrf
                                        <div class="form-group">
                                            <label>{{__('website\changePass.oldpass')}}</label>
                                            <input type="password" class="form-control" name="oldpassword">
                                        </div>
                                        @error('oldpassword')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group">
                                            <label>{{__('website\changePass.newpass')}}</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group">
                                            <label>{{__('website\changePass.confirmpass')}}</label>
                                            <input type="password" class="form-control" name="password_confirmation">
                                        </div>
                                        <div class="submit-section">
                                            <button type="submit" class="btn btn-primary submit-btn">{{__('website\changePass.save')}}</button>
                                        </div>
                                    </form>
                                    <!-- /Change Password Form -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->
@endsection
