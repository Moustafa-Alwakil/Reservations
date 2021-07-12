@extends('website.layouts.layout')
@section('title')
    <?php Auth::guard('web')->check();
    $name = Auth::guard('web')->user()->name; ?>
    {{ $name['fname'] . ' ' . $name['lname'] }} - Change Password
@endsection
@section('content')
    @include('website.includes.bar1')
    Change Password
    @include('website.includes.bar2')
    Change Password
    @include('website.includes.bar3')
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('website.includes.sidebar')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    @include('website.includes.sessionDisplay')
                                    <!-- Change Password Form -->
                                    <form method="POST"
                                        action="{{ route('user.changepass.update')}}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input type="password" class="form-control" name="oldpassword">
                                        </div>
                                        @error('oldpassword')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirmation">
                                        </div>
                                        <div class="submit-section">
                                            <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
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
