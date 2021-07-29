@extends('website.layouts.layout')
@section('title')
    {{-- get the name of the user from the session --}}
    @php
    $name = Auth::guard('doc')->user()->name;
    @endphp
    {{ ucwords($name['fname_' . LaravelLocalization::getCurrentLocale() . ''] . ' ' . $name['lname_' . LaravelLocalization::getCurrentLocale() . '']) }}
    - Clinics
@endsection
@section('content')
    @include('website.includes.bar1')
    Profile
    @include('website.includes.bar2')
    Doctor Clinics
    @include('website.includes.bar3')
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('website.includes.sidebar')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Doctor Clinics
                                <hr>
                            </h4>
                            @include('website.includes.sessionDisplay')<br>
                            <div class="col-10 mx-auto">
                                <a href="{{ route('clinics.create') }}" class="btn btn-primary btn-lg btn-block">Add
                                    Clinic</a>
                            </div>
                        </div>
                    </div>
                    @isset($clinics)
                        <div class="card-body">
                            <!-- Experiences Preview -->
                            @foreach ($clinics as $clinic)
                                <div class="card text-center">
                                    <div class="card-body">
                                        @if ($clinic->review == 'Not Accepted')
                                            <div class="alert alert-danger col-9 mx-auto">Your clinic is invalid, please review
                                                it again
                                                and insert the correct information.</div>
                                        @elseif($clinic->review == 'Accepted')
                                            <div class="alert alert-success col-9 mx-auto">Congratulations, your clinic has been
                                                reviewed and
                                                accepted.</div>
                                        @elseif($clinic->review == 'Waiting')
                                            <div class="alert alert-warning col-9 mx-auto">Your clinic is being reviewed by us
                                                and we
                                                will verify it as soon as possible, this might take hours or maybe few days.
                                            </div>
                                        @endif
                                        <h5 class="card-title">Name:
                                            {{ $clinic->name['name_' . LaravelLocalization::getCurrentLocale()] }}
                                        </h5>
                                        @if ($clinic->status == 'Active')
                                            <h5 class="card-title d-inline">Status:
                                                <h5 class="card-title text-success d-inline">{{ $clinic->status }}</h5>
                                            </h5>
                                        @else
                                            <h5 class="card-title d-inline">Status:
                                                <h5 class="card-title text-danger d-inline">{{ $clinic->status }}</h5>
                                            </h5>
                                        @endif
                                        <h5 class="card-title mt-3">Examination Price:
                                            {{ $clinic->examfee->price }}</h5>
                                        <h5 class="card-title mb-4">Address:
                                            {{ $clinic->address->street['street_' . LaravelLocalization::getCurrentLocale()] }}
                                            , building:
                                            {{ $clinic->address->building['building_' . LaravelLocalization::getCurrentLocale()] }}
                                            , floor: {{ $clinic->address->floor }}
                                            , Apartment: {{ $clinic->address->apartno }}
                                            -
                                            {{ $clinic->address->region->name['name_' . LaravelLocalization::getCurrentLocale()] }}
                                            -
                                            {{ $clinic->address->region->city->name['name_' . LaravelLocalization::getCurrentLocale()] }}
                                        </h5>
                                        <a href="{{ route('clinics.edit', ['clinic' => $clinic->id]) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form class="d-inline" method="POST"
                                            action="{{ route('clinics.destroy', ['clinic' => $clinic->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                            <!-- /Experiences Preview  -->
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection
