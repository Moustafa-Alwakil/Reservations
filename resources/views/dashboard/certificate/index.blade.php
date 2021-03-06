@extends('dashboard.layouts.layout')
@section('title', 'All Certificates')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Certificates
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Certificates</li>
    <li class="breadcrumb-item">All Certificates</li>
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
                                    <th>Degree</th>
                                    <th>University</th>
                                    <th>Field</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Photo</th>
                                    <th>Doctor</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($certificates as $certificate)
                                    <tr>
                                        <td>{{ $certificate->id }}</td>
                                        <td>{{ $certificate->type }}</td>
                                        <td>{{ $certificate->university['university_ar'] }} -
                                            {{ $certificate->university['university_en'] }}</td>
                                        <td>{{ $certificate->field['field_ar'] }} - {{ $certificate->field['field_en'] }}
                                        </td>
                                        <td>{{ date_format(date_create($certificate->start_date), 'j M Y') }}</td>
                                        <td>{{ date_format(date_create($certificate->end_date), 'j M Y') }}</td>
                                        <td><a href="{{ $certificate->photo }}" target="_blank"><img
                                                    src="{{ $certificate->photo }}" alt="certificate" width="20%"
                                                    height="20%"></a></td>
                                        <td>{{ ucwords($certificate->physican->name['fname_ar'] . ' ' . $certificate->physican->name['lname_ar']) }}
                                            -
                                            {{ ucwords($certificate->physican->name['fname_en'] . ' ' . $certificate->physican->name['lname_en']) }}
                                        </td>
                                        <td>
                                            @can('update')
                                                <a href="{{ route('certificates.edit', ['certificate' => $certificate->id]) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('delete')
                                                <form method="POST" class="d-inline"
                                                    action="{{ route('certificates.destroy', ['certificate' => $certificate->id]) }}">
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
