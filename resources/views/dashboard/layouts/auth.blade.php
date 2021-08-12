<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from doccure-html.dreamguystech.com/template/admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Mar 2021 19:29:10 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>@yield('title')</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{url('dashboard/assets/img/favicon.png')}}">

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{url('dashboard/assets/css/bootstrap.min.css')}}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{url('dashboard/assets/css/font-awesome.min.css')}}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{url('dashboard/assets/css/style.css')}}">
		
		<!--[if lt IE 9]>
			<script src="{{url('dashboard/assets/js/html5shiv.min.js')}}"></script>
			<script src="{{url('dashboard/assets/js/respond.min.js')}}"></script>
		<![endif]-->
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper login-body">
            <div class="login-wrapper">
            	<div class="container">
                	<div class="loginbox">
                    	<div class="login-left">
							<img class="img-fluid" src="{{url('dashboard/assets/img/logo-white.png')}}" alt="Logo">
                        </div>
                        @yield('form')
                    </div>
                </div>
            </div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="{{url('dashboard/assets/js/jquery-3.2.1.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="{{url('dashboard/assets/js/popper.min.js')}}"></script>
        <script src="{{url('dashboard/assets/js/bootstrap.min.js')}}"></script>
		
		<!-- Custom JS -->
		<script src="{{url('dashboard/assets/js/script.js')}}"></script>
		
    </body>

<!-- Mirrored from doccure-html.dreamguystech.com/template/admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Mar 2021 19:29:10 GMT -->
</html>