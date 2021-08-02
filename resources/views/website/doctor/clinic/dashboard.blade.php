@extends('website.layouts.layout')
@section('title')
    {{-- get the name of the user from the session --}}
    @php
    $name = Auth::guard('doc')->user()->name;
    @endphp
    {{ ucwords($name['fname_' . LaravelLocalization::getCurrentLocale() . ''] . ' ' . $name['lname_' . LaravelLocalization::getCurrentLocale() . '']) }}
    - Clinic Dashboard
@endsection
@section('stylesheets')
    <link rel="stylesheet" href="{{ url('assets/css/style1.css') }}">
    <link rel="stylesheet" href="{{ url('website/assets/css/feathericon.min.css') }}">
    <link rel="stylesheet" href="{{ url('website/assets/plugins/datatables/datatables.min.css') }}">
@endsection
@section('content')
    @include('website.includes.bar1')
    Clinics
    @include('website.includes.bar2')
    Clinic Dashboard
    @include('website.includes.bar3')
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('website.includes.sidebar')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card dash-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-4">
                                            <div class="dash-widget dct-border-rht">
                                                <div class="circle-bar circle-bar1">
                                                    <div class="circle-graph1" data-percent="75">
                                                        <img src="{{ url('website/assets/img/icon-01.png') }}"
                                                            class="img-fluid" alt="patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6>Total Patient</h6>
                                                    <h3>1500</h3>
                                                    <p class="text-muted">Till Today</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-4">
                                            <div class="dash-widget dct-border-rht">
                                                <div class="circle-bar circle-bar2">
                                                    <div class="circle-graph2" data-percent="65">
                                                        <img src="{{ url('website/assets/img/icon-02.png') }}"
                                                            class="img-fluid" alt="Patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6>Today Patient</h6>
                                                    <h3>160</h3>
                                                    <p class="text-muted">06, Nov 2019</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-4">
                                            <div class="dash-widget">
                                                <div class="circle-bar circle-bar3">
                                                    <div class="circle-graph3" data-percent="50">
                                                        <img src="{{ url('website/assets/img/icon-03.png') }}"
                                                            class="img-fluid" alt="Patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6>Appoinments</h6>
                                                    <h3>85</h3>
                                                    <p class="text-muted">06, Apr 2019</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body pt-0">

                            <!-- Tab Menu -->
                            <nav class="user-tabs mb-4">
                                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#pat_appointments"
                                            data-toggle="tab">Appointments</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#schedule" data-toggle="tab">Schedule</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#schedule_exceptions" data-toggle="tab"><span
                                                class="med-records">Schedule Exceptions</span></a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- /Tab Menu -->

                            <!-- Tab Content -->
                            <div class="tab-content pt-0">

                                <!-- Appointment Tab -->
                                <div id="pat_appointments" class="tab-pane fade show active">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Doctor</th>
                                                            <th>Appt Date</th>
                                                            <th>Booking Date</th>
                                                            <th>Amount</th>
                                                            <th>Follow Up</th>
                                                            <th>Status</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-01.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Ruby Perrin
                                                                        <span>Dental</span></a>
                                                                </h2>
                                                            </td>
                                                            <td>14 Nov 2019 <span class="d-block text-info">10.00
                                                                    AM</span></td>
                                                            <td>12 Nov 2019</td>
                                                            <td>$160</td>
                                                            <td>16 Nov 2019</td>
                                                            <td><span
                                                                    class="badge badge-pill bg-success-light">Confirm</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-02.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Darren Elder
                                                                        <span>Dental</span></a>
                                                                </h2>
                                                            </td>
                                                            <td>12 Nov 2019 <span class="d-block text-info">8.00
                                                                    PM</span></td>
                                                            <td>12 Nov 2019</td>
                                                            <td>$250</td>
                                                            <td>14 Nov 2019</td>
                                                            <td><span
                                                                    class="badge badge-pill bg-success-light">Confirm</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-03.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Deborah Angel
                                                                        <span>Cardiology</span></a>
                                                                </h2>
                                                            </td>
                                                            <td>11 Nov 2019 <span class="d-block text-info">11.00
                                                                    AM</span></td>
                                                            <td>10 Nov 2019</td>
                                                            <td>$400</td>
                                                            <td>13 Nov 2019</td>
                                                            <td><span
                                                                    class="badge badge-pill bg-danger-light">Cancelled</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-04.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Sofia Brient
                                                                        <span>Urology</span></a>
                                                                </h2>
                                                            </td>
                                                            <td>10 Nov 2019 <span class="d-block text-info">3.00
                                                                    PM</span></td>
                                                            <td>10 Nov 2019</td>
                                                            <td>$350</td>
                                                            <td>12 Nov 2019</td>
                                                            <td><span
                                                                    class="badge badge-pill bg-warning-light">Pending</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-05.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Marvin
                                                                        Campbell <span>Ophthalmology</span></a>
                                                                </h2>
                                                            </td>
                                                            <td>9 Nov 2019 <span class="d-block text-info">7.00
                                                                    PM</span></td>
                                                            <td>8 Nov 2019</td>
                                                            <td>$75</td>
                                                            <td>11 Nov 2019</td>
                                                            <td><span
                                                                    class="badge badge-pill bg-success-light">Confirm</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-06.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Katharine
                                                                        Berthold <span>Orthopaedics</span></a>
                                                                </h2>
                                                            </td>
                                                            <td>8 Nov 2019 <span class="d-block text-info">9.00
                                                                    AM</span></td>
                                                            <td>6 Nov 2019</td>
                                                            <td>$175</td>
                                                            <td>10 Nov 2019</td>
                                                            <td><span
                                                                    class="badge badge-pill bg-danger-light">Cancelled</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-07.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Linda Tobin
                                                                        <span>Neurology</span></a>
                                                                </h2>
                                                            </td>
                                                            <td>8 Nov 2019 <span class="d-block text-info">6.00
                                                                    PM</span></td>
                                                            <td>6 Nov 2019</td>
                                                            <td>$450</td>
                                                            <td>10 Nov 2019</td>
                                                            <td><span
                                                                    class="badge badge-pill bg-success-light">Confirm</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-08.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Paul Richard
                                                                        <span>Dermatology</span></a>
                                                                </h2>
                                                            </td>
                                                            <td>7 Nov 2019 <span class="d-block text-info">9.00
                                                                    PM</span></td>
                                                            <td>7 Nov 2019</td>
                                                            <td>$275</td>
                                                            <td>9 Nov 2019</td>
                                                            <td><span
                                                                    class="badge badge-pill bg-success-light">Confirm</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-09.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. John Gibbs
                                                                        <span>Dental</span></a>
                                                                </h2>
                                                            </td>
                                                            <td>6 Nov 2019 <span class="d-block text-info">8.00
                                                                    PM</span></td>
                                                            <td>4 Nov 2019</td>
                                                            <td>$600</td>
                                                            <td>8 Nov 2019</td>
                                                            <td><span
                                                                    class="badge badge-pill bg-success-light">Confirm</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-10.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Olga Barlow
                                                                        <span>Dental</span></a>
                                                                </h2>
                                                            </td>
                                                            <td>5 Nov 2019 <span class="d-block text-info">5.00
                                                                    PM</span></td>
                                                            <td>1 Nov 2019</td>
                                                            <td>$100</td>
                                                            <td>7 Nov 2019</td>
                                                            <td><span
                                                                    class="badge badge-pill bg-success-light">Confirm</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Appointment Tab -->

                                <!-- Schedule Tab -->
                                <div class="tab-pane fade" id="schedule">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Date </th>
                                                            <th>Name</th>
                                                            <th>Created by </th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>14 Nov 2019</td>
                                                            <td>Prescription 1</td>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-01.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Ruby Perrin
                                                                        <span>Dental</span></a>
                                                                </h2>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>13 Nov 2019</td>
                                                            <td>Prescription 2</td>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-02.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Darren Elder
                                                                        <span>Dental</span></a>
                                                                </h2>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>12 Nov 2019</td>
                                                            <td>Prescription 3</td>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-03.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Deborah Angel
                                                                        <span>Cardiology</span></a>
                                                                </h2>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>11 Nov 2019</td>
                                                            <td>Prescription 4</td>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-04.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Sofia Brient
                                                                        <span>Urology</span></a>
                                                                </h2>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>10 Nov 2019</td>
                                                            <td>Prescription 5</td>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-05.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Marvin
                                                                        Campbell <span>Dental</span></a>
                                                                </h2>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>9 Nov 2019</td>
                                                            <td>Prescription 6</td>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-06.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Katharine
                                                                        Berthold <span>Orthopaedics</span></a>
                                                                </h2>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>8 Nov 2019</td>
                                                            <td>Prescription 7</td>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-07.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Linda Tobin
                                                                        <span>Neurology</span></a>
                                                                </h2>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>7 Nov 2019</td>
                                                            <td>Prescription 8</td>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-08.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Paul Richard
                                                                        <span>Dermatology</span></a>
                                                                </h2>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>6 Nov 2019</td>
                                                            <td>Prescription 9</td>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-09.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. John Gibbs
                                                                        <span>Dental</span></a>
                                                                </h2>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>5 Nov 2019</td>
                                                            <td>Prescription 10</td>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-10.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Olga Barlow
                                                                        <span>Dental</span></a>
                                                                </h2>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Schedule Tab -->

                                <!-- Schedule Exceptions Tab -->
                                <div id="schedule_exceptions" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="datatable table table-stripped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Date</th>
                                                                    <th>Day</th>
                                                                    <th>Start Time</th>
                                                                    <th>End Time</th>
                                                                    <th>Exception</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    function checkTime($start_time,$day)
                                                                    {
                                                                        $y = $start_time->modify('+' . $day);
                                                                        $x = $y->format('Y-m-d H:i');
                                                                        if ( $x >= date('Y-m-d H:i')) {
                                                                            checkTime($x,$day);
                                                                            }
                                                                            return $x;
                                                                    }
                                                                    $begin_date = new DateTime(date('Y-m-d H:i'));
                                                                    $end = new DateTime(date('Y-m-d')); 
                                                                    $end_date = $end->modify('+6 month');
                                                                    for ($i = $begin_date; $i <= $end_date; $i->modify('+1 day')) {
                                                                        $day = $i->format('Y-m-d');
                                                                        if ($clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_status'] == 1) {
                                                                            $start_time = new DateTime(date($day . ' ' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_start_time']));
                                                                            $end_time = new DateTime(date($day . ' ' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_end_time']));
                                                                            for($start_time;$start_time->format('Y-m-d H:i')<=date('Y-m-d H:i');$start_time->modify('+' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_duration'] . ' minute')){
                                                                            }
                                                                            for ($x = $start_time; $x <= $end_time; $x->modify('+' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_duration'] . ' minute')) {
                                                                                ?>
                                                                <tr>
                                                                    <td>{{ $x->format('Y-m-d') }}</td>
                                                                    <td>{{ date('l', strtotime($x->format('Y-m-d'))) }}
                                                                    </td>
                                                                    <td>{{ $x->format('h:i A') }}</td>
                                                                    <td>{{ date('h:i A', strtotime('+' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_duration'] . ' minute', strtotime($x->format('H:i')))) }}
                                                                    </td>
                                                                    <td>
                                                                        <span
                                                                            class="busy-span{{ $x->format('H:i') }}{{ $x->format('Y-m-d') }}"><span
                                                                                class="busy{{ $x->format('H:i') }}{{ $x->format('Y-m-d') }}"><a
                                                                                    href=""
                                                                                    class="busy-btn btn btn-outline-danger btn-rounded"
                                                                                    date="{{ $x->format('Y-m-d') }}"
                                                                                    start_time="{{ $x->format('H:i') }}"
                                                                                    end_time="{{ date('H:i ', strtotime('+' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_duration'] . ' minute', strtotime($x->format('H:i')))) }}"><i
                                                                                        class="far fa-bell-slash"></i>
                                                                                    Busy</a></span></span>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Schedule Exceptions Tab -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <!-- Slimscroll JS -->
        <script src="{{ url('website/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

        <!-- Datatables JS -->
        <script src="{{ url('website/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('website/assets/plugins/datatables/datatables.min.js') }}"></script>
        <script src="{{ url('website/assets/js/script1.js') }}"></script>

        <!-- Circle Progress JS -->
        <script src="{{ url('website/assets/js/circle-progress.min.js') }}"></script>

        <script type='text/javascript'>
            $(document).ready(function() {
                $(document).on('click', '.busy-btn', function(e) {
                        e.preventDefault();
                        var date = $(this).attr('date');
                        var start_time = $(this).attr('start_time');
                        var end_time = $(this).attr('end_time');
                        $.ajax({
                                type: 'post',
                                url: "{{ route('exception.store') }}",
                                data: {
                                    '_token': "{{ csrf_token() }}",
                                    'date': date,
                                    'start_time': start_time,
                                    'end_time': end_time,
                                },
                                success: function(data) {
                                    var button = "<span class='busy" + data.start_time data.date +
                                        "'><a href='' class = 'busy-btn btn btn-danger btn-rounded' date = '" +
                                        data.date + "' start_time = '" + data.start_time +
                                        "' end_time = '" + data.end_time +
                                        "' > < iclass = 'far fa-bell-slash' > < /i>Busy < /a></span > ";

                                    $('.busy' + data.start_time data.date).remove();
                                    $('.busy-span' + data.start_time data.date).append(button);
                                },
                                error: function(reject) {},
                            }
                        });
                });
            });
        </script>
    @endsection
