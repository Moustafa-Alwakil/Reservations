@extends('dashboard.layouts.layout')
@section('title', 'Edit Permission')
@section('content')
@include('dashboard.includes.pageHeader1')
Permissions
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Permissions</li>
<li class="breadcrumb-item">Edit Permission</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Permission</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('permissions.update',['permission'=>$permission->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $permission->name}}">
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Provider</label>
                        <select class="form-control" name="provider">
                            <option disabled selected>Select provider</option>
                            <option value="web" @if($permission->guard_name== 'web'){{'selected'}} @endif>User</option>
                            <option value="doc" @if($permission->guard_name== 'doc'){{'selected'}} @endif>Doc</option>
                            <option value="admin" @if($permission->guard_name== 'admin'){{'selected'}} @endif>Admin</option>
                        </select>
                    </div>
                    @error('provider')
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