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
                            @include('website.includes.sessionDisplay')
                            <!-- Profile Settings Form -->
                            <form method="POST" action="{{ route('doctor.experience.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row form-row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Title (Arabic)</label>
                                            <input type="text" class="form-control" name="title_ar"
                                                value="{{ old('title_ar') }}">
                                        </div>
                                        @error('title_ar')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Title (English)</label>
                                            <input type="text" class="form-control" name="title_en"
                                                value="{{ old('title_en') }}">
                                        </div>
                                        @error('title_en')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Place (Arabic)</label>
                                            <input type="text" class="form-control" name="place_ar"
                                                value="{{ old('place_ar') }}">
                                        </div>
                                        @error('place_ar')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Place (English)</label>
                                            <input type="text" class="form-control" name="place_en"
                                                value="{{ old('place_en') }}">
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
                                                <option value="0" @if (old('status') == '0') {{ 'selected' }} @endif> Left Job
                                                </option>
                                                <option value="1" @if (old('status') == 1) {{ 'selected' }} @endif>Current Job
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
                                                    value="{{ old('start_date') }}">
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
                                                <input type="date" class="form-control datetimepicker" name="end_date">
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
                            <!-- /Profile Settings Form -->
                        </div>
                    </div>
                </div>
                @isset($experiences)
                    <div class="card-body">
                        <!-- Certificates Preview -->
                        @foreach ($experiences as $experience)
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Status:
                                        {{ $experience->status}}</h5>
                                    <h5 class="card-title">Title:
                                        {{ $experience->title['title_' . LaravelLocalization::getCurrentLocale() . ''] }}</h5>
                                    <p class="card-text">Place:
                                        {{ $experience->place['place_' . LaravelLocalization::getCurrentLocale() . ''] }}</p>
                                    <p class="card-text">Start date: {{ $experience->start_date }}</p>
                                    @php
                                        $start_date = date_create($experience->start_date);
                                        $end_date = date_create($experience->end_date);
                                        $diff = date_diff($start_date, $end_date);
                                    @endphp
                                    @if ($experience->end_date)
                                    <p class="card-text">End date: {{ $experience->end_date }}</p>
                                    @endif
                                    <p class="card-text">Duration: {{ $diff->format('%y Years %m Months %d Days') }}</p>
                                    <form class="d-inline" method="POST" action="{{ route('doctor.experience.destroy') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="text" name="id" hidden value="{{ $experience->id }}">
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        <!-- /Certificates Preview  -->
                    </div>
                </div>
            </div>
        @endisset
    </div>
    </div>

    </div>
    <!-- /Page Content -->

@endsection
