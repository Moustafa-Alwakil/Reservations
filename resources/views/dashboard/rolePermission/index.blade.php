@extends('dashboard.layouts.layout')
@section('title', 'All Roles Permissions')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Roles Permissions
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Roles Permissions</li>
    <li class="breadcrumb-item">All Roles Permissions</li>
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
                                    <th>Role</th>
                                    <th>Role Provider</th>
                                    <th>Permission</th>
                                    <th>Permission Provider</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rolesPermissions as $rolesPermission)
                                    <tr>
                                        <td>{{ $rolesPermission->role_name }}</td>
                                        <td>
                                            @if ($rolesPermission->role_guard == 'web')
                                                User
                                            @elseif($rolesPermission->role_guard == 'doc')
                                                Doctor
                                            @elseif($rolesPermission->role_guard == 'admin')
                                                Admin
                                            @endif
                                        </td>
                                        <td>{{ $rolesPermission->permission_name }}</td>
                                        <td>
                                            @if ($rolesPermission->permission_guard == 'web')
                                                User
                                            @elseif($rolesPermission->permission_guard == 'doc')
                                                Doctor
                                            @elseif($rolesPermission->permission_guard == 'admin')
                                                Admin
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('rolespermissions.edit', ['role_id' => $rolesPermission->role_id, 'permission_id' => $rolesPermission->permission_id,]) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form method="POST" class="d-inline"
                                                action="{{ route('rolespermissions.destroy', ['role_id' => $rolesPermission->role_id, 'permission_id' => $rolesPermission->permission_id,]) }}">
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
