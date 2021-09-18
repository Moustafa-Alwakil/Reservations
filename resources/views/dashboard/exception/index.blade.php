@can('create')@extends('dashboard.layouts.layout')
    @section('title', 'All Exceptions')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Exceptions
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Exceptions</li>
    <li class="breadcrumb-item">All Exceptions</li>
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
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Clinic (Arabic)</th>
                                    <th>Clinic (English)</th>
                                    <th>Doctor (Arabic)</th>
                                    <th>Doctor (English)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exceptions as $exception)
                                    <tr>
                                        <td>{{ $exception->id }}</td>
                                        <td>{{ date_format(date_create($exception->date), 'j M Y') }}</td>
                                        <td>{{ date_format(date_create($exception->start_time), 'h:i A') }}</td>
                                        <td>{{ date_format(date_create($exception->end_time), 'h:i A') }}</td>
                                        <td>{{ $exception->clinic->name['name_ar'] }}</td>
                                        <td>{{ $exception->clinic->name['name_en'] }}</td>
                                        <td>{{ ucwords($exception->clinic->physican->name['fname_ar'] . ' ' . $exception->clinic->physican->name['lname_ar']) }}
                                        </td>
                                        <td>{{ ucwords($exception->clinic->physican->name['fname_en'] . ' ' . $exception->clinic->physican->name['lname_en']) }}
                                        </td>
                                        <td>
                                            @can('update')
                                                <a href="{{ route('exceptions.edit', ['exception' => $exception->id]) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('delete')
                                                <form method="POST" class="d-inline"
                                                    action="{{ route('exceptions.destroy', ['exception' => $exception->id]) }}">
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
