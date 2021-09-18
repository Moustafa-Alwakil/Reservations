@extends('dashboard.layouts.layout')
@section('title', 'All Clinics Photos')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Clinics Photos
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Clinics Photos</li>
    <li class="breadcrumb-item">All Clinic Photos</li>
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
                                    <th>Photo</th>
                                    <th>Clinic (Arabic)</th>
                                    <th>Clinic (English)</th>
                                    <th>Doctor (Arabic)</th>
                                    <th>Doctor (English)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clinicPhotos as $clinicPhoto)
                                    <tr>
                                        <td>{{ $clinicPhoto->id }}</td>
                                        <td><a href="{{ $clinicPhoto->photo }}" target="_blank"><img
                                                    src="{{ $clinicPhoto->photo }}" alt="certificate" width="20%"
                                                    height="20%"></a></td>
                                        <td>{{ ucwords($clinicPhoto->clinic->name['name_ar']) }}</td>
                                        <td>{{ ucwords($clinicPhoto->clinic->name['name_en']) }}</td>
                                        <td>{{ ucwords($clinicPhoto->clinic->physican->name['fname_ar'] . ' ' . $clinicPhoto->clinic->physican->name['lname_ar']) }}
                                        </td>
                                        <td>{{ ucwords($clinicPhoto->clinic->physican->name['fname_en'] . ' ' . $clinicPhoto->clinic->physican->name['lname_en']) }}
                                        </td>
                                        <td>
                                            @can('update')
                                                <a href="{{ route('clinicphotos.edit', ['clinicphoto' => $clinicPhoto->id]) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('delete')
                                                <form method="POST" class="d-inline"
                                                    action="{{ route('clinicphotos.destroy', ['clinicphoto' => $clinicPhoto->id]) }}">
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
