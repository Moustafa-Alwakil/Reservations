@extends('website.layouts.layout')
@section('title')
    {{-- get the name of the user from the session --}}
    @php
    $name = Auth::guard('doc')->user()->name;
    @endphp
    {{ ucwords($name['fname_' . LaravelLocalization::getCurrentLocale() . ''] . ' ' . $name['lname_' . LaravelLocalization::getCurrentLocale() . '']) }}
    - Information
@endsection
@section('content')
    @include('website.includes.bar1')
    Profile
    @include('website.includes.bar2')
    Doctor Information
    @include('website.includes.bar3')
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('website.includes.sidebar')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            @include('website.includes.sessionDisplay')
                            <!-- Profile Settings Form -->
                            @php
                                use App\Models\Info;
                            @endphp
                            @if (Info::firstWhere('physican_id', Auth::guard('doc')->user()->id))
                                @if (Auth::guard('doc')->user()->status == 0)
                                    <div class="alert alert-warning">Your license hasn't been accepted yet.</div>
                                @elseif(Auth::guard('doc')->user()->status == 1)
                                <div class="alert alert-success">Your license has been accepted.</div>
                                @endif
                                <form method="POST" action="{{ route('doctor.info.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                @else
                                    <form method="POST" action="{{ route('doctor.info.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                            @endif
                            <div class="row form-row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <select class="form-control select" name="title">
                                            <option selected disabled>Select your proffesional title
                                            </option>
                                            <option value="1" @isset($info) @if ($info->title == 1) {{ 'selected' }} @endif @endisset @if(old('title')== 1) {{'selected'}}@endif>Professor
                                            </option>
                                            <option value="2" @isset($info) @if ($info->title == 2) {{ 'selected' }} @endif @endisset @if(old('title')== 2) {{'selected'}}@endif>Lecturer
                                            </option>
                                            <option value="3" @isset($info) @if ($info->title == 3) {{ 'selected' }} @endif @endisset @if(old('title')== 3) {{'selected'}}@endif>Consultant
                                            </option>
                                            <option value="4" @isset($info) @if ($info->title == 4) {{ 'selected' }} @endif @endisset @if(old('title')== 4) {{'selected'}}@endif>Specialist
                                            </option>
                                            <option value="5" @isset($info) @if ($info->title == 5) {{ 'selected' }} @endif @endisset @if(old('title')== 5) {{'selected'}}@endif>Assistant
                                                Lecturer
                                            </option>
                                            <option value="6" @isset($info) @if ($info->title == 6) {{ 'selected' }} @endif @endisset @if(old('title')== 6) {{'selected'}}@endif>Assistant
                                                Proffessor
                                            </option>
                                        </select>
                                    </div>
                                    @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>License</label>
                                        <input class="form-control" type="file" id="license" name="license">
                                    </div>
                                    @isset($info)
                                        <div class="text-center">
                                            <img src="{{ $info->license }}" class="rounded" style="width:50%" alt="License">
                                        </div>
                                    @endisset
                                    @error('license')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Personal Photo</label>
                                        <input class="form-control" type="file" id="photo" name="photo">
                                    </div>
                                    @isset($info)
                                        <div class="text-center">
                                            <img src="{{ $info->photo }}" class="rounded" style="width:50%" alt="Personal Photo">
                                        </div>
                                    @endisset
                                    @error('photo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>About (Arabic)</label>
                                        <textarea class="form-control" name='about_ar'
                                            rows="4">@isset($info){{ $info->about['about_ar'] }}@endisset {{old('about_ar')}}</textarea>
                                        </div>
                                        @error('about_ar')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>About (English)</label>
                                            <textarea class="form-control" name='about_en'
                                                rows="4">@isset($info){{ $info->about['about_en'] }}@endisset {{old('about_en')}}</textarea>
                                            </div>
                                            @error('about_en')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="submit-section">
                                            <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                        </div>
                                        </form>
                                        <!-- /Profile Settings Form -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /Page Content -->

            @endsection
