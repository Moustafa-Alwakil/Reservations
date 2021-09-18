@extends('dashboard.layouts.layout')
@section('title', 'Add Permission')
@section('content')
@include('dashboard.includes.pageHeader1')
Permissions
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Permissions</li>
<li class="breadcrumb-item">Add Permission</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-12">
        @include('website.includes.sessionDisplay')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Permission</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('permissions.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Provider</label>
                        <select class="form-control" name="provider">
                            <option disabled selected>Select provider</option>
                            <option value="web" @if(old('provider')== 'web'){{'selected'}} @endif>User</option>
                            <option value="doc" @if(old('provider')== 'doc'){{'selected'}} @endif>Doc</option>
                            <option value="admin" @if(old('provider')== 'admin'){{'selected'}} @endif>Admin</option>
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