@extends('dashboard.layouts.layout')
@section('title', 'Edit Appointment')
@section('content')
@include('dashboard.includes.pageHeader1')
Appointments
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Appointments</li>
<li class="breadcrumb-item">Edit Appointment</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Appointment</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('appointments.update',['appointment'=>$appointment->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Bookdate</label>
                        <input type="date" class="form-control" name="bookdate" value="{{ date_format(date_create($appointment->bookdate),'Y-m-d') }}">
                    </div>
                    @error('bookdate')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" value="{{ $appointment->date }}">
                    </div>
                    @error('date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Start time</label>
                        <input type="time" class="form-control" name="start_time" value="{{ $appointment->start_time }}">
                    </div>
                    @error('start_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>End time</label>
                        <input type="time" class="form-control" name="end_time" value="{{ $appointment->end_time }}">
                    </div>
                    @error('end_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option disabled>Select status
                            </option>
                            <option value="0" @if($appointment->status==0){{'selected'}} @endif>Waiting</option>
                            <option value="1" @if($appointment->status==1){{'selected'}} @endif>Accepted</option>
                            <option value="2" @if($appointment->status==2){{'selected'}} @endif>Refused</option>
                            <option value="3" @if($appointment->status==3){{'selected'}} @endif>Canceled</option>
                        </select>
                    </div>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Doctor</label>
                        <select class="form-control" name="doctor" id="doctor">
                            <option disabled>Select doctor
                            </option>
                            @foreach ($doctors['data'] as $doctor)
                                <option value="{{ $doctor->id }}" @if ($appointment->clinic->physican->id == $doctor->id) {{ 'selected' }} @endif>
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
                            <option selected value="{{ $appointment->clinic->id }}">
                                {{ $appointment->clinic->name['name_en'] }}</option>
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
                                <option value="{{ $user->id }}" @if ($appointment->user->id == $user->id) {{ 'selected' }} @endif>{{ ucwords($user->name['fname'].' '.$user->name['lname']) }}</option>
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
                url: '{{ route('appointments.index') }}/edit/getclinics/{{ $appointment->id }}/' +
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