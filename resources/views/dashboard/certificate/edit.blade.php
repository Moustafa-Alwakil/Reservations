@extends('dashboard.layouts.layout')
@section('title', 'Edit Certificate')
@section('content')
@include('dashboard.includes.pageHeader1')
Certificates
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Certificates</li>
<li class="breadcrumb-item">Edit Certificate</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Certificate</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('certificates.update', ['certificate' => $certificate->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>University Or Place(Arabic)</label>
                        <input type="text" class="form-control" name="university_ar"
                            value="{{ $certificate->university['university_ar'] }}">
                    </div>
                    @error('university_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>University Or Place(English)</label>
                        <input type="text" class="form-control" name="university_en"
                            value="{{ $certificate->university['university_en'] }}">
                    </div>
                    @error('university_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Field of degree (Arabic)</label>
                        <input type="text" class="form-control" name="field_ar" value="{{ $certificate->field['field_ar'] }}">
                    </div>
                    @error('field_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Field of degree (English)</label>
                        <input type="text" class="form-control" name="field_en" value="{{ $certificate->field['field_en'] }}">
                    </div>
                    @error('field_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" class="form-control" name="start_date"
                            value="{{ $certificate->start_date }}">
                    </div>
                    @error('start_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" class="form-control" name="end_date" value="{{ $certificate->end_date }}">
                    </div>
                    @error('end_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Degree</label>
                        <select class="form-control" name="type">
                            <option disabled>Select degree</option>
                            <option value="1" @if ($certificate->type == 'Bachelor') {{ 'selected' }} @endif>Bachelor</option>
                            <option value="2" @if ($certificate->type == 'Master') {{ 'selected' }} @endif>Master</option>
                            <option value="3" @if ($certificate->type == 'PHD') {{ 'selected' }} @endif>PHD</option>
                            <option value="4" @if ($certificate->type == 'Fellowship') {{ 'selected' }} @endif>Fellowship</option>
                        </select>
                    </div>
                    @error('type')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" class="form-control" name="photo">
                    </div>
                    @error('photo')
                        <div class=" alert alert-danger">{{ $message }}
                        </div>
                    @enderror
                    <div class="d-flex justify-content-center">
                        <img src="{{ $certificate->photo }}" alt="certificate" width="50%" height="50%">
                    </div>
                    <div class="form-group">
                        <label>Doctor</label>
                        <select class="form-control" name="physican_id">
                            <option disabled>Select doctor
                            </option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}" @if ($certificate->physican->id == $doctor->id) {{ 'selected' }} @endif>
                                    {{ ucwords($doctor->name['fname_en'] . ' ' . $doctor->name['lname_en']) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('physican_id')
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
