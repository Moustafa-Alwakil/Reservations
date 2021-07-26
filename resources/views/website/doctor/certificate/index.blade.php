@extends('website.layouts.layout')
@section('title')
    {{-- get the name of the user from the session --}}
    @php
    $name = Auth::guard('doc')->user()->name;
    @endphp
    {{ ucwords($name['fname_' . LaravelLocalization::getCurrentLocale() . ''] . ' ' . $name['lname_' . LaravelLocalization::getCurrentLocale() . '']) }}
    - Certificates
@endsection
@section('content')
    @include('website.includes.bar1')
    Profile
    @include('website.includes.bar2')
    Doctor Certificates
    @include('website.includes.bar3')
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('website.includes.sidebar')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Doctor Certicates<hr></h4>
                            @include('website.includes.sessionDisplay')<br>
                            <!-- Certificate Settings Form -->
                            <form method="POST" action="{{ route('doctor.certificate.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row form-row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select class="form-control select" name="type">
                                                <option selected disabled>Select your certificate type
                                                </option>
                                                <option value="1" @if(old('type')== 1) {{'selected'}}@endif>Bachelor
                                                </option>
                                                <option value="2" @if(old('type')== 2) {{'selected'}}@endif>Master
                                                </option>
                                                <option value="3" @if(old('type')== 3) {{'selected'}}@endif>PHD
                                                </option>
                                                <option value="4" @if(old('type')== 4) {{'selected'}}@endif>Fellowship
                                                </option>
                                            </select>
                                        </div>
                                        @error('type')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Photo</label>
                                            <input class="form-control" type="file" id="photo" name="photo">
                                        </div>
                                        @error('photo')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                    </div>
                            </form>
                            <!-- /Certificate Settings Form -->
                        </div>
                    </div>
                </div>
                @isset($certificates)
                    <div class="card-body">
                        <!-- Certificates Preview -->
                        @foreach ($certificates as $certificate)
                            <div class="card text-center">
                                <img src="{{ $certificate->photo }}" class="card-img-top mx-auto" style="width:50%" alt="certificate">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $certificate->type }}</h5>
                                    <p class="card-text">Upload date: {{ $certificate->created_at }}</p>
                                    <a href="{{ $certificate->photo }}" class="btn btn-primary" target="_blank">Preview</a>
                                    <form class="d-inline" method="POST" action="{{ route('doctor.certificate.destroy') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="text" name="id" hidden value="{{ $certificate->id }}">
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        <!-- /Certificates Preview  -->
                    </div>
                </div>
            </div>
        @endisset
    </div>
    </div>

    </div>
    <!-- /Page Content -->

@endsection
