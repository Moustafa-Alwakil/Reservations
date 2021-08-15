@extends('dashboard.layouts.layout')
@section('title','All Cities')
@section('content')
@include('dashboard.includes.pageHeader1')
Cities
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Cities</li>
<li class="breadcrumb-item">All Cities</li>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cities as $city)
                            <tr>
                                <td>{{$city->id}}</td>
                                <td>{{$city->name['name_ar']}}</td>
                                <td>{{$city->name['name_en']}}</td>
                                <td>{{$city->status}}</td>
                                <td>
                                    <a href="{{route('cities.edit',['city'=>$city->id])}}" class="btn btn-warning">Edit</a>
                                    <form method="POST" class="d-inline" action="{{route('cities.destroy',['city'=>$city->id])}}">
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