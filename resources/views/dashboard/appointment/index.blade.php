@extends('dashboard.layouts.layout')
@section('title', 'All Appointments')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Appointments
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Appointments</li>
    <li class="breadcrumb-item">All Appointments</li>
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
                                    <th>Bookdate</th>
                                    <th>Date</th>
                                    <th>Start time</th>
                                    <th>End time</th>
                                    <th>status</th>
                                    <th>Patient name</th>
                                    <th>Clinic (Arabic)</th>
                                    <th>Clinic (English)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->id }}</td>
                                        <td>{{ $appointment->bookdate }}</td>
                                        <td>{{ date_format(date_create($appointment->date), 'j M Y') }}</td>
                                        <td>{{ date_format(date_create($appointment->start_time), 'h:i A') }}</td>
                                        <td>{{ date_format(date_create($appointment->end_time), 'h:i A') }}</td>
                                        @if ($appointment->status == 0)
                                            <td>Waiting</td>
                                        @endif
                                        @if ($appointment->status == 1)
                                            <td>Accepted</td>
                                        @endif
                                        @if ($appointment->status == 2)
                                            <td>Refused</td>
                                        @endif
                                        @if ($appointment->status == 3)
                                            <td>Canceled</td>
                                        @endif
                                        <td>{{ ucwords($appointment->user->name['fname'] . ' ' . $appointment->user->name['lname']) }}
                                        </td>
                                        <td>{{ $appointment->clinic->name['name_ar'] }}</td>
                                        <td>{{ $appointment->clinic->name['name_en'] }}</td>
                                        <td>
                                            @can('update')
                                                <a href="{{ route('appointments.edit', ['appointment' => $appointment->id]) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('delete')
                                                <form method="POST" class="d-inline"
                                                    action="{{ route('appointments.destroy', ['appointment' => $appointment->id]) }}">
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
