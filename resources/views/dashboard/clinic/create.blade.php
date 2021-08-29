@extends('dashboard.layouts.layout')
@section('title', 'Add Clinic')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Clinics
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Clinics</li>
    <li class="breadcrumb-item">Add Clinic</li>
    @include('dashboard.includes.pageHeader3')
    <div class="row">
        <div class="col-12">
            @include('website.includes.sessionDisplay')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Clinic</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('adminclinics.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Name (Arabic)</label>
                            <input type="text" class="form-control" name="name_ar" value="{{ old('name_ar') }}">
                        </div>
                        @error('name_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Name (English)</label>
                            <input type="text" class="form-control" name="name_en" value="{{ old('name_en') }}">
                        </div>
                        @error('name_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                        </div>
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>License</label>
                            <input type="file" class="form-control" name="license">
                        </div>
                        @error('license')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Review Status</label>
                        <select name="review" class="form-control">
                            <option selected disabled>Select review status</option>
                            <option value="0" @if (old('review')=='0'){{'selected'}}@endif>Refused</option>
                            <option value="1" @if (old('review')==1){{'selected'}}@endif>Accepted</option>
                            <option value="2" @if (old('review')==2){{'selected'}}@endif>Waiting</option>
                        </select>
                        </div>
                        @error('review')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Status</label>
                        <select name="status" class="form-control">
                            <option selected disabled>Select status</option>
                            <option value="0" @if (old('status')=='0'){{'selected'}}@endif>Not Active</option>
                            <option value="1" @if (old('status')==1){{'selected'}}@endif>Active</option>
                        </select>
                        </div>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Doctor</label>
                        <select name="physican_id" class="form-control">
                            <option selected disabled>Select doctor</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{$doctor->id}}" @if (old('physican_id') == $doctor->id) {{ 'selected' }} @endif>{{ucwords($doctor->name['fname_en'].' '.$doctor->name['lname_en'])}} - {{ucwords($doctor->name['fname_ar'].' '.$doctor->name['lname_ar'])}}</option>
                            @endforeach
                        </select>
                        </div>
                        @error('physican_id')
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
