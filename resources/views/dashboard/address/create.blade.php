@extends('dashboard.layouts.layout')
@section('title', 'Add Address')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Addresses
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Addresses</li>
    <li class="breadcrumb-item">Add Address</li>
    @include('dashboard.includes.pageHeader3')
    <div class="row">
        <div class="col-12">
            @include('website.includes.sessionDisplay')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Address</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('addresses.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Building (Arabic)</label>
                            <input type="text" class="form-control" name="building_ar" value="{{ old('building_ar') }}">
                        </div>
                        @error('building_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Building (English)</label>
                            <input type="text" class="form-control" name="building_en" value="{{ old('building_en') }}">
                        </div>
                        @error('building_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Street (Arabic)</label>
                            <input type="text" class="form-control" name="street_ar" value="{{ old('street_ar') }}">
                        </div>
                        @error('street_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Street (English)</label>
                            <input type="text" class="form-control" name="street_en" value="{{ old('street_en') }}">
                        </div>
                        @error('street_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Floor</label>
                            <input type="text" class="form-control" name="floor" value="{{ old('floor') }}">
                        </div>
                        @error('floor')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Apatrment No.</label>
                            <input type="text" class="form-control" name="apartno" value="{{ old('apartno') }}">
                        </div>
                        @error('apartno')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Landmark (Arabic)</label>
                            <input type="text" class="form-control" name="landmark_ar" value="{{ old('landmark_ar') }}">
                        </div>
                        @error('landmark_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Landmark (English)</label>
                            <input type="text" class="form-control" name="landmark_en" value="{{ old('landmark_en') }}">
                        </div>
                        @error('landmark_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Doctor</label>
                            <select class="form-control" name="doctor" id="doctor">
                                <option disabled selected>Select doctor</option>
                                @foreach ($doctors['data'] as $doctor)
                                    <option value="{{$doctor->id}}" @if (old('doctor') == $doctor->id) {{ 'selected' }} @endif>{{ucwords($doctor->name['fname_en'].' '.$doctor->name['lname_en'])}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('doctor')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Clinic</label>
                            <select class="form-control" name="clinic_id" id="clinic">
                                <option selected disabled>Select clinic</option>
                                @php
                                    use App\Models\Clinic;
                                    $clinic = Clinic::select()
                                        ->where('id', old('clinic_id'))
                                        ->first();
                                @endphp
                                @if (old('clinic_id'))
                                    <option selected value="{{ old('clinic_id') }}">
                                        {{ $clinic->name['name_en'] }}
                                    <option>
                                @endif
                            </select>
                        </div>
                        @error('clinic_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>City</label>
                            <select class="form-control" name="city_id" id="city">
                                <option selected disabled>Select city</option>
                                @foreach ($cities['data'] as $city)
                                    <option value="{{ $city->id }}" @if (old('city_id') == $city->id) {{ 'selected' }} @endif>{{ $city->name['name_en'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('city_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Region</label>
                            <select class="form-control" name="region_id" id="region">
                                <option selected disabled>Select region</option>
                                @php
                                    use App\Models\Region;
                                    $region = Region::select()
                                        ->where('id', old('region_id'))
                                        ->first();
                                @endphp
                                @if (old('region_id'))
                                    <option selected value="{{ old('region_id') }}">
                                        {{ $region->name['name_en'] }}
                                    <option>
                                @endif
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
                    url: 'getregions/' + id,
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
                    url: 'getclinics/' + id,
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
