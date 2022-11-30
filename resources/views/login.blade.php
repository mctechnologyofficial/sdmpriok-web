<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="Indonesia Power Dashboard">
    <meta name="author" content="PT Indonesia Power">
    <meta name="keywords" content="sdmpriok, indonesianpower">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/brand/logo-pln.png') }}" type="image/x-icon" />

    <!-- Title -->
    <title>Indonesia Power - Login</title>

    <!-- Bootstrap css-->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Icons css-->
    <link href="{{ asset('assets/plugins/web-fonts/icons.css" rel="stylesheet') }}" />
    <link href="{{ asset('assets/plugins/web-fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/web-fonts/plugin.css') }}" rel="stylesheet" />

    <!-- Style css-->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/skins.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/dark-style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/colors/default.css') }}" rel="stylesheet">

    <!-- Color css-->
    <link id="theme" rel="stylesheet" type="text/css" media="all"
        href="{{ asset('assets/css/colors/color.css') }}">

</head>

<body class="main-body leftmenu">

    <!-- Loader -->
    <div id="global-loader">
        <img src="{{ asset('assets/img/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- End Loader -->

    <!-- Page -->
    <div class="page main-signin-wrapper">
        <!-- Row -->
        <div class="row signpages text-center">
            <div class="col-md-12">
                @if ($errors->has('email'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Your credential doesn't match with our records.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="row row-sm">
                        <div class="col-lg-6 col-xl-5 d-none d-lg-block text-center details">
                            <div class="mt-5 pt-4 p-2 pos-absolute">
                                <img src="{{ asset('assets/img/brand/logo-ip.png') }}"
                                    class="header-brand-img mb-4 w-75" alt="logo">
                                <div class="clearfix"></div>
                                <img src="{{ asset('assets/img/svgs/user.svg') }}" class="ht-100 mb-0" alt="user">
                                <h5 class="mt-4 text-white">Aplikasi SDM Indonesia Power</h5>
                                {{-- <span class="tx-white-6 tx-13 mb-5 mt-xl-0">Signup to create, discover and connect with the global community</span> --}}
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-7 col-xs-12 col-sm-12 login_form ">
                            <div class="container-fluid">
                                <div class="row row-sm">
                                    <div class="card-body mt-2 mb-2">
                                        <img src="{{ asset('assets/img/brand/logo-ip.png') }}"
                                            class="w-50 d-lg-none header-brand-img text-left float-left mb-4"
                                            alt="logo">
                                        <div class="clearfix"></div>
                                        <form method="POST" action="{{ route('login') }}">
											@csrf
                                            <h5 class="text-left mb-2">Signin to Your Account</h5>
                                            {{-- <p class="mb-4 text-muted tx-13 ml-0 text-left">Signin to create, discover and connect with the global community</p> --}}
                                            <div class="form-group text-left">
                                                <label>Email</label>
                                                <input class="form-control" placeholder="Enter your email"
                                                    type="text" name="email">
                                            </div>
                                            <div class="form-group text-left">
                                                <label>Password</label>
                                                <input class="form-control" placeholder="Enter your password"
                                                    type="password" name="password">
                                            </div>
                                            <button class="btn ripple btn-main-primary btn-block">Sign In</button>
                                        </form>
                                        <div class="text-left mt-3 ml-0">
                                            <div class="mb-1"><a href="">Forgot password?</a></div>
                                            {{-- <div>Don't have an account? <a href="#">Register Here</a></div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

    </div>
    <!-- End Page -->

    <!-- Jquery js-->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Select2 js-->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

    <!-- Custom js -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

</body>

</html>
