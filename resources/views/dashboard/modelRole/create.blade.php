@extends('dashboard.layouts.layout')
@section('title', 'Add Model Role')
@section('content')
@include('dashboard.includes.pageHeader1')
Models Roles
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Models Roles</li>
<li class="breadcrumb-item">Add Model Role</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Model Role</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('modelsroles.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Admin</label>
                        <select class="form-control" name="admin_id">
                            <option disabled selected>Select Admin</option>
                            @foreach ($admins as $admin)
                            <option value={{$admin->id}} @if(old('admin_id')== $admin->id){{'selected'}} @endif>{{ucwords($admin->name). ' - Email: ' .$admin->email}}</option> 
                            @endforeach
                        </select>
                    </div>
                    @error('admin_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role_name">
                            <option disabled selected>Select Role</option>
                            @foreach ($roles as $role)
                            <option value={{$role->name}} @if(old('role_name')== $role->name){{'selected'}} @endif>{{$role->name. ' - provider: ' .$role->guard_name}}</option> 
                            @endforeach
                        </select>
                    </div>
                    @error('role_name')
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