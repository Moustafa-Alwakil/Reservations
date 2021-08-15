@extends('dashboard.layouts.layout')
@section('title','All Departments')
@section('content')
@include('dashboard.includes.pageHeader1')
Departments
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Departments</li>
<li class="breadcrumb-item">All Departments</li>
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
                            @foreach ($departments as $department)
                            <tr>
                                <td>{{$department->id}}</td>
                                <td>{{$department->name['name_ar']}}</td>
                                <td>{{$department->name['name_en']}}</td>
                                <td>{{$department->status}}</td>
                                <td>
                                    <a href="{{route('departments.edit',['department'=>$department->id])}}" class="btn btn-warning">Edit</a>
                                    <form method="POST" class="d-inline" action="{{route('departments.destroy',['department'=>$department->id])}}">
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