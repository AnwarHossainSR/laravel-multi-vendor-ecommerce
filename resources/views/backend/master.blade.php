<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Multivendor E-Commerce | Admin </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="{{ asset('admin') }}/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('admin') }}/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('admin') }}/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('admin') }}/img/favicon.ico">
</head>
<body>

     <!-- Navbar -->
     @include('backend.include.header')
     <!-- /.navbar -->

	 <div class="d-flex align-items-stretch">

		<!-- Main Sidebar Container -->
		@include('backend.include.sidebar')

		<!-- Main content -->
		@yield('content')
		<!-- /.content -->

		<!-- Main footer -->
	   @include('backend.include.footer')

	 </div>

    <!-- JavaScript files-->
    <script src="{{ asset('admin') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="{{ asset('admin') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('admin') }}/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="{{ asset('admin') }}/vendor/chart.js/Chart.min.js"></script>
    <script src="{{ asset('admin') }}/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{ asset('admin') }}/js/charts-home.js"></script>
    <script src="{{ asset('admin') }}/js/front.js"></script>
</body>
</html>
