@extends('dashboard.layouts.layout')
@section('title', 'Profile')
@section('content')
@include('dashboard.includes.pageHeader1')
Change Password
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item"><a href="{{ route('admin.profile') }}">Profile</a></li>
<li class="breadcrumb-item active">Change Password</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-md-12">
        @include('website.includes.sessionDisplay')
        <!-- Change Password Tab -->
        <div id="password_tab" class="tab-pane fade show active">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Change Password</h5>
                    <div class="row">
                        <div class="col-md-10 col-lg-6">
                            <form method="POST" action="{{ route('admin.changepass.update') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Old Password</label>
                                    <input name="oldpassword" type="password" class="form-control">
                                </div>
                                @error('oldpassword')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input name="password" type="password" class="form-control">
                                </div>
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input name="password_confirmation" type="password" class="form-control">
                                </div>
                                <button class="btn btn-primary" type="submit">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Change Password Tab -->

    </div>
</div>
</div>
@endsection
