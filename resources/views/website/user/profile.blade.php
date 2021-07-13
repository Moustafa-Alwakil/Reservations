@extends('website.layouts.layout')
@section('title')
    @php
    Auth::guard('web')->check();
    $name = Auth::guard('web')->user()->name;
    @endphp
    {{ $name['fname'] . ' ' . $name['lname'] }} - Profile
@endsection
@section('content')
    @include('website.includes.bar1')
    Profile
    @include('website.includes.bar2')
    Profile Settings
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
                                            <label>First Name</label>
                                            <input type="text" class="form-control" name="fname"
                                                value="{{ $user->name['fname'] }}">
                                        </div>
                                        @error('fname')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
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
                                            <label>Date of Birth</label>
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
                                            <label>gender</label>
                                            <select class="form-control select" name="gender">
                                                <option @if ($user->gender == 'Male') {{ 'selected' }} @endif value="m">Male
                                                </option>
                                                <option @if ($user->gender == 'Female') {{ 'selected' }} @endif value="f">Female
                                                </option>
                                            </select>
                                        </div>
                                        @error('gender')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $user->email }}">
                                        </div>
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="tel" name="phone" value="{{ $user->phone }}"
                                                class="form-control">
                                        </div>
                                        @error('phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Account status</label>
                                            @if ($user->email_verified_at == null)
                                                <input type="text" class="form-control bg-warning" disabled
                                                    value="The account isn't verified, please check yor mail inbox to verify your account.">
                                            @else
                                                <input type="text" class="form-control bg-success" disabled
                                                    value="Your account is verified.">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                    </div>
                            </form>
                            <!-- /Profile Settings Form -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->

@endsection
