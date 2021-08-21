@extends('dashboard.layouts.layout')
@section('title', 'Add Workday')
@section('content')
@include('dashboard.includes.pageHeader1')
Workdays
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Workdays</li>
<li class="breadcrumb-item">Add Workday</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Workday</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('workdays.store') }}">
                    @csrf
                    <div class="row form-row">
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>Saturday</label>
                                <select class="form-control select" name="sat_status">
                                    <option selected disabled>Select saturday status
                                    </option>
                                    <option value="0" @if (old('sat_status') == '0') {{ 'selected' }} @endif>Holiday
                                    </option>
                                    <option value="1" @if (old('sat_status') == 1) {{ 'selected' }} @endif>Workday
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
                                    value="{{ old('sat_start_time') }}">
                            </div>
                            @error('sat_start_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>End Time</label>
                                <input type="time" class="form-control" name="sat_end_time"
                                    value="{{ old('sat_end_time') }}">
                            </div>
                            @error('sat_end_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>Exmination Duration</label>
                                <input type="number" class="form-control" name="sat_duration"
                                    value="{{ old('sat_duration') }}">
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
                                    <option value="0" @if (old('sun_status') == '0') {{ 'selected' }} @endif>Holiday
                                    </option>
                                    <option value="1" @if (old('sun_status') == 1) {{ 'selected' }} @endif>Workday
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
                                    value="{{ old('sun_start_time') }}">
                            </div>
                            @error('sun_start_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>End Time</label>
                                <input type="time" class="form-control" name="sun_end_time"
                                    value="{{ old('sun_end_time') }}">
                            </div>
                            @error('sun_end_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>Exmination Duration</label>
                                <input type="number" class="form-control" name="sun_duration"
                                    value="{{ old('sun_duration') }}">
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
                                    <option value="0" @if (old('mon_status') == '0') {{ 'selected' }} @endif>Holiday
                                    </option>
                                    <option value="1" @if (old('mon_status') == 1) {{ 'selected' }} @endif>Workday
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
                                    value="{{ old('mon_start_time') }}">
                            </div>
                            @error('mon_start_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>End Time</label>
                                <input type="time" class="form-control" name="mon_end_time"
                                    value="{{ old('mon_end_time') }}">
                            </div>
                            @error('mon_end_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>Exmination Duration</label>
                                <input type="number" class="form-control" name="mon_duration"
                                    value="{{ old('mon_duration') }}">
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
                                    <option value="0" @if (old('tue_status') == '0') {{ 'selected' }} @endif>Holiday
                                    </option>
                                    <option value="1" @if (old('tue_status') == 1) {{ 'selected' }} @endif>Workday
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
                                    value="{{ old('tue_start_time') }}">
                            </div>
                            @error('tue_start_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>End Time</label>
                                <input type="time" class="form-control" name="tue_end_time"
                                    value="{{ old('tue_end_time') }}">
                            </div>
                            @error('tue_end_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>Exmination Duration</label>
                                <input type="number" class="form-control" name="tue_duration"
                                    value="{{ old('tue_duration') }}">
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
                                    <option value="0" @if (old('wed_status') == '0') {{ 'selected' }} @endif>Holiday
                                    </option>
                                    <option value="1" @if (old('wed_status') == 1) {{ 'selected' }} @endif>Workday
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
                                    value="{{ old('wed_start_time') }}">
                            </div>
                            @error('wed_start_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>End Time</label>
                                <input type="time" class="form-control" name="wed_end_time"
                                    value="{{ old('wed_end_time') }}">
                            </div>
                            @error('wed_end_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>Exmination Duration</label>
                                <input type="number" class="form-control" name="wed_duration"
                                    value="{{ old('wed_duration') }}">
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
                                    <option value="0" @if (old('thu_status') == '0') {{ 'selected' }} @endif>Holiday
                                    </option>
                                    <option value="1" @if (old('thu_status') == 1) {{ 'selected' }} @endif>Workday
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
                                    value="{{ old('thu_start_time') }}">
                            </div>
                            @error('thu_start_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>End Time</label>
                                <input type="time" class="form-control" name="thu_end_time"
                                    value="{{ old('thu_end_time') }}">
                            </div>
                            @error('thu_end_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>Exmination Duration</label>
                                <input type="number" class="form-control" name="thu_duration"
                                    value="{{ old('thu_duration') }}">
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
                                    <option value="0" @if (old('fri_status') == '0') {{ 'selected' }} @endif>Holiday
                                    </option>
                                    <option value="1" @if (old('fri_status') == 1) {{ 'selected' }} @endif>Workday
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
                                    value="{{ old('fri_start_time') }}">
                            </div>
                            @error('fri_start_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>End Time</label>
                                <input type="time" class="form-control" name="fri_end_time"
                                    value="{{ old('fri_end_time') }}">
                            </div>
                            @error('fri_end_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>Exmination Duration</label>
                                <input type="number" class="form-control" name="fri_duration"
                                    value="{{ old('fri_duration') }}">
                                <small class="text-secondary"> * You have to enter the duration in minutes</small>
                            </div>
                            @error('fri_duration')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
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