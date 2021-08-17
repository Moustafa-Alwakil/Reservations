@extends('dashboard.layouts.layout')
@section('title', 'Add Information')
@section('content')
@include('dashboard.includes.pageHeader1')
Informations
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Informations</li>
<li class="breadcrumb-item">Edit Information</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Information</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('infos.update', ['info' => $info->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Title</label>
                        <select class="form-control" name="title">
                            <option value="1" @if ($info->title == 1) {{ 'selected' }} @endif>Professor</option>
                            <option value="2" @if ($info->title == 2) {{ 'selected' }} @endif>Lecturer</option>
                            <option value="3" @if ($info->title == 3) {{ 'selected' }} @endif>Consultant</option>
                            <option value="4" @if ($info->title == 4) {{ 'selected' }} @endif>Specialist</option>
                            <option value="5" @if ($info->title == 5) {{ 'selected' }} @endif>Assistant Lecturer</option>
                            <option value="6" @if ($info->title == 6) {{ 'selected' }} @endif>Assistant Proffesor</option>
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
                    <div class="d-flex justify-content-center">
                        <img src="{{ $info->photo }}" alt="certificate" width="50%" height="50%">
                    </div>
                    <div class="form-group">
                        <label>License</label>
                        <input type="file" class="form-control" name="license">
                    </div>
                    @error('license')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="d-flex justify-content-center">
                        <img src="{{ $info->license }}" alt="certificate" width="50%" height="50%">
                    </div>
                    <div class="form-group">
                        <label>About (Arabic)</label>
                        <textarea class="form-control" name='about_ar' rows="4">{{ $info->about['about_ar'] }}</textarea>
                    </div>
                    @error('about_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>About (English)</label>
                        <textarea class="form-control" name='about_en' rows="4">{{ $info->about['about_en'] }}</textarea>
                    </div>
                    @error('about_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Doctor</label>
                        <select class="form-control" name="physican_id">
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}" @if ($info->physican->id == $doctor->id) {{ 'selected' }} @endif>
                                    {{ ucwords($doctor->name['fname_en'] . ' ' . $doctor->name['lname_en']) }}
                                </option>
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
