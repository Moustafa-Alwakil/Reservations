@extends('dashboard.layouts.layout')
@section('title', 'User Reset Password')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Users
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Users</li>
    <li class="breadcrumb-item">Reset Password</li>
    @include('dashboard.includes.pageHeader3')
    <div class="row">
        <div class="col-12">
            @include('website.includes.sessionDisplay')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Reset Password For {{ucwords($user->name['fname'].' '.$user->name['lname'])}}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.resetpass.update') }}">
                        @csrf
                        <input type="text" name="id" hidden value="{{$user->id}}">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
