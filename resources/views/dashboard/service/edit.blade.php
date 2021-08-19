@extends('dashboard.layouts.layout')
@section('title', 'Edit Service')
@section('content')
@include('dashboard.includes.pageHeader1')
Services
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Services</li>
<li class="breadcrumb-item">Edit Service</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Service</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('services.update',['service'=>$service->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name (Arabic)</label>
                        <input type="text" class="form-control" name="name_ar" value="{{ $service->name['name_ar']}}">
                    </div>
                    @error('name_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Name (English)</label>
                        <input type="text" class="form-control" name="name_en" value="{{ $service->name['name_en'] }}">
                    </div>
                    @error('name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option disabled>Select status
                            </option>
                            <option value="0" @if($service->status == 'Not Active'){{'selected'}} @endif>Not Active</option>
                            <option value="1" @if($service->status == 'Active'){{'selected'}} @endif>Active</option>
                        </select>
                    </div>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Department</label>
                        <select class="form-control" name="department_id">
                            <option disabled>Select department
                            </option>
                            @foreach ($departments as $department)
                            <option value="{{$department->id}}" @if($service->department_id == $department->id){{'selected'}} @endif>{{$department->name['name_en']}} - {{$department->name['name_ar']}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('department_id')
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