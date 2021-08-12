@extends('dashboard.layouts.layout')
@section('title','Please Verify Your Email!')
@section('content')
<br><br>
@include('website.includes.sessionDisplay')
<br>
<div class=" mx-auto mt-5 mb-5 col-8 alert alert-warning">Thanks for registeration! Before getting started, could you
    verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will
    gladly send you another.
    <form method="POST" action="{{ route('admin.verification.send') }}">
    @csrf
    <button class="btn btn-link">Resend Verification Email</button>
    </form>
</div>
@endsection