@extends('dashboard.layouts.layout')
@section('title', 'Edit Exception')
@section('content')
@include('dashboard.includes.pageHeader1')
Exceptions
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Exceptions</li>
<li class="breadcrumb-item">Edit Exception</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Exception</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('exceptions.update',['exception'=>$exception->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" value="{{ $exception->date }}">
                    </div>
                    @error('date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Start time</label>
                        <input type="time" class="form-control" name="start_time" value="{{ $exception->start_time }}">
                    </div>
                    @error('start_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>End time</label>
                        <input type="time" class="form-control" name="end_time" value="{{ $exception->end_time }}">
                    </div>
                    @error('end_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Doctor</label>
                        <select class="form-control" name="doctor" id="doctor">
                            <option disabled>Select doctor
                            </option>
                            @foreach ($doctors['data'] as $doctor)
                                <option value="{{$doctor->id}}" @if ($exception->clinic->physican->id == $doctor->id) {{ 'selected' }} @endif>{{ucwords($doctor->name['fname_en'].' '.$doctor->name['lname_en'])}}</option>
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
                            <option value="{{$exception->clinic->id }}" selected>{{$exception->clinic->name['name_en']}}</option>
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
            url: '{{route('exceptions.index')}}/edit/getclinics/{{$exception->id}}/'+id,
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