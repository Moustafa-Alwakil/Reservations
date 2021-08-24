@extends('dashboard.layouts.layout')
@section('title', 'Add User')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Users
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Users</li>
    <li class="breadcrumb-item">Add User</li>
    @include('dashboard.includes.pageHeader3')
    <div class="row">
        <div class="col-12">
            @include('website.includes.sessionDisplay')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add User</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="fname" value="{{ old('fname') }}">
                        </div>
                        @error('fname')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="lname" value="{{ old('lname') }}">
                        </div>
                        @error('lname')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                        </div>
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Birthdate</label>
                            <input type="date" class="form-control" name="birthdate" value="{{ old('birthdate') }}">
                        </div>
                        @error('birthdate')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option selected disabled>Select gender</option>
                            <option value="m" @if (old('gender')=='m'){{'selected'}}@endif>Male</option>
                            <option value="f" @if (old('gender')=='f'){{'selected'}}@endif>Female</option>
                        </select>
                        </div>
                        @error('gender')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
