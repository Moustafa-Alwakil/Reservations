@extends('dashboard.layouts.layout')
@section('title', 'Edit Region')
@section('content')
@include('dashboard.includes.pageHeader1')
Regions
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Regions</li>
<li class="breadcrumb-item">Edit Region</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Region</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('regions.update',['region'=>$region->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name (Arabic)</label>
                        <input type="text" class="form-control" name="name_ar" value="{{ $region->name['name_ar']}}">
                    </div>
                    @error('name_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Name (English)</label>
                        <input type="text" class="form-control" name="name_en" value="{{ $region->name['name_en'] }}">
                    </div>
                    @error('name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="0" @if($region->status == 'Not Active'){{'selected'}} @endif>Not Active</option>
                            <option value="1" @if($region->status == 'Active'){{'selected'}} @endif>Active</option>
                        </select>
                    </div>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="city_id">
                            @foreach ($cities as $city)
                            <option value="{{$city->id}}" @if($region->city_id == $city->id){{'selected'}} @endif>{{$city->name['name_en']}}</option>
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