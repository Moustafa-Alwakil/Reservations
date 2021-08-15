@extends('dashboard.layouts.layout')
@section('title', 'Add certificate')
@section('content')
@include('dashboard.includes.pageHeader1')
Certificates
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Certificates</li>
<li class="breadcrumb-item">Add certificate</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add certificate</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('certificates.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control" name="type">
                            <option disabled selected>Select type</option>
                            <option value="1" @if(old('type')==1){{'selected'}} @endif>Bachelor</option>
                            <option value="2" @if(old('type')==2){{'selected'}} @endif>Master</option>
                            <option value="3" @if(old('type')==3){{'selected'}} @endif>PHD</option>
                            <option value="4" @if(old('type')==4){{'selected'}} @endif>Fellowship</option>
                        </select>
                    </div>
                    @error('type')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" class="form-control" name="photo"">
                    </div>
                    @error('photo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Doctor</label>
                        <select class="form-control" name="physican_id">
                            <option selected disabled>Select Doctor</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}" @if (old('physican_id') == $doctor->id) {{ 'selected' }} @endif>{{ ucwords($doctor->name['fname_en'].' '.$doctor->name['lname_en']) }}</option>
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