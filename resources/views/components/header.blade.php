<!-- Main Header-->
<div class="main-header side-header sticky">
    <div class="container-fluid">
        <div class="main-header-left">
            <a class="main-header-menu-icon" href="#" id="mainSidebarToggle"><span></span></a>
        </div>
        <div class="main-header-center">
            <div class="responsive-logo">
                <a href="/"><img src="{{ asset('assets/img/brand/logo.png') }}" class="mobile-logo" alt="logo"></a>
                <a href="/"><img src="{{ asset('assets/img/brand/logo.png') }}" class="mobile-logo-dark" alt="logo"></a>
            </div>
        </div>
        <div class="main-header-right">
            <div class="dropdown main-profile-menu">
                <a class="d-flex" href="">
                    <span class="main-img-user"><img alt="avatar"
                            src="{{ Storage::url(Auth::user()->image) }}"></span>
                </a>
                <div class="dropdown-menu">
                    <div class="header-navheading">
                        <h6 class="main-notification-title">{{ Auth::user()->name }}</h6>
                        <p class="main-notification-text">{{ Auth::user()->roles->pluck('name')[0] }}</p>
                    </div>
                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                        <i class="fe fe-edit"></i> Edit Profile
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a class="dropdown-item a-logout" href="javascript:void(0)">
                            <i class="fe fe-power"></i> Sign Out
                        </a>
                        <button class="btn-logout" style="display: none;"></button>
                    </form>
                </div>
            </div>
            <button class="navbar-toggler navresponsive-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
            </button>
            <!-- Navresponsive closed -->
        </div>
    </div>
</div>
<!-- End Main Header-->

<!-- Mobile-header -->
<div class="mobile-main-header">
    <div class="mb-1 navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark">
        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
            <div class="d-flex order-lg-2 ml-auto">
                <div class="dropdown main-profile-menu">
                    <a class="d-flex" href="#">
                        <span class="main-img-user"><img alt="avatar" src="{{ Storage::url(Auth::user()->image) }}"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="header-navheading">
                            <h6 class="main-notification-title">{{ Auth::user()->name }}</h6>
                            <p class="main-notification-text">{{ Auth::user()->roles->pluck('name')[0] }}</p>
                        </div>
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="fe fe-edit"></i> Edit Profile
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a class="dropdown-item a-logout" href="javascript:void(0)">
                                <i class="fe fe-power"></i> Sign Out
                            </a>
                            <button class="btn-logout" style="display: none;"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mobile-header closed -->
