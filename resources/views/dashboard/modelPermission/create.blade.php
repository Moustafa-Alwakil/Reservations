@extends('dashboard.layouts.layout')
@section('title', 'Add Model Permission')
@section('content')
@include('dashboard.includes.pageHeader1')
Models Permissions
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Models Permissions</li>
<li class="breadcrumb-item">Add Model Permission</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Model Permission</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('modelspermissions.store') }}">
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
                        <label>Permission</label>
                        <select class="form-control" name="permission_name">
                            <option disabled selected>Select Permission</option>
                            @foreach ($permissions as $permission)
                            <option value={{$permission->name}} @if(old('permission_name')== $permission->name){{'selected'}} @endif>{{$permission->name. ' - provider: ' .$permission->guard_name}}</option> 
                            @endforeach
                        </select>
                    </div>
                    @error('permission_name')
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