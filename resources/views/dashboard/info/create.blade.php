@extends('dashboard.layouts.layout')
@section('title', 'Add Information')
@section('content')
@include('dashboard.includes.pageHeader1')
Informations
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Informations</li>
<li class="breadcrumb-item">Add Information</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Information</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('infos.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <select class="form-control" name="title">
                            <option disabled selected>Select title</option>
                            <option value="1" @if(old('title')== 1){{'selected'}} @endif>Professor</option>
                            <option value="2" @if(old('title')== 2){{'selected'}} @endif>Lecturer</option>
                            <option value="3" @if(old('title')== 3){{'selected'}} @endif>Consultant</option>
                            <option value="4" @if(old('title')== 4){{'selected'}} @endif>Specialist</option>
                            <option value="5" @if(old('title')== 5){{'selected'}} @endif>Assistant Lecturer</option>
                            <option value="6" @if(old('title')== 6){{'selected'}} @endif>Assistant Proffesor</option>
                        </select>
                    </div>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" class="form-control" name="photo">
                    </div>
                    @error('photo')
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
                        <label>About (Arabic)</label>
                        <textarea class="form-control" name='about_ar'
                        rows="4">{{ old('about_ar') }}</textarea>
                    </div>
                    @error('about_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>About (English)</label>
                        <textarea class="form-control" name='about_en'
                        rows="4">{{ old('about_en') }}</textarea>
                    </div>
                    @error('about_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Doctor</label>
                        <select class="form-control" name="physican_id">
                            <option disabled selected>Select doctor</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{$doctor->id}}" @if (old('physican_id') == $doctor->id) {{ 'selected' }} @endif>{{ucwords($doctor->name['fname_en'].' '.$doctor->name['lname_en'])}}</option>
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