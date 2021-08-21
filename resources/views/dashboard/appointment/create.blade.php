@extends('dashboard.layouts.layout')
@section('title', 'Add Appointment')
@section('content')
@include('dashboard.includes.pageHeader1')
Appointments
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Appointments</li>
<li class="breadcrumb-item">Add Appointment</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Appointment</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('appointments.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Bookdate</label>
                        <input type="date" class="form-control" name="bookdate" value="{{ old('bookdate') }}">
                    </div>
                    @error('bookdate')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" value="{{ old('date') }}">
                    </div>
                    @error('date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Start time</label>
                        <input type="time" class="form-control" name="start_time" value="{{ old('start_time') }}">
                    </div>
                    @error('start_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>End time</label>
                        <input type="time" class="form-control" name="end_time" value="{{ old('end_time') }}">
                    </div>
                    @error('end_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option disabled selected>Select status</option>
                            <option value="0" @if(old('status')=='0'){{'selected'}} @endif>Waiting</option>
                            <option value="1" @if(old('status')==1){{'selected'}} @endif>Accepted</option>
                            <option value="2" @if(old('status')==2){{'selected'}} @endif>Refused</option>
                            <option value="3" @if(old('status')==3){{'selected'}} @endif>Canceled</option>
                        </select>
                    </div>
                    @error('status')
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
                        <label>User</label>
                        <select class="form-control" name="user_id">
                            <option selected disabled>Select user</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if (old('user_id') == $user->id) {{ 'selected' }} @endif>{{ ucwords($user->name['fname'].' '.$user->name['lname']) }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('user_id')
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