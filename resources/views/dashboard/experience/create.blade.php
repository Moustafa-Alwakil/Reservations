@extends('dashboard.layouts.layout')
@section('title', 'Add Experience')
@section('content')
@include('dashboard.includes.pageHeader1')
Experiences
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Experiences</li>
<li class="breadcrumb-item">Add Experience</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Experience</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('experiences.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Title (Arabic)</label>
                        <input type="text" class="form-control" name="title_ar" value="{{ old('title_ar') }}">
                    </div>
                    @error('title_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Title (English)</label>
                        <input type="text" class="form-control" name="title_en" value="{{ old('title_en') }}">
                    </div>
                    @error('title_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Place (Arabic)</label>
                        <input type="text" class="form-control" name="place_ar" value="{{ old('place_ar') }}">
                    </div>
                    @error('place_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Place (English)</label>
                        <input type="text" class="form-control" name="place_en" value="{{ old('place_en') }}">
                    </div>
                    @error('place_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}">
                    </div>
                    @error('start_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}">
                    </div>
                    @error('end_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option disabled selected>Select status</option>
                            <option value="0" @if(old('status')== '0'){{'selected'}} @endif>Left Job</option>
                            <option value="1" @if(old('status')== 1){{'selected'}} @endif>Current Job</option>
                        </select>
                    </div>
                    @error('status')
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