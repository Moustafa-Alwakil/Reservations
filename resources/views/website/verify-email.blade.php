@extends('website.layouts.layout')
@section('title')
    {{__('website\verify-email.title')}}
@endsection
@section('content')
    <br><br>
    @include('website.includes.sessionDisplay')
    <br>
    <div class=" mx-auto mt-5 mb-5 col-8 alert alert-warning">{{__('website\verify-email.msg')}}
        @if (Auth::guard('web')->check())
            <form method="POST" action="{{ route('user.verification.send') }}">
            @elseif(Auth::guard('doc')->check())
                <form method="POST" action="{{ route('doctor.verification.send') }}">
        @endif
        @csrf
        <button class="btn btn-link">{{__('website\verify-email.btn')}}</button>
        </form>
    </div>
@endsection