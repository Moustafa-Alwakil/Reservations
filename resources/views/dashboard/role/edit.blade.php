@extends('dashboard.layouts.layout')
@section('title', 'Edit Role')
@section('content')
@include('dashboard.includes.pageHeader1')
Roles
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Roles</li>
<li class="breadcrumb-item">Edit Role</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Role</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('roles.update',['role'=>$role->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $role->name}}">
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Provider</label>
                        <select class="form-control" name="provider">
                            <option disabled selected>Select provider</option>
                            <option value="web" @if($role->guard_name== 'web'){{'selected'}} @endif>User</option>
                            <option value="doc" @if($role->guard_name== 'doc'){{'selected'}} @endif>Doc</option>
                            <option value="admin" @if($role->guard_name== 'admin'){{'selected'}} @endif>Admin</option>
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