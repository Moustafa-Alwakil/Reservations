@extends('dashboard.layouts.layout')
@section('title', 'Edit Clinic Service')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Clinic Services
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Clinic Services</li>
    <li class="breadcrumb-item">Edit Clinic Service</li>
    @include('dashboard.includes.pageHeader3')
    <div class="row">
        <div class="col-12">
            @include('website.includes.sessionDisplay')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Clinic Services</h4>
                </div>
                <div class="card-body">
                    <form method="POST"
                        action="{{ route('clinicservices.update', ['clinicservice' => $clinicService->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Doctor</label>
                            <select class="form-control" name="doctor" id="doctor">
                                <option disabled selected>Select doctor</option>
                                <option selected value="{{ $clinicService->clinic->physican->id }}">
                                    {{ ucwords($clinicService->clinic->physican->name['fname_en'] . ' ' . $clinicService->clinic->physican->name['lname_en']) }}
                                    -
                                    {{ ucwords($clinicService->clinic->physican->name['fname_ar'] . ' ' . $clinicService->clinic->physican->name['lname_ar']) }}
                                </option>
                            </select>
                        </div>
                        @error('doctor')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Clinic</label>
                            <select class="form-control" name="clinic_id" id="clinic">
                                <option selected disabled>Select clinic</option>
                                <option selected value="{{ $clinicService->clinic->id }}">
                                    {{ $clinicService->clinic->name['name_en'] }} -
                                    {{ $clinicService->clinic->name['name_ar'] }}</option>
                            </select>
                        </div>
                        @error('clinic_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Services</label>
                            <select class="form-control" name="service_id" id="service">
                                <option selected disabled>Select service</option>
                                @foreach ($services as $service)
                                    <option value="{{$service->id}}" @if($clinicService->service->id == $service->id){{'selected'}}@endif>{{ $service->name['name_en'] }} -
                                        {{ $service->name['name_ar'] }}</option>
                                @endforeach
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
