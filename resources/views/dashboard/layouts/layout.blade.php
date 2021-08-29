<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from doccure-html.dreamguystech.com/template/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Mar 2021 19:28:42 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('website/assets/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('dashboard/assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ url('dashboard/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href={{ url('dashboard/assets/plugins/fontawesome/css/all.min.css') }}>

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{ url('dashboard/assets/css/feathericon.min.css') }}">

    <link rel="stylesheet" href="{{ url('dashboard/assets/plugins/morris/morris.css') }}">

    <!-- Datatables CSS -->
    <link rel="stylesheet" href="{{ url('dashboard/assets/plugins/datatables/datatables.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ url('dashboard/assets/css/style.css') }}">

    <!--[if lt IE 9]>
   <script src="{{ url('dashboard/assets/js/html5shiv.min.js') }}"></script>
   <script src="{{ url('dashboard/assets/js/respond.min.js') }}"></script>
  <![endif]-->
</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <div class="header">

            <!-- Logo -->
            <div class="header-left">
                <a href="{{ route('admin.index') }}" class="logo">
                    <img src="{{ url('dashboard/assets/img/logo.png') }}" alt="Logo">
                </a>
                <a href="{{ route('admin.index') }}" class="logo logo-small">
                    <img src="{{ url('dashboard/assets/img/logo-small.png') }}" alt="Logo" width="30" height="30">
                </a>
            </div>
            <!-- /Logo -->

            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fe fe-text-align-left"></i>
            </a>


            <!-- Mobile Menu Toggle -->
            <a class="mobile_btn" id="mobile_btn">
                <i class="fa fa-bars"></i>
            </a>
            <!-- /Mobile Menu Toggle -->

            <!-- Header Right Menu -->
            <ul class="nav user-menu">


                <!-- User Menu -->
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img">{{ ucwords(Auth::guard('admin')->user()->name) }}</span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="user-text">
                                <h6>{{ ucwords(Auth::guard('admin')->user()->name) }}</h6>
                                <p class="text-muted mb-0">Administrator</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{ route('admin.profile') }}">My Profile</a>
                        <a class="dropdown-item" href="{{ route('admin.changepass') }}">Change Password</a>
                        <form method="POST" class="d-inline" action="{{ route('admin.logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit">Logout</button>
                        </form>
                    </div>
                </li>
                <!-- /User Menu -->

            </ul>
            <!-- /Header Right Menu -->

        </div>
        <!-- /Header -->
        @if (!(Request::url() == route('admin.verification.notice')))
            <!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
                    <div id="sidebar-menu" class="sidebar-menu">
                        <ul>
                            <li class="menu-title">
                                <span>Main</span>
                            </li>
                            <li class="@if (route('admin.index')==Request::url()) {{ 'active' }} @endif">
                                <a href="{{ route('admin.index') }}"><i class="fe fe-home"></i>
                                    <span>Dashboard</span></a>
                            </li>
                            <li class="submenu">
                                <a class="@if(Request::url() == route('addresses.index')||Request::url()==route('addresses.create')) {{'subdrop'}} @endif"><i class="fas fa-map-marked-alt"></i><span>&nbsp; Addresses</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display:  @if(Request::url() == route('addresses.index')||Request::url()==route('addresses.create')) {{'block'}} @endif;">
                                    <li class="@if (route('addresses.index')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('addresses.index') }}"><i class="fas fa-border-all"></i><span>&nbsp; All Addresses</span></a></li>
                                    <li class="@if (route('addresses.create')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('addresses.create') }}"><i class="fas fa-plus"></i><span>&nbsp; Add Address</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a class="@if(Request::url() == route('appointments.index')||Request::url()==route('appointments.create')) {{'subdrop'}} @endif"><i class="far fa-calendar-alt"></i><span>&nbsp; Appointments</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display:  @if(Request::url() == route('appointments.index')||Request::url()==route('appointments.create')) {{'block'}} @endif;">
                                    <li class="@if (route('appointments.index')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('appointments.index') }}"><i class="fas fa-border-all"></i><span>&nbsp; All Appointments</span></a></li>
                                    <li class="@if (route('appointments.create')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('appointments.create') }}"><i class="fas fa-plus"></i><span>&nbsp; Add Appointment</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a class="@if(Request::url() == route('certificates.index')||Request::url()==route('certificates.create')) {{'subdrop'}} @endif"><i class="fas fa-certificate"></i><span>&nbsp; Certificates</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display:  @if(Request::url() == route('certificates.index')||Request::url()==route('certificates.create')) {{'block'}} @endif;">
                                    <li class="@if (route('certificates.index')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('certificates.index') }}"><i class="fas fa-border-all"></i><span>&nbsp; All Certificates</span></a></li>
                                    <li class="@if (route('certificates.create')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('certificates.create') }}"><i class="fas fa-plus"></i><span>&nbsp; Add Certificate</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a class="@if(Request::url() == route('cities.index')||Request::url()==route('cities.create')) {{'subdrop'}} @endif"><i class="fas fa-city"></i><span>&nbsp; Cities</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display:  @if(Request::url() == route('cities.index')||Request::url()==route('cities.create')) {{'block'}} @endif;">
                                    <li class="@if (route('cities.index')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('cities.index') }}"><i class="fas fa-border-all"></i><span>&nbsp; All Cities</span></a></li>
                                    <li class="@if (route('cities.create')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('cities.create') }}"><i class="fas fa-plus"></i><span>&nbsp; Add City</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a class="@if(Request::url() == route('departments.index')||Request::url()==route('departments.create')) {{'subdrop'}} @endif"><i class="fas fa-glasses"></i><span>&nbsp; Departments</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display:  @if(Request::url() == route('departments.index')||Request::url()==route('departments.create')) {{'block'}} @endif;">
                                    <li class="@if (route('departments.index')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('departments.index') }}"><i class="fas fa-border-all"></i><span>&nbsp; All Departments</span></a></li>
                                    <li class="@if (route('departments.create')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('departments.create') }}"><i class="fas fa-plus"></i><span>&nbsp; Add Department</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a class="@if(Request::url() == route('examfees.index')||Request::url()==route('examfees.create')) {{'subdrop'}} @endif"><i class="fas fa-dollar-sign"></i><span>&nbsp; Examfees</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display:  @if(Request::url() == route('examfees.index')||Request::url()==route('examfees.create')) {{'block'}} @endif;">
                                    <li class="@if (route('examfees.index')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('examfees.index') }}"><i class="fas fa-border-all"></i><span>&nbsp; All Examfees</span></a></li>
                                    <li class="@if (route('examfees.create')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('examfees.create') }}"><i class="fas fa-plus"></i><span>&nbsp; Add Examfee</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a class="@if(Request::url() == route('clinicphotos.index')||Request::url()==route('clinicphotos.create')) {{'subdrop'}} @endif"><i class="fas fa-images"></i><span>&nbsp; Clinics Photos</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display: @if(Request::url() == route('clinicphotos.index')||Request::url()==route('clinicphotos.create')) {{'block'}} @endif;">
                                    <li class="@if (route('clinicphotos.index')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('clinicphotos.index') }}"><i class="fas fa-border-all"></i><span>&nbsp; All Clinics Photos</span></a></li>
                                    <li class="@if (route('clinicphotos.create')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('clinicphotos.create') }}"><i class="fas fa-plus"></i><span>&nbsp; Add Clinic Photos</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a class="@if(Request::url() == route('exceptions.index')||Request::url()==route('exceptions.create')) {{'subdrop'}} @endif"><i class="far fa-bell"></i><span>&nbsp; Exceptions</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display:  @if(Request::url() == route('exceptions.index')||Request::url()==route('exceptions.create')) {{'block'}} @endif;">
                                    <li class="@if (route('exceptions.index')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('exceptions.index') }}"><i class="fas fa-border-all"></i><span>&nbsp; All Exceptions</span></a></li>
                                    <li class="@if (route('exceptions.create')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('exceptions.create') }}"><i class="fas fa-plus"></i><span>&nbsp; Add Exception</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a class="@if(Request::url() == route('experiences.index')||Request::url()==route('experiences.create')) {{'subdrop'}} @endif"><i class="fas fa-briefcase"></i><span>&nbsp; Experiences</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display:  @if(Request::url() == route('experiences.index')||Request::url()==route('experiences.create')) {{'block'}} @endif;">
                                    <li class="@if (route('experiences.index')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('experiences.index') }}"><i class="fas fa-border-all"></i><span>&nbsp; All Experiences</span></a></li>
                                    <li class="@if (route('experiences.create')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('experiences.create') }}"><i class="fas fa-plus"></i><span>&nbsp; Add Experience</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a class="@if(Request::url() == route('infos.index')||Request::url()==route('infos.create')) {{'subdrop'}} @endif"><i class="fas fa-info-circle"></i><span>&nbsp; Inforamtions</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display:  @if(Request::url() == route('infos.index')||Request::url()==route('infos.create')) {{'block'}} @endif;">
                                    <li class="@if (route('infos.index')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('infos.index') }}"><i class="fas fa-border-all"></i><span>&nbsp; All Inforamtions</span></a></li>
                                    <li class="@if (route('infos.create')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('infos.create') }}"><i class="fas fa-plus"></i><span>&nbsp; Add Inforamtion</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a class="@if(Request::url() == route('regions.index')||Request::url()==route('regions.create')) {{'subdrop'}} @endif"><i class="fas fa-building"></i><span>&nbsp; Regions</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display:  @if(Request::url() == route('regions.index')||Request::url()==route('regions.create')) {{'block'}} @endif;">
                                    <li class="@if (route('regions.index')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('regions.index') }}"><i class="fas fa-border-all"></i><span>&nbsp; All Regions</span></a></li>
                                    <li class="@if (route('regions.create')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('regions.create') }}"><i class="fas fa-plus"></i><span>&nbsp; Add Region</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a class="@if(Request::url() == route('workdays.index')||Request::url()==route('workdays.create')) {{'subdrop'}} @endif"><i class="fas fa-user-clock"></i><span>&nbsp; Workdays</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display:  @if(Request::url() == route('workdays.index')||Request::url()==route('workdays.create')) {{'block'}} @endif;">
                                    <li class="@if (route('workdays.index')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('workdays.index') }}"><i class="fas fa-border-all"></i><span>&nbsp; All Workdays</span></a></li>
                                    <li class="@if (route('workdays.create')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('workdays.create') }}"><i class="fas fa-plus"></i><span>&nbsp; Add Workday</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a class="@if(Request::url() == route('services.index')||Request::url()==route('services.create')) {{'subdrop'}} @endif"><i class="fas fa-flask"></i><span>&nbsp; Services</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display:  @if(Request::url() == route('services.index')||Request::url()==route('services.create')) {{'block'}} @endif;">
                                    <li class="@if (route('services.index')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('services.index') }}"><i class="fas fa-border-all"></i><span>&nbsp; All Services</span></a></li>
                                    <li class="@if (route('services.create')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('services.create') }}"><i class="fas fa-plus"></i><span>&nbsp; Add Service</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a class="@if(Request::url() == route('reviews.index')||Request::url()==route('reviews.create')) {{'subdrop'}} @endif"><i class="fas fa-comments"></i><span>&nbsp; Reviews</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display:  @if(Request::url() == route('reviews.index')||Request::url()==route('reviews.create')) {{'block'}} @endif;">
                                    <li class="@if (route('reviews.index')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('reviews.index') }}"><i class="fas fa-border-all"></i><span>&nbsp; All Reviews</span></a></li>
                                    <li class="@if (route('reviews.create')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('reviews.create') }}"><i class="fas fa-plus"></i><span>&nbsp; Add Review</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a class="@if(Request::url() == route('clinicservices.index')||Request::url()==route('clinicservices.create')) {{'subdrop'}} @endif"><i class="fas fa-flask"></i><span>&nbsp; Clinics Services</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display:  @if(Request::url() == route('clinicservices.index')||Request::url()==route('clinicservices.create')) {{'block'}} @endif;">
                                    <li class="@if (route('clinicservices.index')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('clinicservices.index') }}"><i class="fas fa-border-all"></i><span>&nbsp; All Clinics Services</span></a></li>
                                    <li class="@if (route('clinicservices.create')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('clinicservices.create') }}"><i class="fas fa-plus"></i><span>&nbsp; Add Clinic Services</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a class="@if(Request::url() == route('users.index')||Request::url()==route('users.create')) {{'subdrop'}} @endif"><i class="fas fa-users"></i><span>&nbsp; Users</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display:  @if(Request::url() == route('users.index')||Request::url()==route('users.create')) {{'block'}} @endif;">
                                    <li class="@if (route('users.index')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('users.index') }}"><i class="fas fa-border-all"></i><span>&nbsp; All Users</span></a></li>
                                    <li class="@if (route('users.create')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('users.create') }}"><i class="fas fa-plus"></i><span>&nbsp; Add User</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a class="@if(Request::url() == route('doctors.index')||Request::url()==route('doctors.create')) {{'subdrop'}} @endif"><i class="fas fa-user-md"></i><span>&nbsp; Doctors</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display:  @if(Request::url() == route('doctors.index')||Request::url()==route('doctors.create')) {{'block'}} @endif;">
                                    <li class="@if (route('doctors.index')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('doctors.index') }}"><i class="fas fa-border-all"></i><span>&nbsp; All Doctors</span></a></li>
                                    <li class="@if (route('doctors.create')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('doctors.create') }}"><i class="fas fa-plus"></i><span>&nbsp; Add Doctor</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a class="@if(Request::url() == route('adminclinics.index')||Request::url()==route('adminclinics.create')) {{'subdrop'}} @endif"><i class="fas fa-clinic-medical"></i><span>&nbsp; Clinics</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display:  @if(Request::url() == route('adminclinics.index')||Request::url()==route('adminclinics.create')) {{'block'}} @endif;">
                                    <li class="@if (route('adminclinics.index')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('adminclinics.index') }}"><i class="fas fa-border-all"></i><span>&nbsp; All Clinics</span></a></li>
                                    <li class="@if (route('adminclinics.create')==Request::url()) {{ 'active' }} @endif"><a
                                            href="{{ route('adminclinics.create') }}"><i class="fas fa-plus"></i><span>&nbsp; Add Clinic</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Sidebar -->
        @endif

        <!-- Page Wrapper -->
        <div class="page-wrapper">

            <div class="content container-fluid">
                @yield('content')
            </div>
        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ url('dashboard/assets/js/jquery-3.2.1.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ url('dashboard/assets/js/popper.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/js/bootstrap.min.js') }}"></script>

    <!-- Slimscroll JS -->
    <script src="{{ url('dashboard/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <script src="{{ url('dashboard/assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/js/chart.morris.js') }}"></script>

    <!-- Datatables JS -->
    <script src="{{ url('dashboard/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/plugins/datatables/datatables.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ url('dashboard/assets/js/script.js') }}"></script>
    @yield('scripts')
</body>

<!-- Mirrored from doccure-html.dreamguystech.com/template/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Mar 2021 19:28:55 GMT -->

</html>
