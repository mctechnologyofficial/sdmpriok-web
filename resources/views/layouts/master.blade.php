<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
		<meta name="description" content="Indonesia Power Dashboard">
		<meta name="author" content="PT Indonesia Power">
		<meta name="keywords" content="sdmpriok, indonesianpower">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

		<!-- Favicon -->
		<link rel="icon" href="{{ asset('assets/img/brand/logo-pln.png') }}" type="image/x-icon"/>

		<!-- Title -->
		<title>Indonesia Power - @yield('title')</title>

		@include('components.css')
	</head>

	<body class="main-body leftmenu">

		<!-- Loader -->
		{{-- <div id="global-loader">
			<img src="{{ asset('assets/img/loader.svg') }}" class="loader-img" alt="Loader">
		</div> --}}
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
			<div class="main-content side-content pt-0">

                <div class="container-fluid">
                    <div class="inner-body">

                        <!-- Page Header -->
                        <div class="page-header">
                            <div>
                                <h2 class="main-content-title tx-24 mg-b-5">Welcome to Dashboard</h2>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                                </ol>
                            </div>
                        </div>
                        <!-- End Page Header -->

                        @yield('content')
                    </div>
                </div>
            </div>
			<!-- End Main Content-->

			<!-- Main Footer-->
			@include('components.footer')
			<!--End Footer-->

			<!-- Sidebar -->
			{{-- @include('components.sidebar') --}}
			<!-- End Sidebar -->

		</div>
		<!-- End Page -->

		<!-- Back-to-top -->
		<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

        @yield('js')
		@include('components.js')
	</body>
</html>
