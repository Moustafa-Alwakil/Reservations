@extends('dashboard.layouts.layout')
@section('title', 'All Clinics')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Clinics
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Clinics</li>
    <li class="breadcrumb-item">All Clinics</li>
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
                                    <th>Phone</th>
                                    <th>License</th>
                                    <th>Clinic Status</th>
                                    <th>Review Status</th>
                                    <th>Doctor (Arabic)</th>
                                    <th>Doctor (English)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clinics as $clinic)
                                    <tr>
                                        <td>{{ $clinic->id }}</td>
                                        <td>{{ ucwords($clinic->name['name_ar']) }}
                                        </td>
                                        <td>{{ ucwords($clinic->name['name_en']) }}
                                        </td>
                                        <td>{{ $clinic->phone }}</td>
                                        <td><a href="{{ $clinic->photo }}" target="_blank"><img src="{{ $clinic->license }}"
                                                    alt="License" width="20%" height="20%"></a></td>
                                        @if ($clinic->status == 'Not Active')
                                            <td class="text-danger">
                                                Not Active
                                            </td>
                                        @elseif($clinic->status == 'Active')
                                            <td class="text-success">
                                                Active
                                            </td>
                                        @endif
                                        @if ($clinic->review == 'Not Accepted')
                                            <td class="text-danger">
                                                Refused
                                            </td>
                                        @elseif($clinic->review == 'Accepted')
                                            <td class="text-success">
                                                Accepted
                                            </td>
                                        @elseif($clinic->review == 'Waiting')
                                            <td class="text-warning">
                                                Waiting
                                            </td>
                                        @endif
                                        <td>{{ ucwords($clinic->physican->name['fname_ar'] . ' ' . $clinic->physican->name['lname_ar']) }}
                                        </td>
                                        <td>{{ ucwords($clinic->physican->name['fname_en'] . ' ' . $clinic->physican->name['lname_en']) }}
                                        </td>
                                        <td>
                                            <a href="{{ route('clinics.edit', ['clinic' => $clinic->id]) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form method="POST" class="d-inline"
                                                action="{{ route('clinics.destroy', ['clinic' => $clinic->id]) }}">
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
