@extends('dashboard.layouts.layout')
@section('title', 'Edit Clinic Photo')
@section('content')
@include('dashboard.includes.pageHeader1')
Clinic Photos
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Clinic Photos</li>
<li class="breadcrumb-item">Add Clinic Photo</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Clinic Photo</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('clinicphotos.update', ['clinicphoto' => $clinicPhoto->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" class="form-control" name="photo">
                    </div>
                    @error('photo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="d-flex justify-content-center">
                        <img src="{{ $clinicPhoto->photo }}" alt="certificate" width="50%" height="50%">
                    </div>
                    <div class="form-group">
                        <label>Doctor</label>
                        <select class="form-control" name="doctor" id="doctor">
                            @foreach ($doctors['data'] as $doctor)
                                <option value="{{ $doctor->id }}" @if ($clinicPhoto->clinic->physican->id == $doctor->id) {{ 'selected' }} @endif>
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
                            <option selected value="{{ $clinicPhoto->clinic->id }}">
                                {{ $clinicPhoto->clinic->name['name_en'] }}</option>
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
                url: '{{ route('clinicphotos.index') }}/edit/getclinics/{{ $clinicPhoto->id }}/' +
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
