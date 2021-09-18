@extends('dashboard.layouts.layout')
@section('title', 'All Clinic Photos')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Clinic Photos
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Clinic Photos</li>
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
                                    <th>Service (Arabic)</th>
                                    <th>Service (English)</th>
                                    <th>Clinic (Arabic)</th>
                                    <th>Clinic (English)</th>
                                    <th>Department (Arabic)</th>
                                    <th>Department (English)</th>
                                    <th>Doctor (Arabic)</th>
                                    <th>Doctor (English)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clinicServices as $clinicService)
                                    <tr>
                                        <td>{{ $clinicService->id }}</td>
                                        <td>{{ ucwords($clinicService->service->name['name_ar']) }}</td>
                                        <td>{{ ucwords($clinicService->service->name['name_en']) }}</td>
                                        <td>{{ ucwords($clinicService->clinic->name['name_ar']) }}</td>
                                        <td>{{ ucwords($clinicService->clinic->name['name_en']) }}</td>
                                        <td>{{ ucwords($clinicService->clinic->physican->department->name['name_ar']) }}
                                        </td>
                                        <td>{{ ucwords($clinicService->clinic->physican->department->name['name_en']) }}
                                        </td>
                                        <td>{{ ucwords($clinicService->clinic->physican->name['fname_ar'] . ' ' . $clinicService->clinic->physican->name['lname_ar']) }}
                                        </td>
                                        <td>{{ ucwords($clinicService->clinic->physican->name['fname_en'] . ' ' . $clinicService->clinic->physican->name['lname_en']) }}
                                        </td>
                                        <td>
                                            @can('update')
                                                <a href="{{ route('clinicservices.edit', ['clinicservice' => $clinicService->id]) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('delete')
                                                <form method="POST" class="d-inline"
                                                    action="{{ route('clinicservices.destroy', ['clinicservice' => $clinicService->id]) }}">
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
