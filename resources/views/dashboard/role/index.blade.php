@extends('dashboard.layouts.layout')
@section('title', 'All Roles')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Roles
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Roles</li>
    <li class="breadcrumb-item">All Roles</li>
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
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @if ($role->guard_name == 'web')
                                                User
                                            @elseif($role->guard_name == 'doc')
                                                Doctor
                                            @elseif($role->guard_name == 'admin')
                                                Admin
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('roles.edit', ['role' => $role->id]) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form method="POST" class="d-inline"
                                                action="{{ route('roles.destroy', ['role' => $role->id]) }}">
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
