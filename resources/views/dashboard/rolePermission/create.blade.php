@extends('dashboard.layouts.layout')
@section('title', 'Add Role Permission')
@section('content')
@include('dashboard.includes.pageHeader1')
Roles Permissions
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Roles Permissions</li>
<li class="breadcrumb-item">Add Role Permission</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Role Permission</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('rolespermissions.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role_id">
                            <option disabled selected>Select Role</option>
                            @foreach ($roles as $role)
                            <option value={{$role->id}} @if(old('role_id')== $role->id){{'selected'}} @endif>{{$role->name. ' - provider: ' .$role->guard_name}}</option> 
                            @endforeach
                        </select>
                    </div>
                    @error('role_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Permission</label>
                        <select class="form-control" name="permission_id">
                            <option disabled selected>Select Permission</option>
                            @foreach ($permissions as $permission)
                            <option value={{$permission->id}} @if(old('permission_id')== $permission->id){{'selected'}} @endif>{{$permission->name .' - provider: ' .$permission->guard_name}}</option> 
                            @endforeach
                        </select>
                    </div>
                    @error('permission_id')
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