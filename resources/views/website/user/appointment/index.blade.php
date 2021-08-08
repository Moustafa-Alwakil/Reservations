@extends('website.layouts.layout')
@section('title')
    {{-- get the name of the user from the session --}}
    @php
    $name = Auth::guard('web')->user()->name;
    @endphp
    {{ ucwords($name['fname'] . ' ' . $name['lname']) }}
    - {{__('website\user\appointment\appointment.appts')}}
@endsection
@section('content')
    @include('website.includes.bar1')
    {{__('website\user\appointment\appointment.profile')}}
    @include('website.includes.bar2')
    {{__('website\user\appointment\appointment.appts')}}
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
                                            data-toggle="tab">{{__('website\user\appointment\appointment.appts')}}</a>
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
                                                            <th>{{__('website\user\appointment\appointment.doctor')}}</th>
                                                            <th>{{__('website\user\appointment\appointment.clinic')}}</th>
                                                            <th>{{__('website\user\appointment\appointment.apptdate')}}</th>
                                                            <th>{{__('website\user\appointment\appointment.bookdate')}}</th>
                                                            <th>{{__('website\user\appointment\appointment.price')}}</th>
                                                            <th>{{__('website\user\appointment\appointment.status')}}</th>
                                                            <th>{{__('website\user\appointment\appointment.action')}}</th>
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
                                                                            class="badge badge-pill bg-success-light">{{__('website\user\appointment\appointment.confirmed')}}</span>
                                                                    @elseif($appointment->status == 0)
                                                                        <span
                                                                            class="badge badge-pill bg-warning-light">{{__('website\user\appointment\appointment.pending')}}</span>
                                                                    @elseif($appointment->status == 2)
                                                                        <span
                                                                            class="badge badge-pill bg-danger-light">{{__('website\user\appointment\appointment.refused')}}</span>
                                                                    @elseif($appointment->status == 3)
                                                                        <span
                                                                            class="badge badge-pill bg-secondary-light">{{__('website\user\appointment\appointment.canceled')}}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (($appointment->status == 0 || $appointment->status == 1) && $appointment->datetime > date('Y-m-d H:i'))
                                                                        <form method="POST"
                                                                            action="{{route('appointment.update')}}">
                                                                            @csrf
                                                                            <input type="hidden" name="id"
                                                                                value="{{ $appointment->id }}">
                                                                            <button type="submit" class="btn btn-warning"><i
                                                                                    class="fas fa-bookmark"></i> {{__('website\user\appointment\appointment.cancelappt')}}</button>
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
