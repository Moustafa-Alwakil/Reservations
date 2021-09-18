@extends('dashboard.layouts.layout')
@section('title','All Services')
@section('content')
@include('dashboard.includes.pageHeader1')
Services
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Services</li>
<li class="breadcrumb-item">All Services</li>
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
                                <th>Status</th>
                                <th>Department (Arabic)</th>
                                <th>Department (English)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                            <tr>
                                <td>{{$service->id}}</td>
                                <td>{{$service->name['name_ar']}}</td>
                                <td>{{$service->name['name_en']}}</td>
                                <td>{{$service->status}}</td>
                                <td>{{$service->department->name['name_ar']}}</td>
                                <td>{{$service->department->name['name_en']}}</td>
                                <td>
                                    @can('update')
                                    <a href="{{route('services.edit',['service'=>$service->id])}}" class="btn btn-warning">Edit</a>
                                    @endcan
                                    @can('delete')
                                    <form method="POST" class="d-inline" action="{{route('services.destroy',['service'=>$service->id])}}">
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
