@extends('dashboard.layouts.layout')
@section('title','All Examfees')
@section('content')
@include('dashboard.includes.pageHeader1')
Examfees
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Examfees</li>
<li class="breadcrumb-item">All Examfees</li>
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
                                <th>Price</th>
                                <th>Doctor (Arabic)</th>
                                <th>Doctor (English)</th>
                                <th>Clinic (Arabic)</th>
                                <th>Clinic (English)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($examfees as $examfee)
                            <tr>
                                <td>{{$examfee->id}}</td>
                                <td>{{$examfee->price}} EGP</td>
                                <td>{{ucwords($examfee->clinic->physican->name['fname_ar'].' '.$examfee->clinic->physican->name['lname_ar'])}}</td>
                                <td>{{ucwords($examfee->clinic->physican->name['fname_en'].' '.$examfee->clinic->physican->name['lname_en'])}}</td>
                                <td>{{$examfee->clinic->name['name_ar']}}</td>
                                <td>{{$examfee->clinic->name['name_en']}}</td>
                                <td>
                                    <a href="{{route('examfees.edit',['examfee'=>$examfee->id])}}" class="btn btn-warning">Edit</a>
                                    <form method="POST" class="d-inline" action="{{route('examfees.destroy',['examfee'=>$examfee->id])}}">
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
