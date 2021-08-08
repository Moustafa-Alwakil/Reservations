@extends('website.layouts.layout')
@section('title')
    {{-- get the name of the user from the session --}}
    @php
    $name = Auth::guard('web')->user()->name;
    @endphp
    {{ ucwords($name['fname'] . ' ' . $name['lname']) }} - {{__('website\user\profile\profile.profile')}}
@endsection
@section('content')
    @include('website.includes.bar1')
    {{__('website\user\profile\profile.profile')}}
    @include('website.includes.bar2')
    {{__('website\user\profile\profile.profileset')}}
    @include('website.includes.bar3')
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('website.includes.sidebar')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            @include('website.includes.sessionDisplay')
                            <!-- Profile Settings Form -->
                            <form method="POST" action="{{ route('user.profile.update') }}">
                                @csrf
                                <div class="row form-row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{__('website\user\profile\profile.fname')}}</label>
                                            <input type="text" class="form-control" name="fname"
                                                value="{{ $user->name['fname'] }}">
                                        </div>
                                        @error('fname')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{__('website\user\profile\profile.lname')}}</label>
                                            <input type="text" class="form-control" name="lname"
                                                value="{{ $user->name['lname'] }}">
                                        </div>
                                        @error('lname')
                                            <div class=" alert alert-danger">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{__('website\user\profile\profile.birthdate')}}</label>
                                            <div class="">
                                                <input type="date" class="form-control datetimepicker" name="birthdate"
                                                    value="{{ $user->birthdate }}">
                                            </div>
                                        </div>
                                        @error('birthdate')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{__('website\user\profile\profile.gender')}}</label>
                                            <select class="form-control select" name="gender">
                                                <option @if ($user->gender == 'Male') {{ 'selected' }} @endif value="m">{{__('website\user\profile\profile.male')}}
                                                </option>
                                                <option @if ($user->gender == 'Female') {{ 'selected' }} @endif value="f">{{__('website\user\profile\profile.female')}}
                                                </option>
                                            </select>
                                        </div>
                                        @error('gender')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{__('website\user\profile\profile.email')}}</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $user->email }}">
                                        </div>
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{__('website\user\profile\profile.phone')}}</label>
                                            <input type="tel" name="phone" value="{{ $user->phone }}"
                                                class="form-control">
                                        </div>
                                        @error('phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">{{__('website\user\profile\profile.save')}}</button>
                                    </div>
                            </form>
                            <!-- /Profile Settings Form -->
                            <br><br><br>
                            <div class="col-12">
                                <div class="form-group">
                                    <p class="text-center">{{__('website\user\profile\profile.accstat')}}</p>
                                    @if ($user->email_verified_at == null)
                                        <div class="alert alert-warning">{{__('website\user\profile\profile.msg2')}}
                                            <form method="POST" action="{{ route('user.verification.send') }}">
                                                @csrf
                                                <button class="btn btn-link">{{__('website\user\profile\profile.resend')}}</button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="alert alert-success">{{__('website\user\profile\profile.msg1')}}</div>
                                    @endif
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
