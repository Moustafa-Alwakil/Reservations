@extends('website.layouts.layout')
@section('title')
    {{-- get the name of the user from the session --}}
    @php
    $name = Auth::guard('doc')->user()->name;
    @endphp
    {{ ucwords($name['fname_' . LaravelLocalization::getCurrentLocale() . ''] . ' ' . $name['lname_' . LaravelLocalization::getCurrentLocale() . '']) }}
    - Edit Clinic
@endsection
@section('content')
    @include('website.includes.bar1')
    Clinic
    @include('website.includes.bar2')
    Edit Clinic
    @include('website.includes.bar3')
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('website.includes.sidebar')
                <div class="col-md-7 col-lg-8 col-xl-9">

                    <!-- Basic Clinic Information -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Basic Clinic Information
                                <hr>
                            </h4>
                            @include('website.includes.sessionDisplay')<br>
                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('clinics.update', [$clinic->id]) }}">
                                @csrf
                                @method("PUT")
                                <div class="row form-row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Name (Arabic)</label>
                                            <input type="text" class="form-control select" name="name_ar"
                                                value="{{ $clinic->name['name_ar'] }}">
                                        </div>
                                        @error('name_ar')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Name (English)</label>
                                            <input type="text" class="form-control select" name="name_en"
                                                value="{{ $clinic->name['name_en'] }}">
                                        </div>
                                        @error('name_en')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="tel" class="form-control select" name="phone"
                                                value="{{ $clinic->phone }}">
                                        </div>
                                        @error('phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control select" name="status">
                                                <option selected disabled>Select your clinic status
                                                </option>
                                                <option value="0" @if ($clinic->status == 'Not Active') {{ 'selected' }} @endif>Not Active
                                                </option>
                                                <option value="1" @if ($clinic->status == 'Active') {{ 'selected' }} @endif>Active
                                                </option>
                                            </select>
                                        </div>
                                        @error('status')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Clinic Photos</label>
                                            <input class="form-control" type="file" id="Photos" name="photo[]" multiple>
                                        </div>
                                        @foreach ($clinic->clinicphotos as $clinicphoto)
                                            <div class="text-center">
                                                <img src="{{ $clinicphoto->photo }}" class="rounded" style="width:50%"
                                                    alt="Clinic Photos">
                                                <hr style="  height:0px;
                                                border-radius: 2px;
                                                $color: teal;
                                                color: $color;
                                                border: 2px solid currentColor;
                                                width: 80%;">
                                            </div>
                                        @endforeach
                                        @error('photo')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        @error('photo.*')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>License</label>
                                            <input class="form-control" type="file" id="license" name="license">
                                        </div>
                                        <div class="text-center">
                                            <img src="{{ $clinic->license }}" class="rounded" style="width:50%"
                                                alt="Clinic License">
                                        </div>
                                        @error('license')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- /Basic Clinic Information -->

                    <!-- Clinic Address -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Clinic Address
                                <hr>
                            </h4><br>
                            <div class="row form-row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <select class="form-control select" name="city" id="city">
                                            <option selected disabled>Select your clinic City
                                            </option>
                                            @isset($cities)
                                                @foreach ($cities['data'] as $city)
                                                    <option @if ($clinic->address->region->city_id == $city->id) {{ 'selected' }} @endif
                                                        value="{{ $city->id }}">
                                                        {{ $city->name['name_' . LaravelLocalization::getCurrentLocale()] }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                    @error('city')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Region</label>
                                        <select class="form-control select" name="region_id" id="region">
                                            <option selected disabled>Select your clinic Region
                                            </option>
                                                <option selected value="{{ $clinic->address->region->id }}">
                                                    {{ $clinic->address->region->name['name_' . LaravelLocalization::getCurrentLocale()] }}
                                                <option>
                                        </select>
                                    </div>
                                    @error('region_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Street (Arabic)</label>
                                        <input type="text" class="form-control select" name="street_ar"
                                            value="{{ $clinic->address->street['street_ar'] }}">
                                    </div>
                                    @error('street_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Street (English)</label>
                                        <input type="text" class="form-control select" name="street_en"
                                            value="{{ $clinic->address->street['street_en'] }}">
                                    </div>
                                    @error('street_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Building (Name Or Number)(Arabic)</label>
                                        <input type="text" class="form-control select" name="building_ar"
                                            value="{{ $clinic->address->building['building_ar'] }}">
                                    </div>
                                    @error('building_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Building (Name Or Number)(English)</label>
                                        <input type="text" class="form-control select" name="building_en"
                                            value="{{ $clinic->address->building['building_en'] }}">
                                    </div>
                                    @error('building_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Floor</label>
                                        <input type="text" class="form-control select" name="floor"
                                            value="{{ $clinic->address->floor }}">
                                    </div>
                                    @error('floor')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Apartment Number</label>
                                        <input type="text" class="form-control select" name="apartno"
                                            value="{{ $clinic->address->apartno }}">
                                    </div>
                                    @error('apartno')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Landmark (Arabic)</label>
                                        <input type="text" class="form-control select" name="landmark_ar"
                                            value="{{ $clinic->address->landmark['landmark_ar'] }}">
                                    </div>
                                    @error('landmark_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Landmark (English)</label>
                                        <input type="text" class="form-control select" name="landmark_en"
                                            value="{{ $clinic->address->landmark['landmark_en'] }}">
                                    </div>
                                    @error('landmark_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Clinic Address -->

                    <!-- Clinic Workdays -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Clinic Workdays
                                <hr>
                            </h4><br>
                            <div class="row form-row">
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Saturday</label>
                                        <select class="form-control select" name="sat_status">
                                            <option selected disabled>Select saturday status
                                            </option>
                                            <option value="0" @if ($clinic->workday->available['saturday']['sat_status'] == '0') {{ 'selected' }} @endif>Holiday
                                            </option>
                                            <option value="1" @if ($clinic->workday->available['saturday']['sat_status'] == 1) {{ 'selected' }} @endif>Workday
                                            </option>
                                        </select>
                                    </div>
                                    @error('sat_status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Start Time</label>
                                        <input type="time" class="form-control" name="sat_start_time"
                                            value="{{ $clinic->workday->available['saturday']['sat_start_time'] }}">
                                    </div>
                                    @error('sat_start_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>End Time</label>
                                        <input type="time" class="form-control" name="sat_end_time"
                                            value="{{ $clinic->workday->available['saturday']['sat_end_time'] }}">
                                    </div>
                                    @error('sat_end_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Exmination Duration</label>
                                        <input type="number" class="form-control" name="sat_duration"
                                            value="{{ $clinic->workday->available['saturday']['sat_duration'] }}}">
                                        <small class="text-secondary"> * You have to enter the duration in minutes</small>
                                    </div>
                                    @error('sat_duration')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Sunday</label>
                                        <select class="form-control select" name="sun_status">
                                            <option selected disabled>Select sunday status
                                            </option>
                                            <option value="0" @if ($clinic->workday->available['sunday']['sun_status'] == '0') {{ 'selected' }} @endif>Holiday
                                            </option>
                                            <option value="1" @if ($clinic->workday->available['sunday']['sun_status'] == 1) {{ 'selected' }} @endif>Workday
                                            </option>
                                        </select>
                                    </div>
                                    @error('sun_status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Start Time</label>
                                        <input type="time" class="form-control" name="sun_start_time"
                                            value="{{ $clinic->workday->available['sunday']['sun_start_time'] }}">
                                    </div>
                                    @error('sun_start_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>End Time</label>
                                        <input type="time" class="form-control" name="sun_end_time"
                                            value="{{ $clinic->workday->available['sunday']['sun_end_time'] }}">
                                    </div>
                                    @error('sun_end_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Exmination Duration</label>
                                        <input type="number" class="form-control" name="sun_duration"
                                            value="{{ $clinic->workday->available['sunday']['sun_duration'] }}">
                                        <small class="text-secondary"> * You have to enter the duration in minutes</small>
                                    </div>
                                    @error('sun_duration')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Monday</label>
                                        <select class="form-control select" name="mon_status">
                                            <option selected disabled>Select monday status
                                            </option>
                                            <option value="0" @if ($clinic->workday->available['monday']['mon_status'] == '0') {{ 'selected' }} @endif>Holiday
                                            </option>
                                            <option value="1" @if ($clinic->workday->available['monday']['mon_status'] == 1) {{ 'selected' }} @endif>Workday
                                            </option>
                                        </select>
                                    </div>
                                    @error('mon_status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Start Time</label>
                                        <input type="time" class="form-control" name="mon_start_time"
                                            value="{{ $clinic->workday->available['monday']['mon_start_time'] }}">
                                    </div>
                                    @error('mon_start_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>End Time</label>
                                        <input type="time" class="form-control" name="mon_end_time"
                                            value="{{ $clinic->workday->available['monday']['mon_end_time'] }}">
                                    </div>
                                    @error('mon_end_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Exmination Duration</label>
                                        <input type="number" class="form-control" name="mon_duration"
                                            value="{{ $clinic->workday->available['monday']['mon_duration'] }}">
                                        <small class="text-secondary"> * You have to enter the duration in minutes</small>
                                    </div>
                                    @error('mon_duration')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Tuesday</label>
                                        <select class="form-control select" name="tue_status">
                                            <option selected disabled>Select tuesday status
                                            </option>
                                            <option value="0" @if ($clinic->workday->available['tuesday']['tue_status'] == '0') {{ 'selected' }} @endif>Holiday
                                            </option>
                                            <option value="1" @if ($clinic->workday->available['tuesday']['tue_status'] == 1) {{ 'selected' }} @endif>Workday
                                            </option>
                                        </select>
                                    </div>
                                    @error('tue_status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Start Time</label>
                                        <input type="time" class="form-control" name="tue_start_time"
                                            value="{{ $clinic->workday->available['tuesday']['tue_start_time'] }}">
                                    </div>
                                    @error('tue_start_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>End Time</label>
                                        <input type="time" class="form-control" name="tue_end_time"
                                            value="{{ $clinic->workday->available['tuesday']['tue_end_time'] }}">
                                    </div>
                                    @error('tue_end_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Exmination Duration</label>
                                        <input type="number" class="form-control" name="tue_duration"
                                            value="{{ $clinic->workday->available['tuesday']['tue_duration'] }}">
                                        <small class="text-secondary"> * You have to enter the duration in minutes</small>
                                    </div>
                                    @error('tue_duration')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Wednesday</label>
                                        <select class="form-control select" name="wed_status">
                                            <option selected disabled>Select wednesday status
                                            </option>
                                            <option value="0" @if ($clinic->workday->available['wednesday']['wed_status'] == '0') {{ 'selected' }} @endif>Holiday
                                            </option>
                                            <option value="1" @if ($clinic->workday->available['wednesday']['wed_status'] == 1) {{ 'selected' }} @endif>Workday
                                            </option>
                                        </select>
                                    </div>
                                    @error('wed_status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Start Time</label>
                                        <input type="time" class="form-control" name="wed_start_time"
                                            value="{{ $clinic->workday->available['wednesday']['wed_start_time'] }}">
                                    </div>
                                    @error('wed_start_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>End Time</label>
                                        <input type="time" class="form-control" name="wed_end_time"
                                            value="{{ $clinic->workday->available['wednesday']['wed_end_time'] }}">
                                    </div>
                                    @error('wed_end_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Exmination Duration</label>
                                        <input type="number" class="form-control" name="wed_duration"
                                            value="{{ $clinic->workday->available['wednesday']['wed_duration'] }}">
                                        <small class="text-secondary"> * You have to enter the duration in minutes</small>
                                    </div>
                                    @error('wed_duration')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Thursday</label>
                                        <select class="form-control select" name="thu_status">
                                            <option selected disabled>Select thursday status
                                            </option>
                                            <option value="0" @if ($clinic->workday->available['thursday']['thu_status'] == '0') {{ 'selected' }} @endif>Holiday
                                            </option>
                                            <option value="1" @if ($clinic->workday->available['thursday']['thu_status'] == 1) {{ 'selected' }} @endif>Workday
                                            </option>
                                        </select>
                                    </div>
                                    @error('thu_status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Start Time</label>
                                        <input type="time" class="form-control" name="thu_start_time"
                                            value="{{ $clinic->workday->available['thursday']['thu_start_time'] }}">
                                    </div>
                                    @error('thu_start_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>End Time</label>
                                        <input type="time" class="form-control" name="thu_end_time"
                                            value="{{ $clinic->workday->available['thursday']['thu_end_time'] }}">
                                    </div>
                                    @error('thu_end_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Exmination Duration</label>
                                        <input type="number" class="form-control" name="thu_duration"
                                            value="{{ $clinic->workday->available['thursday']['thu_duration'] }}">
                                        <small class="text-secondary"> * You have to enter the duration in minutes</small>
                                    </div>
                                    @error('thu_duration')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Friday</label>
                                        <select class="form-control select" name="fri_status">
                                            <option selected disabled>Select friday status
                                            </option>
                                            <option value="0" @if ($clinic->workday->available['friday']['fri_status'] == '0') {{ 'selected' }} @endif>Holiday
                                            </option>
                                            <option value="1" @if ($clinic->workday->available['friday']['fri_status'] == 1) {{ 'selected' }} @endif>Workday
                                            </option>
                                        </select>
                                    </div>
                                    @error('fri_status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Start Time</label>
                                        <input type="time" class="form-control" name="fri_start_time"
                                            value="{{ $clinic->workday->available['friday']['fri_start_time'] }}">
                                    </div>
                                    @error('fri_start_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>End Time</label>
                                        <input type="time" class="form-control" name="fri_end_time"
                                            value="{{ $clinic->workday->available['friday']['fri_end_time'] }}">
                                    </div>
                                    @error('fri_end_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Exmination Duration</label>
                                        <input type="number" class="form-control" name="fri_duration"
                                            value="{{ $clinic->workday->available['friday']['fri_duration'] }}">
                                        <small class="text-secondary"> * You have to enter the duration in minutes</small>
                                    </div>
                                    @error('fri_duration')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Clinic Workdays -->

                    <!-- Clinic Services -->
                    <div class="card contact-card">
                        <div class="card-body">
                            <h4 class="card-title">Clinic Services
                                <hr>
                            </h4><br>
                            <div class="row form-row">
                                <div class="col-12">
                                    <h4 class="card-title mb-4">What services is your clinic will Provide?</h4>
                                    @isset($services)
                                        @foreach ($services as $service)
                                                <div class="payment-list">
                                                    <label class="payment-radio credit-card-option mb-3">
                                                        <input type="checkbox" value="{{ $service->id }}"
                                                            name="service_id[{{ $service->id }}]" @foreach ($clinic->services as $services)  @if ($services->service_id==$service->id)
                                                        {{ 'checked' }} @endif
                                            @endforeach>
                                            <span class="checkmark"></span>
                                            {{ $service->name['name_' . LaravelLocalization::getCurrentLocale()] }}
                                            </label>
                                    </div>
                                    @endforeach
                                @endisset
                                <small class="text-secondary"> * These services based on your specialist.</small>
                                @error('service_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('service_id.*')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Clinic Services -->

                <!-- Pricing -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Clinic Price
                            <hr>
                        </h4><br>
                        <div class="row form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Exmination Price</label>
                                    <input type="number" class="form-control select" name="price"
                                        value="{{ $clinic->examfee->price }}">
                                    <small class="text-secondary"> * The price is in EGP currency.</small>
                                </div>
                                @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Pricing -->
                <div class="submit-section submit-btn-bottom">
                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@php
$locale = LaravelLocalization::getCurrentLocale();
$urlParameter = $clinic->id;
@endphp
@section('scripts')
    <script type='text/javascript'>
        $(document).ready(function() {

            // Department Change
            $('#city').change(function() {

                // Department id
                var id = $(this).val();

                // Empty the dropdown
                $('#region').find('option').not(':first').remove();

                // AJAX request 
                $.ajax({
                    url: '/clinics/{'
                    <?php echo $urlParameter; ?> '}/edit/getregions/' + id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {

                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {
                                console.log(len);
                                var id = response['data'][i].id;
                                var name = response['data'][i].name;

                                var option = "<option value='" + id + "'>" + name
                                    .name_<?php echo $locale; ?> + "</option>";

                                $("#region").append(option);
                            }
                        }

                    }
                });
            });

        });
    </script>
@endsection
