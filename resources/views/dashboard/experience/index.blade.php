@extends('dashboard.layouts.layout')
@section('title','All Exceptions')
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
                                <th>Title (Arabic)</th>
                                <th>Title (English)</th>
                                <th>Place (Arabic)</th>
                                <th>Place (English)</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Doctor (Arabic)</th>
                                <th>Doctor (English)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($experiences as $experience)
                            <tr>
                                <td>{{$experience->id}}</td>
                                <td>{{$experience->title['title_ar']}}</td>
                                <td>{{$experience->title['title_en']}}</td>
                                <td>{{$experience->place['place_ar']}}</td>
                                <td>{{$experience->place['place_en']}}</td>
                                <td>{{date_format(date_create($experience->start_date),'j M Y')}}</td>
                                <td>{{date_format(date_create($experience->end_date),'j M Y')}}</td>
                                <td>{{$experience->status}}</td>
                                <td>{{ucwords($experience->physican->name['fname_ar'].' '.$experience->physican->name['lname_ar'])}}</td>
                                <td>{{ucwords($experience->physican->name['fname_en'].' '.$experience->physican->name['lname_en'])}}</td>
                                <td>
                                    <a href="{{route('experiences.edit',['experience'=>$experience->id])}}" class="btn btn-warning">Edit</a>
                                    <form method="POST" class="d-inline" action="{{route('experiences.destroy',['experience'=>$experience->id])}}">
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
