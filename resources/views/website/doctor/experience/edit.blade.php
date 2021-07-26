@extends('website.layouts.layout')
@section('title')
    {{-- get the name of the user from the session --}}
    @php
    $name = Auth::guard('doc')->user()->name;
    @endphp
    {{ ucwords($name['fname_' . LaravelLocalization::getCurrentLocale() . ''] . ' ' . $name['lname_' . LaravelLocalization::getCurrentLocale() . '']) }}
    - Experiences
@endsection
@section('content')
    @include('website.includes.bar1')
    Profile
    @include('website.includes.bar2')
    Doctor Experiences
    @include('website.includes.bar3')
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('website.includes.sidebar')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Doctor Experiences
                                <hr>
                            </h4>
                            @include('website.includes.sessionDisplay')<br>
                            <!-- Experience Settings Form -->
                            <form method="POST" action="{{ route('doctor.experience.update') }}">
                                @method('PUT')
                                @csrf
                                <div class="row form-row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Title (Arabic)</label>
                                            <input type="text" class="form-control" name="title_ar"
                                                value="{{ $experience->title['title_ar'] }}">
                                        </div>
                                        @error('title_ar')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Title (English)</label>
                                            <input type="text" class="form-control" name="title_en"
                                                value="{{ $experience->title['title_en'] }}">
                                        </div>
                                        @error('title_en')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Place (Arabic)</label>
                                            <input type="text" class="form-control" name="place_ar"
                                                value="{{ $experience->place['place_ar'] }}">
                                        </div>
                                        @error('place_ar')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Place (English)</label>
                                            <input type="text" class="form-control" name="place_en"
                                                value="{{ $experience->place['place_en'] }}">
                                        </div>
                                        @error('place_en')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control select" name="status">
                                                <option selected disabled>Select your job status
                                                </option>
                                                <option value="0" @if ($experience->status == 'Left Job') {{ 'selected' }} @endif> Left Job
                                                </option>
                                                <option value="1" @if ($experience->status == 'Current Job') {{ 'selected' }} @endif>Current Job
                                                </option>
                                            </select>
                                        </div>
                                        @error('status')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <div class="">
                                                <input type="date" class="form-control datetimepicker" name="start_date"
                                                    value="{{ $experience->start_date }}">
                                            </div>
                                        </div>
                                        @error('start_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <div class="">
                                                <input type="date" class="form-control datetimepicker" name="end_date"
                                                    value="{{ $experience->end_date }}">
                                            </div>
                                        </div>
                                        @error('end_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
@endsection
