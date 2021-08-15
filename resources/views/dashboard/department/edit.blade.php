@extends('dashboard.layouts.layout')
@section('title', 'Edit Department')
@section('content')
@include('dashboard.includes.pageHeader1')
Departments
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Departments</li>
<li class="breadcrumb-item">Edit Department</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Department</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('departments.update',['department'=>$department->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name (Arabic)</label>
                        <input type="text" class="form-control" name="name_ar" value="{{$department->name['name_ar']}}">
                    </div>
                    @error('name_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Name (English)</label>
                        <input type="text" class="form-control" name="name_en" value="{{ $department->name['name_en'] }}">
                    </div>
                    @error('name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option disabled selected>Select status</option>
                            <option value="0" @if($department->status== 'Not Active'){{'selected'}} @endif>Not Active</option>
                            <option value="1" @if($department->status== 'Active'){{'selected'}} @endif>Active</option>
                        </select>
                    </div>
                    @error('status')
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