@extends('dashboard.layouts.layout')
@section('title', 'All Addresses')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Addresses
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Addresses</li>
    <li class="breadcrumb-item">All Addresses</li>
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
                                    <th>Street (Arabic)</th>
                                    <th>Street (English)</th>
                                    <th>Building (Arabic)</th>
                                    <th>Building (Engllish)</th>
                                    <th>Floor</th>
                                    <th>Apartment no.</th>
                                    <th>Landmark (Arabic)</th>
                                    <th>Landmark (English)</th>
                                    <th>Clinic (Arabic)</th>
                                    <th>Clinic (English)</th>
                                    <th>Region (Arabic)</th>
                                    <th>Region (English)</th>
                                    <th>City (Arabic)</th>
                                    <th>City (English)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($addresses as $address)
                                    <tr>
                                        <td>{{ $address->id }}</td>
                                        <td>{{ $address->street['street_ar'] }}</td>
                                        <td>{{ $address->street['street_en'] }}</td>
                                        <td>{{ $address->building['building_ar'] }}</td>
                                        <td>{{ $address->building['building_en'] }}</td>
                                        <td>{{ $address->floor }}</td>
                                        <td>{{ $address->apartno }}</td>
                                        <td>{{ $address->landmark['landmark_ar'] }}</td>
                                        <td>{{ $address->landmark['landmark_en'] }}</td>
                                        <td>{{ $address->clinic->name['name_ar'] }}</td>
                                        <td>{{ $address->clinic->name['name_en'] }}</td>
                                        <td>{{ $address->region->name['name_ar'] }}</td>
                                        <td>{{ $address->region->name['name_en'] }}</td>
                                        <td>{{ $address->region->city->name['name_ar'] }}</td>
                                        <td>{{ $address->region->city->name['name_en'] }}</td>
                                        <td>
                                            @can('update')
                                                <a href="{{ route('addresses.edit', ['address' => $address->id]) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('delete')
                                                <form method="POST" class="d-inline"
                                                    action="{{ route('addresses.destroy', ['address' => $address->id]) }}">
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
