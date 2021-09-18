@extends('dashboard.layouts.layout')
@section('title', 'All Models Roles')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Models Roles
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Models Roles</li>
    <li class="breadcrumb-item">All Models Roles</li>
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
                                    <th>Role Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($modelRoles as $modelRole)
                                    <tr>
                                        <td>{{ ucwords($modelRole->name) }}</td>
                                        <td>{{ $modelRole->email }}</td>
                                        <td>{{ $modelRole->role_name }}</td>
                                        <td>
                                            <form method="POST" class="d-inline"
                                                action="{{ route('modelsroles.destroy', ['role_name' => $modelRole->role_name, 'model_id' => $modelRole->model_id]) }}">
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
