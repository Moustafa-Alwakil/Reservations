@extends('website.layouts.layout')
@section('title')
    {{-- get the name of the user from the session --}}
    @php
    $name = Auth::guard('doc')->user()->name;
    @endphp
    {{ ucwords($name['fname_' . LaravelLocalization::getCurrentLocale() . ''] . ' ' . $name['lname_' . LaravelLocalization::getCurrentLocale() . '']) }}
    - Profile
@endsection
@section('content')
    @include('website.includes.bar1')
    Profile
    @include('website.includes.bar2')
    General Profile
    @include('website.includes.bar3')
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('website.includes.sidebar')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">General Profile<hr></h4>
                            @include('website.includes.sessionDisplay')<br>
                            <!-- Profile Settings Form -->
                            <form method="POST" action="{{ route('doctor.profile.update') }}">
                                @csrf
                                <div class="row form-row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>First Name (Arabic)</label>
                                            <input type="text" class="form-control" name="fname_ar"
                                                value="{{ $doctor->name['fname_ar'] }}">
                                        </div>
                                        @error('fname_ar')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Last Name (Arabic)</label>
                                            <input type="text" class="form-control" name="lname_ar"
                                                value="{{ $doctor->name['lname_ar'] }}">
                                        </div>
                                        @error('lname_ar')
                                            <div class=" alert alert-danger">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>First Name (English)</label>
                                            <input type="text" class="form-control" name="fname_en"
                                                value="{{ $doctor->name['fname_en'] }}">
                                        </div>
                                        @error('fname_en')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Last Name (English)</label>
                                            <input type="text" class="form-control" name="lname_en"
                                                value="{{ $doctor->name['lname_en'] }}">
                                        </div>
                                        @error('lname_en')
                                            <div class=" alert alert-danger">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <div class="">
                                                <input type="date" class="form-control datetimepicker" name="birthdate"
                                                    value="{{ $doctor->birthdate }}">
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
                                                <option @if ($doctor->gender == 'Male') {{ 'selected' }} @endif value="m">Male
                                                </option>
                                                <option @if ($doctor->gender == 'Female') {{ 'selected' }} @endif value="f">Female
                                                </option>
                                            </select>
                                        </div>
                                        @error('gender')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $doctor->email }}">
                                        </div>
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                    </div>
                            </form>
                            <!-- /Profile Settings Form -->
                            <br><br><br>
                            <div class="col-12">
                                <div class="form-group">
                                    <p class="text-center">Account status</p>
                                    @if ($doctor->email_verified_at == null)
                                        <div class="alert alert-warning">The account isn't verified, please check
                                            yor mail inbox to verify your account.
                                            <form method="POST" action="{{ route('doctor.verification.send') }}">
                                                @csrf
                                                <button class="btn btn-link">Resend Verification Email</button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="alert alert-success">Your account is verified.</div>
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
