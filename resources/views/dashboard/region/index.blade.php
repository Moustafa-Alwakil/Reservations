@extends('dashboard.layouts.layout')
@section('title','All Regions')
@section('content')
@include('dashboard.includes.pageHeader1')
Regions
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Regions</li>
<li class="breadcrumb-item">All Regions</li>
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
                                <th>City (Arabic)</th>
                                <th>City (English)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($regions as $region)
                            <tr>
                                <td>{{$region->id}}</td>
                                <td>{{$region->name['name_ar']}}</td>
                                <td>{{$region->name['name_en']}}</td>
                                <td>{{$region->status}}</td>
                                <td>{{$region->city->name['name_en']}}</td>
                                <td>{{$region->city->name['name_en']}}</td>
                                <td>
                                    <a href="{{route('regions.edit',['region'=>$region->id])}}" class="btn btn-warning">Edit</a>
                                    <form method="POST" class="d-inline" action="{{route('regions.destroy',['region'=>$region->id])}}">
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
