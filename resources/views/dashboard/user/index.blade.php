@extends('dashboard.layouts.layout')
@section('title', 'All Users')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Users
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Users</li>
    <li class="breadcrumb-item">All Users</li>
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
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Gender</th>
                                    <th>Birthdate</th>
                                    <th>Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ ucwords($user->name['fname'] . ' ' . $user->name['lname']) }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        @if (!$user->email_verified_at)
                                            <td class="text-danger">
                                                Not Verified
                                            </td>
                                        @else
                                            <td class="text-success">
                                                Verified
                                            </td>
                                        @endif
                                        <td>{{ $user->gender }}</td>
                                        <td>{{ date_format(date_create($user->birthdate), 'j M Y') }}</td>
                                        <td>{{ $user->code }}</td>
                                        <td>
                                            <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                                class="btn btn-warning">Edit</a>
                                                <a href="{{ route('users.resetpass', ['user' => $user->id]) }}"
                                                    class="btn btn-secondary">Reset Password</a>
                                            <form method="POST" class="d-inline"
                                                action="{{ route('users.destroy', ['user' => $user->id]) }}">
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
