<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from doccure-html.dreamguystech.com/template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Mar 2021 19:27:44 GMT -->

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>@yield('title')</title>

    <!-- Favicons -->
    <link type="image/x-icon" href={{ url('website/website/assets/img/favicon.png') }} rel="icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href={{ url('website/assets/css/bootstrap.min.css') }}>

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href={{ url('website/assets/plugins/fontawesome/css/fontawesome.min.css') }}>
    <link rel="stylesheet" href={{ url('website/assets/plugins/fontawesome/css/all.min.css') }}>

    <!-- Main CSS -->
    <link rel="stylesheet" href={{ url('website/assets/css/style.css') }}>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
   <script src="website/assets/js/html5shiv.min.js"></script>
   <script src="website/assets/js/respond.min.js"></script>
  <![endif]-->

</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <header class="header">
            <nav class="navbar navbar-expand-lg header-nav">
                <div class="navbar-header">
                    <a id="mobile_btn" href="javascript:void(0);">
                        <span class="bar-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </a>
                    <a href="{{ route('home') }}" class="navbar-brand logo">
                        <img src={{ url('website/assets/img/logo.png') }} class="img-fluid" alt="Logo">
                    </a>
                </div>
                <div class="main-menu-wrapper">
                    <div class="menu-header">
                        <a href="{{ route('home') }}" class="menu-logo">
                            <img src={{ url('website/assets/img/logo.png') }} class="img-fluid" alt="Logo">
                        </a>
                        <a id="menu_close" class="menu-close" href="javascript:void(0);">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <ul class="main-nav">
                        <li class="has-submenu active">
                            <a href="{{ route('home') }}">{{ __('index.home') }}<i class="fas"></i></a>
                        </li>
                        <li class="has-submenu">
                            <a href="#">Doctors <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu">
                                <li><a href="doctor-dashboard.html">Doctor Dashboard</a></li>
                                <li><a href="appointments.html">Appointments</a></li>
                                <li><a href="schedule-timings.html">Schedule Timing</a></li>
                                <li><a href="my-patients.html">Patients List</a></li>
                                <li><a href="patient-profile.html">Patients Profile</a></li>
                                <li><a href="chat-doctor.html">Chat</a></li>
                                <li><a href="invoices.html">Invoices</a></li>
                                <li><a href="doctor-profile-settings.html">Profile Settings</a></li>
                                <li><a href="reviews.html">Reviews</a></li>
                                <li><a href="doctor-register.html">Doctor Register</a></li>
                                <li class="has-submenu">
                                    <a href="doctor-blog.html">Blog</a>
                                    <ul class="submenu">
                                        <li><a href="doctor-blog.html">Blog</a></li>
                                        <li><a href="blog-details.html">Blog view</a></li>
                                        <li><a href="doctor-add-blog.html">Add Blog</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#">Patients <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu">
                                <li class="has-submenu">
                                    <a href="#">Doctors</a>
                                    <ul class="submenu">
                                        <li><a href="map-grid.html">Map Grid</a></li>
                                        <li><a href="map-list.html">Map List</a></li>
                                    </ul>
                                </li>
                                <li><a href="search.html">Search Doctor</a></li>
                                <li><a href="doctor-profile.html">Doctor Profile</a></li>
                                <li><a href="booking.html">Booking</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="booking-success.html">Booking Success</a></li>
                                <li><a href="patient-dashboard.html">Patient Dashboard</a></li>
                                <li><a href="favourites.html">Favourites</a></li>
                                <li><a href="chat.html">Chat</a></li>
                                <li><a href="profile-settings.html">Profile Settings</a></li>
                                <li><a href="change-password.html">Change Password</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#">Pharmacy <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu">
                                <li><a href="pharmacy-index.html">Pharmacy</a></li>
                                <li><a href="pharmacy-details.html">Pharmacy Details</a></li>
                                <li><a href="pharmacy-search.html">Pharmacy Search</a></li>
                                <li><a href="product-all.html">Product</a></li>
                                <li><a href="product-description.html">Product Description</a></li>
                                <li><a href="cart.html">Cart</a></li>
                                <li><a href="product-checkout.html">Product Checkout</a></li>
                                <li><a href="payment-success.html">Payment Success</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#">Pages <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu">
                                <li><a href="voice-call.html">Voice Call</a></li>
                                <li><a href="video-call.html">Video Call</a></li>
                                <li><a href="search.html">Search Doctors</a></li>
                                <li><a href="calendar.html">Calendar</a></li>
                                <li><a href="components.html">Components</a></li>
                                <li class="has-submenu">
                                    <a href="invoices.html">Invoices</a>
                                    <ul class="submenu">
                                        <li><a href="invoices.html">Invoices</a></li>
                                        <li><a href="invoice-view.html">Invoice View</a></li>
                                    </ul>
                                </li>
                                <li><a href="blank-page.html">Starter Page</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="register.html">Register</a></li>
                                <li><a href="forgot-password.html">Forgot Password</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#">Blog <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu">
                                <li><a href="blog-list.html">Blog List</a></li>
                                <li><a href="blog-grid.html">Blog Grid</a></li>
                                <li><a href="blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#" target="_blank">Admin <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu">
                                <li><a href="admin/index.html" target="_blank">Admin</a></li>
                                <li><a href="pharmacy/index.html" target="_blank">Pharmacy Admin</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <ul class="nav header-navbar-rht">
                    @if (Auth::guard('web')->check())
                        @php
                            $name = Auth::guard('web')->user()->name;
                        @endphp
                        <li class="nav-item dropdown has-arrow logged-item">
                            <a class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <span class="user-img">
                                    {{ $name['fname'] . ' ' . $name['lname'] }}
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="user-header">
                                    <div class="user-text">
                                        <h6>{{ $name['fname'] . ' ' . $name['lname'] }}</h6>
                                        <p class="text-muted mb-0">User</p>
                                    </div>
                                </div>
                                <a class="dropdown-item"
                                    href="{{ route('user.profile')}}">Profile</a>
                                <form method="POST" action="{{ route('user.logout') }}" class="d-inline">
                                    @csrf<button class="btn btn-link dropdown-item"
                                        href="{{ route('user.logout') }}">Logout</button>
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item dropdown has-arrow logged-item">
                            <a class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <span class="user-img">
                                    User
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('user.login') }}">Login</a>
                                <a class="dropdown-item" href="{{ route('user.register') }}">Register</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown has-arrow logged-item">
                            <a class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <span class="user-img">
                                    Doctor
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="patient-dashboard.html">Login</a>
                                <a class="dropdown-item" href="{{route('doctor.register')}}">Register</a>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item dropdown has-arrow logged-item">
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <span class="user-img">
                                Language
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                    class="dropdown-item">
                                    {{ $properties['native'] }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                </ul>
            </nav>
        </header>
        @yield('bar')
        <!-- /Header -->
        @yield('content')
        <!-- Footer -->
        <footer class="footer">

            <!-- Footer Top -->
            <div class="footer-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">

                            <!-- Footer Widget -->
                            <div class="footer-widget footer-about">
                                <div class="footer-logo">
                                    <img src={{ url('website/assets/img/footer-logo.png') }} alt="logo">
                                </div>
                                <div class="footer-about-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                    <div class="social-icon">
                                        <ul>
                                            <li>
                                                <a href="#" target="_blank"><i class="fab fa-facebook-f"></i> </a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank"><i class="fab fa-twitter"></i> </a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank"><i class="fab fa-dribbble"></i> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /Footer Widget -->

                        </div>

                        <div class="col-lg-3 col-md-6">

                            <!-- Footer Widget -->
                            <div class="footer-widget footer-menu">
                                <h2 class="footer-title">For Patients</h2>
                                <ul>
                                    <li><a href="search.html">Search for Doctors</a></li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="register.html">Register</a></li>
                                    <li><a href="booking.html">Booking</a></li>
                                    <li><a href="patient-dashboard.html">Patient Dashboard</a></li>
                                </ul>
                            </div>
                            <!-- /Footer Widget -->

                        </div>

                        <div class="col-lg-3 col-md-6">

                            <!-- Footer Widget -->
                            <div class="footer-widget footer-menu">
                                <h2 class="footer-title">For Doctors</h2>
                                <ul>
                                    <li><a href="appointments.html">Appointments</a></li>
                                    <li><a href="chat.html">Chat</a></li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="doctor-register.html">Register</a></li>
                                    <li><a href="doctor-dashboard.html">Doctor Dashboard</a></li>
                                </ul>
                            </div>
                            <!-- /Footer Widget -->

                        </div>

                        <div class="col-lg-3 col-md-6">

                            <!-- Footer Widget -->
                            <div class="footer-widget footer-contact">
                                <h2 class="footer-title">Contact Us</h2>
                                <div class="footer-contact-info">
                                    <div class="footer-address">
                                        <span><i class="fas fa-map-marker-alt"></i></span>
                                        <p> 3556 Beech Street, San Francisco,<br> California, CA 94108 </p>
                                    </div>
                                    <p>
                                        <i class="fas fa-phone-alt"></i>
                                        +1 315 369 5943
                                    </p>
                                    <p class="mb-0">
                                        <i class="fas fa-envelope"></i>
                                        doccure@example.com
                                    </p>
                                </div>
                            </div>
                            <!-- /Footer Widget -->

                        </div>

                    </div>
                </div>
            </div>
            <!-- /Footer Top -->

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="container-fluid">

                    <!-- Copyright -->
                    <div class="copyright">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="copyright-text">
                                    <p class="mb-0">&copy; 2020 Doccure. All rights reserved.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">

                                <!-- Copyright Menu -->
                                <div class="copyright-menu">
                                    <ul class="policy-menu">
                                        <li><a href="term-condition.html">Terms and Conditions</a></li>
                                        <li><a href="privacy-policy.html">Policy</a></li>
                                    </ul>
                                </div>
                                <!-- /Copyright Menu -->

                            </div>
                        </div>
                    </div>
                    <!-- /Copyright -->

                </div>
            </div>
            <!-- /Footer Bottom -->

        </footer>
        <!-- /Footer -->

    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src={{ url('website/assets/js/jquery.min.js') }}></script>

    <!-- Bootstrap Core JS -->
    <script src={{ url('website/assets/js/popper.min.js') }}></script>
    <script src={{ url('website/assets/js/bootstrap.min.js') }}></script>

    <!-- Slick JS -->
    <script src={{ url('website/assets/js/slick.js') }}></script>

    <!-- Custom JS -->
    <script src={{ url('website/assets/js/script.js') }}></script>

</body>

<!-- Mirrored from doccure-html.dreamguystech.com/template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Mar 2021 19:28:08 GMT -->

</html>
