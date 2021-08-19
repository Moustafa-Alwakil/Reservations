@extends('dashboard.layouts.layout')
@section('title', 'Edit Examfee')
@section('content')
@include('dashboard.includes.pageHeader1')
Examfees
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Examfees</li>
<li class="breadcrumb-item">Edit Examfee</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Examfee</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('examfees.update',['examfee'=>$examfee->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control" name="price" value="{{$examfee->price }}">
                    </div>
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Doctor</label>
                        <select class="form-control" name="doctor" id="doctor">
                            <option disabled>Select doctor
                            </option>
                            @foreach ($doctors['data'] as $doctor)
                                <option value="{{$doctor->id}}" @if ($examfee->clinic->physican->id == $doctor->id) {{ 'selected' }} @endif>{{ucwords($doctor->name['fname_en'].' '.$doctor->name['lname_en'])}}</option>
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
                            <option selected value="{{$examfee->clinic->id}}">{{$examfee->clinic->name['name_en']}}</option>
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
            url: '{{route('examfees.index')}}/edit/getclinics/{{$examfee->id}}/'+id,
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