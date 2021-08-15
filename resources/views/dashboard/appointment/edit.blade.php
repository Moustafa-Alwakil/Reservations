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
                        <label>Clinic</label>
                        <select class="form-control" name="clinic_id">
                            <option selected disabled>Select clinic</option>
                            @foreach ($clinics as $clinic)
                                <option value="{{ $clinic->id }}" @if ($appointment->clinic->id == $clinic->id) {{ 'selected' }} @endif>{{ $clinic->name['name_en'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('clinic_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>City</label>
                        <select class="form-control" name="user_id">
                            <option selected disabled>Select user</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if ($appointment->user->id == $user->id) {{ 'selected' }} @endif>{{ ucwords($user->name['fname'].' '.$user->name['lname']) }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('city_id')
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