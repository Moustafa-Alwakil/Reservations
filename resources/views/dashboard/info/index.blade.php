@extends('dashboard.layouts.layout')
@section('title','All Informations')
@section('content')
@include('dashboard.includes.pageHeader1')
Informations
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Informations</li>
<li class="breadcrumb-item">All Informations</li>
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
                                <th>Title</th>
                                <th>License</th>
                                <th>Photo</th>
                                <th>About (Arabic)</th>
                                <th>About (English)</th>
                                <th>Doctor (Arabic)</th>
                                <th>Doctor (English)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($infos as $info)
                            <tr>
                                <td>{{$info->id}}</td>
                                <td>{{__('website\layouts\layout.'.$info->title)}}</td>
                                <td><a href="{{$info->license}}" target="_blank"><img src="{{$info->license}}" alt="license" width="100%" height="100%"></a></td>
                                <td><a href="{{$info->photo}}" target="_blank"><img src="{{$info->photo}}" alt="photo" width="100%" height="100%"></a></td>
                                <td>{{$info->about['about_ar']}}</td>about
                                <td>{{$info->about['about_en']}}</td>
                                <td>{{ucwords($info->physican->name['fname_ar'].' '.$info->physican->name['lname_ar'])}}</td>
                                <td>{{ucwords($info->physican->name['fname_en'].' '.$info->physican->name['lname_en'])}}</td>
                                <td>
                                    <a href="{{route('infos.edit',['info'=>$info->id])}}" class="btn btn-warning">Edit</a>
                                    <form method="POST" class="d-inline" action="{{route('infos.destroy',['info'=>$info->id])}}">
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
