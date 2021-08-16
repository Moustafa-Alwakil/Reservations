@extends('dashboard.layouts.layout')
@section('title', 'Edit Experience')
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
                <h4 class="card-title">Edit Experience</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('experiences.update', ['experience' => $experience->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Title (Arabic)</label>
                        <input type="text" class="form-control" name="title_ar" value="{{ $experience->title['title_ar'] }}">
                    </div>
                    @error('title_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Title (English)</label>
                        <input type="text" class="form-control" name="title_en" value="{{ $experience->title['title_en'] }}">
                    </div>
                    @error('title_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Place (Arabic)</label>
                        <input type="text" class="form-control" name="place_ar" value="{{ $experience->place['place_ar']}}">
                    </div>
                    @error('place_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Place (English)</label>
                        <input type="text" class="form-control" name="place_en" value="{{ $experience->place['place_en'] }}">
                    </div>
                    @error('place_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" class="form-control" name="start_date" value="{{ $experience->start_date }}">
                    </div>
                    @error('start_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" class="form-control" name="end_date" value="{{ $experience->end_date }}">
                    </div>
                    @error('end_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="0" @if ($experience->status == 'Left Job') {{ 'selected' }} @endif>Left Job</option>
                            <option value="1" @if ($experience->status == 'Current Job') {{ 'selected' }} @endif>Current Job</option>
                        </select>
                    </div>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Doctor</label>
                        <select class="form-control" name="physican_id">
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}" @if ($experience->physican->id == $doctor->id) {{ 'selected' }} @endif>
                                    {{ ucwords($doctor->name['fname_en'] . ' ' . $doctor->name['lname_en']) }}</option>
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
