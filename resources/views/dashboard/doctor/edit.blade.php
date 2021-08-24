@extends('dashboard.layouts.layout')
@section('title', 'Edit Doctor')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Doctors
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Doctors</li>
    <li class="breadcrumb-item">Edit Doctor</li>
    @include('dashboard.includes.pageHeader3')
    <div class="row">
        <div class="col-12">
            @include('website.includes.sessionDisplay')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Doctor</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('doctors.update',['doctor'=>$doctor->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>First Name (Arabic)</label>
                            <input type="text" class="form-control" name="fname_ar" value="{{ $doctor->name['fname_ar'] }}">
                        </div>
                        @error('fname_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Last Name (Arabic)</label>
                            <input type="text" class="form-control" name="lname_ar" value="{{ $doctor->name['lname_ar'] }}">
                        </div>
                        @error('lname_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>First Name (English)</label>
                            <input type="text" class="form-control" name="fname_en" value="{{ $doctor->name['fname_en'] }}">
                        </div>
                        @error('fname_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Last Name (English)</label>
                            <input type="text" class="form-control" name="lname_en" value="{{ $doctor->name['lname_en'] }}">
                        </div>
                        @error('lname_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $doctor->email }}">
                        </div>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Birthdate</label>
                            <input type="date" class="form-control" name="birthdate" value="{{ $doctor->birthdate }}">
                        </div>
                        @error('birthdate')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option selected disabled>Select gender</option>
                            <option value="m" @if ($doctor->gender == 'Male'){{'selected'}}@endif>Male</option>
                            <option value="f" @if ($doctor->gender == 'Female'){{'selected'}}@endif>Female</option>
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
