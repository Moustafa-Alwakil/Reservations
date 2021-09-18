@extends('dashboard.layouts.layout')
@section('title', 'All Permissions')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Permissions
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Permissions</li>
    <li class="breadcrumb-item">All Permissions</li>
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
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Provider</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            @if ($permission->guard_name == 'web')
                                                User
                                            @elseif($permission->guard_name == 'doc')
                                                Doctor
                                            @elseif($permission->guard_name == 'admin')
                                                Admin
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('permissions.edit', ['permission' => $permission->id]) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form method="POST" class="d-inline"
                                                action="{{ route('permissions.destroy', ['permission' => $permission->id]) }}">
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
