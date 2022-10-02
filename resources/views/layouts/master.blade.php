<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
		<meta name="description" content="Indonesia Power Dashboard">
		<meta name="author" content="PT Indonesia Power">
		<meta name="keywords" content="sdmpriok, indonesianpower">

		<!-- Favicon -->
		<link rel="icon" href="assets/img/brand/logo-pln.png" type="image/x-icon"/>

		<!-- Title -->
		<title>@yield('title')</title>

		<!-- Bootstrap css-->
		<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>

		<!-- Icons css-->
		<link href="{{ asset('assets/plugins/web-fonts/icons.css') }}" rel="stylesheet"/>
		<link href="{{ asset('assets/plugins/web-fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/plugins/web-fonts/plugin.css') }}" rel="stylesheet"/>

		<!-- Style css-->
		<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/skins.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/dark-style.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/colors/default.css') }}" rel="stylesheet">

		<!-- Color css-->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/colors/color.css') }}">

		<!-- Select2 css-->
		<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

		<!-- Mutipleselect css-->
		<link rel="stylesheet" href="{{ asset('assets/plugins/multipleselect/multiple-select.css') }}">

		<!-- Sidemenu css-->
		<link href="{{ asset('assets/css/sidemenu/sidemenu.css') }}" rel="stylesheet">

	</head>

	<body class="main-body leftmenu">

		<!-- Loader -->
		<div id="global-loader">
			<img src="{{ asset('assets/img/loader.svg') }}" class="loader-img" alt="Loader">
		</div>
		<!-- End Loader -->

		<!-- Page -->
		<div class="page">

			<!-- Sidemenu -->
			@include('components.sidemenu')
			<!-- End Sidemenu -->

			<!-- Header-->
			@include('components.header')
			<!-- Header closed -->

			<!-- Main Content-->
			@yield('content')
			<!-- End Main Content-->

			<!-- Main Footer-->
			@include('components.footer')
			<!--End Footer-->

			<!-- Sidebar -->
			@include('components.sidebar')
			<!-- End Sidebar -->

		</div>
		<!-- End Page -->

		<!-- Back-to-top -->
		<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

		<!-- Jquery js-->
		<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

		<!-- Bootstrap js-->
		<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

		<!-- Internal Chart.Bundle js-->
		<script src="{{ asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

		<!-- Peity js-->
		<script src="{{ asset('assets/plugins/peity/jquery.peity.min.js') }}"></script>

		<!-- Select2 js-->
		<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

		<!-- Perfect-scrollbar js -->
		<script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

		<!-- Sidemenu js -->
		<script src="{{ asset('assets/plugins/sidemenu/sidemenu.js') }}"></script>

		<!-- Sidebar js -->
		<script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>

		<!-- Internal Morris js -->
		<script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/morris.js/morris.min.js') }}"></script>

		<!-- Circle Progress js-->
		<script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>
		<script src="{{ asset('assets/js/chart-circle.js') }}"></script>

		<!-- Internal Dashboard js-->
		<script src="{{ asset('assets/js/index.js') }}"></script>

		<!-- Sticky js -->
		<script src="{{ asset('assets/js/sticky.js') }}"></script>

		<!-- Custom js -->
		<script src="{{ asset('assets/js/custom.js') }}"></script>


	</body>
</html>