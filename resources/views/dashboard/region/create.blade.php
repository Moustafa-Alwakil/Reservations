@extends('dashboard.layouts.layout')
@section('title', 'Add Region')
@section('content')
@include('dashboard.includes.pageHeader1')
Regions
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Regions</li>
<li class="breadcrumb-item">Add Region</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Region</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('regions.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Name (Arabic)</label>
                        <input type="text" class="form-control" name="name_ar" value="{{ old('name_ar') }}">
                    </div>
                    @error('name_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Name (English)</label>
                        <input type="text" class="form-control" name="name_en" value="{{ old('name_en') }}">
                    </div>
                    @error('name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option disabled selected>Select status</option>
                            <option value="0" @if(old('status')== '0'){{'selected'}} @endif>Not Active</option>
                            <option value="1" @if(old('status')== 1){{'selected'}} @endif>Active</option>
                        </select>
                    </div>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="city_id">
                            <option disabled selected>Select city</option>
                            @foreach ($cities as $city)
                            <option value="{{$city->id}}" @if(old('city_id')== $city->id){{'selected'}} @endif>{{$city->name['name_en']}}</option>
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