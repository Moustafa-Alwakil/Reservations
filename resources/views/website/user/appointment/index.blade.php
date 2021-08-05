@extends('website.layouts.layout')
@section('title')
    {{-- get the name of the user from the session --}}
    @php
    $name = Auth::guard('web')->user()->name;
    @endphp
    {{ ucwords($name['fname'] . ' ' . $name['lname']) }}
    - Appointments
@endsection
@section('content')
    @include('website.includes.bar1')
    Profile
    @include('website.includes.bar2')
    Appointments
    @include('website.includes.bar3')
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('website.includes.sidebar')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-body pt-0">

                            <!-- Tab Menu -->
                            <nav class="user-tabs mb-4">
                                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#pat_appointments"
                                            data-toggle="tab">Appointments</a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- /Tab Menu -->
                            <br>
                            <!-- Tab Content -->
                            <div class="tab-content pt-0">

                                <!-- Appointment Tab -->
                                <div id="pat_appointments" class="tab-pane fade show active">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <br>
                                            @include('website.includes.sessionDisplay')
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-hover table-center mb-0 text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>Doctor</th>
                                                            <th>Clinic</th>
                                                            <th>Appt Date</th>
                                                            <th>Booking Date</th>
                                                            <th>Price</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($appointments as $appointment)
                                                            <tr>
                                                                <td>
                                                                    <h2 class="table-avatar">
                                                                        <a href="{{ route('clinic', ['id' => $appointment->clinic->id]) }}"
                                                                            class="avatar avatar-sm mr-2">
                                                                            <img class="avatar-img rounded-circle"
                                                                                src="{{ $appointment->clinic->physican->info->photo }}"
                                                                                alt="User Image">
                                                                        </a>
                                                                        <a
                                                                            href="{{ route('clinic', ['id' => $appointment->clinic->id]) }}l">Dr.
                                                                            {{ ucwords($appointment->clinic->physican->name['fname_' . LaravelLocalization::getCurrentLocale()] . ' ' . $appointment->clinic->physican->name['lname_' . LaravelLocalization::getCurrentLocale()]) }}
                                                                            <span>{{ ucwords($appointment->clinic->physican->department->name['name_' . LaravelLocalization::getCurrentLocale()]) }}</span></a>
                                                                    </h2>
                                                                </td>
                                                                <td>{{ ucwords($appointment->clinic->name['name_' . LaravelLocalization::getCurrentLocale()]) }}
                                                                </td>
                                                                <td>{{ date_format(date_create($appointment->date), 'j M Y') }}
                                                                    <span
                                                                        class="d-block text-info">{{ date_format(date_create($appointment->start_time), 'h:i A') }}</span>
                                                                </td>
                                                                <td>{{ $appointment->bookdate }}</td>
                                                                <td>{{ $appointment->clinic->examfee->price }} EGP</td>
                                                                <td>
                                                                    @if ($appointment->status == 1)
                                                                        <span
                                                                            class="badge badge-pill bg-success-light">Confirmed</span>
                                                                    @elseif($appointment->status == 0)
                                                                        <span
                                                                            class="badge badge-pill bg-warning-light">Pending</span>
                                                                    @elseif($appointment->status == 2)
                                                                        <span
                                                                            class="badge badge-pill bg-danger-light">Refused</span>
                                                                    @elseif($appointment->status == 3)
                                                                        <span
                                                                            class="badge badge-pill bg-secondary-light">Canceled</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($appointment->status == 0 || $appointment->status == 1)
                                                                        <form method="POST"
                                                                            action="{{route('appointment.update')}}">
                                                                            @csrf
                                                                            <input type="hidden" name="id"
                                                                                value="{{ $appointment->id }}">
                                                                            <button type="submit" class="btn btn-warning"><i
                                                                                    class="fas fa-bookmark"></i> Cancel This
                                                                                Appointment</button>
                                                                        </form>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Appointment Tab -->

                            </div>
                            <!-- Tab Content -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
