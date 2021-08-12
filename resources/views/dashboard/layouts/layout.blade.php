<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from doccure-html.dreamguystech.com/template/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Mar 2021 19:28:42 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('website/assets/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('dashboard/assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ url('dashboard/assets/css/font-awesome.min.css') }}">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{ url('dashboard/assets/css/feathericon.min.css') }}">

    <link rel="stylesheet" href="{{ url('dashboard/assets/plugins/morris/morris.css') }}">

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
                <a href="{{route('admin.index')}}" class="logo">
                    <img src="{{ url('dashboard/assets/img/logo.png') }}" alt="Logo">
                </a>
                <a href="{{route('admin.index')}}" class="logo logo-small">
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
                        <a class="dropdown-item" href="{{route('admin.profile')}}">My Profile</a>
                        <a class="dropdown-item" href="{{route('admin.changepass')}}">Change Password</a>
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
                            <li class="active">
                                <a href="index.html"><i class="fe fe-home"></i> <span>Dashboard</span></a>
                            </li>
                            <li>
                                <a href="appointment-list.html"><i class="fe fe-layout"></i>
                                    <span>Appointments</span></a>
                            </li>
                            <li>
                                <a href="specialities.html"><i class="fe fe-users"></i> <span>Specialities</span></a>
                            </li>
                            <li>
                                <a href="doctor-list.html"><i class="fe fe-user-plus"></i> <span>Doctors</span></a>
                            </li>
                            <li>
                                <a href="patient-list.html"><i class="fe fe-user"></i> <span>Patients</span></a>
                            </li>
                            <li>
                                <a href="reviews.html"><i class="fe fe-star-o"></i> <span>Reviews</span></a>
                            </li>
                            <li>
                                <a href="transactions-list.html"><i class="fe fe-activity"></i>
                                    <span>Transactions</span></a>
                            </li>
                            <li>
                                <a href="settings.html"><i class="fe fe-vector"></i> <span>Settings</span></a>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-document"></i> <span> Reports</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="invoice-report.html">Invoice Reports</a></li>
                                </ul>
                            </li>
                            <li class="menu-title">
                                <span>Pages</span>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-document"></i> <span> Blog </span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="blog.html"> Blog </a></li>
                                    <li><a href="blog-details.html"> Blog Details</a></li>
                                    <li><a href="add-blog.html"> Add Blog </a></li>
                                    <li><a href="edit-blog.html"> Edit Blog </a></li>
                                </ul>
                            </li>
                            <li><a href="product-list.html"><i class="fe fe-layout"></i> <span>Product List</span></a>
                            </li>
                            <li><a href="pharmacy-list.html"><i class="fe fe-vector"></i> <span>Pharmacy List</span></a>
                            </li>
                            <li>
                                <a href="profile.html"><i class="fe fe-user-plus"></i> <span>Profile</span></a>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-document"></i> <span> Authentication </span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="login.html"> Login </a></li>
                                    <li><a href="register.html"> Register </a></li>
                                    <li><a href="forgot-password.html"> Forgot Password </a></li>
                                    <li><a href="lock-screen.html"> Lock Screen </a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-warning"></i> <span> Error Pages </span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="error-404.html">404 Error </a></li>
                                    <li><a href="error-500.html">500 Error </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="blank-page.html"><i class="fe fe-file"></i> <span>Blank Page</span></a>
                            </li>
                            <li class="menu-title">
                                <span>UI Interface</span>
                            </li>
                            <li>
                                <a href="components.html"><i class="fe fe-vector"></i> <span>Components</span></a>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-layout"></i> <span> Forms </span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="form-basic-inputs.html">Basic Inputs </a></li>
                                    <li><a href="form-input-groups.html">Input Groups </a></li>
                                    <li><a href="form-horizontal.html">Horizontal Form </a></li>
                                    <li><a href="form-vertical.html"> Vertical Form </a></li>
                                    <li><a href="form-mask.html"> Form Mask </a></li>
                                    <li><a href="form-validation.html"> Form Validation </a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-table"></i> <span> Tables </span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="tables-basic.html">Basic Tables </a></li>
                                    <li><a href="data-tables.html">Data Table </a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i class="fe fe-code"></i> <span>Multi Level</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li class="submenu">
                                        <a href="javascript:void(0);"> <span>Level 1</span> <span
                                                class="menu-arrow"></span></a>
                                        <ul style="display: none;">
                                            <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                                            <li class="submenu">
                                                <a href="javascript:void(0);"> <span> Level 2</span> <span
                                                        class="menu-arrow"></span></a>
                                                <ul style="display: none;">
                                                    <li><a href="javascript:void(0);">Level 3</a></li>
                                                    <li><a href="javascript:void(0);">Level 3</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="javascript:void(0);"> <span>Level 2</span></a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);"> <span>Level 1</span></a>
                                    </li>
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

    <!-- Custom JS -->
    <script src="{{ url('dashboard/assets/js/script.js') }}"></script>

</body>

<!-- Mirrored from doccure-html.dreamguystech.com/template/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Mar 2021 19:28:55 GMT -->

</html>
