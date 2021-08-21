@extends('dashboard.layouts.layout')
@section('title', 'Add Clinic Service')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Clinic Services
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Clinic Services</li>
    <li class="breadcrumb-item">Add Clinic Service</li>
    @include('dashboard.includes.pageHeader3')
    <div class="row">
        <div class="col-12">
            @include('website.includes.sessionDisplay')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Clinic Services</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('clinicservices.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Doctor</label>
                            <select class="form-control" name="doctor" id="doctor">
                                <option disabled selected>Select doctor</option>
                                @foreach ($doctors['data'] as $doctor)
                                    <option value="{{ $doctor->id }}" @if (old('doctor') == $doctor->id) {{ 'selected' }} @endif>
                                        {{ ucwords($doctor->name['fname_en'] . ' ' . $doctor->name['lname_en']) }} - {{ ucwords($doctor->name['fname_ar'] . ' ' . $doctor->name['lname_ar']) }}</option>
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
                                        {{ $clinic->name['name_en'] }} - {{ $clinic->name['name_ar'] }}
                                    <option>
                                @endif
                            </select>
                        </div>
                        @error('clinic_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Services</label>
                            <select class="form-control" name="service_id" id="service">
                                <option selected disabled>Select service</option>
                                @php
                                    use App\Models\Service;
                                    $service = Service::select()
                                        ->where('id', old('service_id'))
                                        ->first();
                                @endphp
                                @if (old('service_id'))
                                    <option selected value="{{ old('service_id') }}">
                                        {{ $service->name['name_en'] }} - {{ $service->name['name_ar'] }}
                                    <option>
                                @endif
                            </select>
                        </div>
                        @error('service_id')
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
                                var id = response['data'][i].id;
                                var name = response['data'][i].name;

                                var option = "<option value='" + id + "'>" + name
                                    .name_en +  " - " + name.name_ar + "</option>";

                                $("#clinic").append(option);
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

                $('#service').find('option').not(':first').remove();

                $.ajax({
                    url: 'getservices/' + id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {

                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].id;
                                var name = response['data'][i].name;

                                var option = "<option value='" + id + "'>" + name
                                    .name_en + " - " + name.name_ar+"</option>";

                                $("#service").append(option);
                            }
                        }

                    }
                });
            });
        });
    </script>
@endsection
