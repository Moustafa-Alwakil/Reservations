@extends('dashboard.layouts.layout')
@section('title', 'Edit Address')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Addresses
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Addresses</li>
    <li class="breadcrumb-item">Edit Address</li>
    @include('dashboard.includes.pageHeader3')
    <div class="row">
        <div class="col-12">
            @include('website.includes.sessionDisplay')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Address</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('addresses.update', ['address' => $address->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Building (Arabic)</label>
                            <input type="text" class="form-control" name="building_ar"
                                value="{{ $address->building['building_ar'] }}">
                        </div>
                        @error('building_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Building (English)</label>
                            <input type="text" class="form-control" name="building_en"
                                value="{{ $address->building['building_en'] }}">
                        </div>
                        @error('building_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Street (Arabic)</label>
                            <input type="text" class="form-control" name="street_ar"
                                value="{{ $address->street['street_ar'] }}">
                        </div>
                        @error('street_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Street (English)</label>
                            <input type="text" class="form-control" name="street_en"
                                value="{{ $address->street['street_en'] }}">
                        </div>
                        @error('street_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Floor</label>
                            <input type="text" class="form-control" name="floor" value="{{ $address->floor }}">
                        </div>
                        @error('floor')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Apatrment No.</label>
                            <input type="text" class="form-control" name="apartno" value="{{ $address->apartno }}">
                        </div>
                        @error('apartno')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Landmark (Arabic)</label>
                            <input type="text" class="form-control" name="landmark_ar"
                                value="{{ $address->landmark['landmark_ar'] }}">
                        </div>
                        @error('landmark_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Landmark (English)</label>
                            <input type="text" class="form-control" name="landmark_en"
                                value="{{ $address->landmark['landmark_en'] }}">
                        </div>
                        @error('landmark_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Doctor</label>
                            <select class="form-control" name="doctor" id="doctor">
                                <option disabled>Select doctor
                                </option>
                                @foreach ($doctors['data'] as $doctor)
                                </option>
                                    <option value="{{ $doctor->id }}" @if ($address->clinic->physican->id == $doctor->id) {{ 'selected' }} @endif>
                                        {{ ucwords($doctor->name['fname_en'] . ' ' . $doctor->name['lname_en']) }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('doctor')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Clinic</label>
                            <select class="form-control" name="clinic_id" id="clinic">
                                <option disabled>Select clinic
                                </option>
                                <option selected value="{{ $address->clinic->id }}">
                                    {{ $address->clinic->name['name_en'] }}</option>
                            </select>
                        </div>
                        @error('clinic_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>City</label>
                            <select class="form-control" name="city_id" id="city">
                                <option disabled>Select city
                                </option>
                                @foreach ($cities['data'] as $city)
                                    <option value="{{ $city->id }}" @if ($address->region->city->id == $city->id) {{ 'selected' }} @endif>{{ $city->name['name_en'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('city_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Region</label>
                            <select class="form-control" name="region_id" id="region">
                                <option disabled>Select Region
                                </option>
                                <option selected value="{{ $address->region->id }}">
                                    {{ $address->region->name['name_en'] }}
                                </option>
                            </select>
                        </div>
                        @error('region_id')
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
                    url: '{{ route('addresses.index') }}/edit/getregions/{{ $address->id }}/' +
                        id,
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
                                var id = response['data'][i].id;
                                var name = response['data'][i].name;

                                var option = "<option value='" + id + "'>" + name
                                    .name_en + "</option>";

                                $("#region").append(option);
                            }
                        }

                    }
                });
            });
        });
    </script>
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
                    url: '{{ route('addresses.index') }}/edit/getregions/{{ $address->id }}/' +
                        id,
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
                                var id = response['data'][i].id;
                                var name = response['data'][i].name;

                                var option = "<option value='" + id + "'>" + name
                                    .name_en + "</option>";

                                $("#region").append(option);
                            }
                        }

                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#doctor').change(function() {

                var id = $(this).val();

                $('#clinic').find('option').not(':first').remove();

                $.ajax({
                    url: '{{ route('addresses.index') }}/edit/getclinics/{{ $address->id }}/' +
                        id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {

                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            for (var i = 0; i < len; i++) {
                                console.log(len);
                                var id = response['data'][i].id;
                                var name = response['data'][i].name;

                                var option = "<option value='" + id + "'>" + name
                                    .name_en + "</option>";

                                $("#clinic").append(option);
                            }
                        }

                    }
                });
            });
        });
    </script>
@endsection
