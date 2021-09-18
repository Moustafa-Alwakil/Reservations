@can('create')@extends('dashboard.layouts.layout')
    @section('title', 'All Doctors')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Doctors
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Doctors</li>
    <li class="breadcrumb-item">All Doctors</li>
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
                                    <th>Name (Arabic)</th>
                                    <th>Name (English)</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Gender</th>
                                    <th>Birthdate</th>
                                    <th>Account Status</th>
                                    <th>Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctors as $doctor)
                                    <tr>
                                        <td>{{ $doctor->id }}</td>
                                        <td>{{ ucwords($doctor->name['fname_ar'] . ' ' . $doctor->name['lname_ar']) }}
                                        </td>
                                        <td>{{ ucwords($doctor->name['fname_en'] . ' ' . $doctor->name['lname_en']) }}
                                        </td>
                                        <td>{{ $doctor->email }}</td>
                                        @if (!$doctor->email_verified_at)
                                            <td class="text-danger">
                                                Not Verified
                                            </td>
                                        @else
                                            <td class="text-success">
                                                Verified
                                            </td>
                                        @endif
                                        <td>{{ $doctor->gender }}</td>
                                        <td>{{ date_format(date_create($doctor->birthdate), 'j M Y') }}</td>
                                        @if ($doctor->status == 0)
                                            <td class="text-danger">
                                                Refused
                                            </td>
                                        @elseif($doctor->status == 1)
                                            <td class="text-success">
                                                Accepted
                                            </td>
                                        @elseif($doctor->status == 2)
                                            <td class="text-warning">
                                                Waiting
                                            </td>
                                        @endif
                                        <td>{{ $doctor->code }}</td>
                                        <td>
                                            @can('update')
                                                <a href="{{ route('doctors.edit', ['doctor' => $doctor->id]) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('delete')
                                                <form method="POST" class="d-inline"
                                                    action="{{ route('doctors.destroy', ['doctor' => $doctor->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
                                            @endcan
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
