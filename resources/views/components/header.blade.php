<div class="main-header side-header sticky">
    <div class="container-fluid">
        <div class="main-header-left">
            <a class="main-header-menu-icon" href="#" id="mainSidebarToggle"><span></span></a>
        </div>
        <div class="main-header-center">
            <div class="responsive-logo">
                <a href="/admin/home"><img src="{{ asset('assets/img/brand/logo-ip-dark.png') }}" class="mobile-logo w-50" alt="logo"></a>
                <a href="/admin/home"><img src="{{ asset('assets/img/brand/logo-ip-dark.png') }}" class="mobile-logo-dark w-50" alt="logo"></a>
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
        </div>
    </div>'
</div>
<div class="mobile-main-header">
    <div class="mb-1 navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark  ">
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
                        <a class="dropdown-item" href="profile.html">
                            <i class="fe fe-edit"></i> Edit Profile
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item">
                                <i class="fe fe-power"> Sign Out
                                </i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>