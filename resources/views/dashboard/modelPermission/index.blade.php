@extends('dashboard.layouts.layout')
@section('title', 'All Models Permissions')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Models Permissions
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Models Permissions</li>
    <li class="breadcrumb-item">All Models Permissions</li>
    @include('dashboard.includes.pageHeader3')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    @include('website.includes.sessionDisplay')
                    <div class="table-responsive">
                        <table class="datatable table table-stripped text-center">
                            <thead>
                                <tr>
                                    <th>Admin Name</th>
                                    <th>Admin Email</th>
                                    <th>Permission Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($modelPermissions as $modelPermission)
                                    <tr>
                                        <td>{{ ucwords($modelPermission->name) }}</td>
                                        <td>{{ $modelPermission->email }}</td>
                                        <td>{{ $modelPermission->permission_name }}</td>
                                        <td>
                                            <form method="POST" class="d-inline"
                                                action="{{ route('modelspermissions.destroy', ['permission_id' => $modelPermission->permission_id, 'model_id' => $modelPermission->model_id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
