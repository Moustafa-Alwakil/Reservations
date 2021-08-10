<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from doccure-html.dreamguystech.com/template/layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Mar 2021 19:27:44 GMT -->

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Favicons -->
    <link type="image/x-icon" href={{ url('website/assets/img/favicon.png') }} rel="icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href={{ url('website/assets/css/bootstrap.min.css') }}>

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href={{ url('website/assets/plugins/fontawesome/css/fontawesome.min.css') }}>
    <link rel="stylesheet" href={{ url('website/assets/plugins/fontawesome/css/all.min.css') }}>

    <!-- Main CSS -->
    <link rel="stylesheet" href={{ url('website/assets/css/style.css') }}>
    @yield('stylesheets')

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
                    <a href="{{ route('index') }}" class="navbar-brand logo">
                        <img src={{ url('website/assets/img/logo.png') }} class="img-fluid" alt="Logo">
                    </a>
                </div>
                <div class="main-menu-wrapper">
                    <div class="menu-header">
                        <a href="{{ route('index') }}" class="menu-logo">
                            <img src={{ url('website/assets/img/logo.png') }} class="img-fluid" alt="Logo">
                        </a>
                        <a id="menu_close" class="menu-close" href="javascript:void(0);">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <ul class="main-nav">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <li class="has-submenu @if (Request::url()==route('index')) {{ 'active' }} @endif">
                            <a href="{{ route('index') }}">{{__('website\layouts\layout.home')}}<i class="fas"></i></a>
                        </li>
                        <li class="has-submenu @if (Request::url()==route('all.clinics')) {{ 'active' }} @endif">
                            <a href="{{ route('all.clinics') }}">{{__('website\layouts\layout.clinics')}}<i class="fas"></i></a>
                        </li>
                    </ul>
                </div>
                @php
                    use App\Models\Info;
                @endphp
                <ul class="nav header-navbar-rht">
                    @if (Auth::guard('web')->check())
                        @php
                            $name = Auth::guard('web')->user()->name;
                        @endphp
                        <li class="nav-item dropdown has-arrow logged-item">
                            <a class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <span class="user-img">
                                    {{ ucwords($name['fname'] . ' ' . $name['lname']) }}
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="user-header">
                                    <div class="user-text">
                                        <h6>{{ ucwords($name['fname'] . ' ' . $name['lname']) }}</h6>
                                        <p class="text-muted mb-0">{{__('website\layouts\layout.user')}}</p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="{{route('appointment.index')}}">{{__('website\layouts\layout.appts')}}</a>
                                <a class="dropdown-item" href="{{ route('user.profile') }}">{{__('website\layouts\layout.profile')}}</a>
                                <form method="POST" action="{{ route('user.logout') }}" class="d-inline">
                                    @csrf<button class="btn btn-link dropdown-item"
                                        href="{{ route('user.logout') }}">{{__('website\layouts\layout.logout')}}</button>
                                </form>
                            </div>
                        </li>
                    @elseif (Auth::guard('doc')->check())
                        @php
                            $name = Auth::guard('doc')->user()->name;
                            $info = Info::where('physican_id', Auth::guard('doc')->user()->id)->first();
                        @endphp
                        <li class="nav-item dropdown has-arrow logged-item">
                            <a class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <span class="user-img">
                                    @if ($info)
                                        <img class="rounded-circle" src="{{ $info->photo }}" width="31"
                                            alt="Profile Picture">
                                    @endif
                                    {{ ucwords($name['fname_' . LaravelLocalization::getCurrentLocale()] . ' ' . $name['lname_' . LaravelLocalization::getCurrentLocale()]) }}
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="user-header">
                                    @if ($info)
                                        <div class="avatar avatar-sm">
                                            <img class="rounded-circle" src="{{ $info->photo }}" width="31"
                                                alt="Profile Picture">
                                        </div>
                                    @endif
                                    <div class="user-text">
                                        <h6>{{ ucwords($name['fname_' . LaravelLocalization::getCurrentLocale()] . ' ' . $name['lname_' . LaravelLocalization::getCurrentLocale()]) }}
                                        </h6>
                                        <p class="text-muted mb-0">{{__('website\layouts\layout.doctor')}}</p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="{{ route('clinics.index') }}">{{__('website\layouts\layout.dashboard')}}</a>
                                <a class="dropdown-item" href="{{ route('doctor.profile') }}">{{__('website\layouts\layout.profile')}}</a>
                                <form method="POST" action="{{ route('doctor.logout') }}" class="d-inline">
                                    @csrf<button class="btn btn-link dropdown-item"
                                        href="{{ route('doctor.logout') }}">{{__('website\layouts\layout.logout')}}</button>
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item dropdown has-arrow logged-item">
                            <a class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <span class="user-img">
                                    {{__('website\layouts\layout.user')}}
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('user.login') }}">{{__('website\layouts\layout.login')}}</a>
                                <a class="dropdown-item" href="{{ route('user.register') }}">{{__('website\layouts\layout.register')}}</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown has-arrow logged-item">
                            <a class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <span class="user-img">
                                    {{__('website\layouts\layout.doctor')}}
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('doctor.login') }}">{{__('website\layouts\layout.login')}}</a>
                                <a class="dropdown-item" href="{{ route('doctor.register') }}">{{__('website\layouts\layout.register')}}</a>
                            </div>
                        </li>
                    @endif
                    {{-- language switcher --}}
                    <li class="nav-item dropdown has-arrow logged-item">
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <span class="user-img">
                                {{__('website\layouts\layout.lang')}}
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
                    {{-- end language switcher --}}
                </ul>
            </nav>
        </header>
        <!-- /Header -->
        @yield('content')
        <!-- Footer -->
        @if (!(Request::url() == route('user.verification.notice') || Request::url() == route('doctor.verification.notice')))
            <footer class="footer">

                <!-- Footer Top -->
                <div class="footer-top">
                    <div class="container-fluid">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-3 col-md-6">

                                <!-- Footer Widget -->
                                <div class="footer-widget footer-about">
                                    <div class="footer-logo">
                                        <img src={{ url('website/assets/img/footer-logo.png') }} alt="logo">
                                    </div>
                                    <div class="footer-about-content">
                                        <p>{{__('website\layouts\layout.lorem')}} </p>
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
                                <div class="footer-widget footer-contact">
                                    <h2 class="footer-title">{{__('website\layouts\layout.contactus')}}</h2>
                                    <div class="footer-contact-info">
                                        <p>
                                            <i class="fas fa-phone-alt"></i>
                                            +2 010 155 154 50
                                        </p>
                                        <p class="mb-0">
                                            <i class="fas fa-envelope"></i>
                                            moustafaalwakil@gmail.com
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
                                        <p class="mb-0">&copy; 2021 Doccure. {{__('website\layouts\layout.rights')}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">

                                    <!-- Copyright Menu -->
                                    <div class="copyright-menu">
                                        <ul class="policy-menu">
                                            <li><a href="{{route('terms')}}">{{__('website\layouts\layout.terms')}}</a></li>
                                            <li><a href="{{route('policy')}}">{{__('website\layouts\layout.policy')}}</a></li>
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
        @endif
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

    <!-- Sticky Sidebar JS -->
	<script src="{{url('website/assets/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"></script>
	<script src="{{url('website/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"></script>

    <!-- Custom JS -->
    <script src={{ url('website/assets/js/script.js') }}></script>
    @yield('scripts')
</body>

<!-- Mirrored from doccure-html.dreamguystech.com/template/layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Mar 2021 19:28:08 GMT -->

</html>
