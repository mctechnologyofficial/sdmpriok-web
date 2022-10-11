<div class="main-sidebar main-sidebar-sticky side-menu">
    <div class="sidemenu-logo">
        <a class="main-logo" href="index.html">
            <img src="{{ asset('assets/img/brand/logo-ip.png') }}" class="header-brand-img desktop-logo" alt="logo">
            <img src="{{ asset('assets/img/brand/logo-pln.png') }}" class="header-brand-img icon-logo w-75" alt="logo">
            <img src="{{ asset('assets/img/brand/logo-ip.png') }}" class="header-brand-img desktop-logo theme-logo" alt="logo">
            <img src="{{ asset('assets/img/brand/logo-pln.png') }}" class="header-brand-img icon-logo theme-logo w-75" alt="logo">
        </a>
    </div>
    <div class="main-sidebar-body">
        <ul class="nav">
            <li class="nav-header"><span class="nav-label">Admin</span></li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.home') }}"><span class="shape1"></span><span class="shape2"></span><i class="fas fa-home sidemenu-icon"></i><span class="sidemenu-label">Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i class="fas fa-users sidemenu-icon"></i><span class="sidemenu-label">Employee</span><i class="angle fe fe-chevron-right"></i></a>
                <ul class="nav-sub">
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="/admin/list-employee">List Employee</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="{{ route('team.index') }}">List Team</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="{{ route('role.index') }}">List Role</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><span class="shape1"></span><span class="shape2"></span><i class="fas fa-chalkboard sidemenu-icon"></i><span class="sidemenu-label">Mentoring</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i class="fas fa-users sidemenu-icon"></i><span class="sidemenu-label">Monitoring Chart</span><i class="angle fe fe-chevron-right"></i></a>
                <ul class="nav-sub">
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="/admin/progress-chart">Monitoring Progress Chart</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i class="fas fa-wrench sidemenu-icon"></i><span class="sidemenu-label">Utilities</span><i class="angle fe fe-chevron-right"></i></a>
                <ul class="nav-sub">
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="{{ route('slider.index') }}">Slider</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="{{ route('competency.index') }}">Competency</a>
                    </li>
                </ul>
            </li>
            <li class="nav-header"><span class="nav-label">Supervisor</span></li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home.index') }}"><span class="shape1"></span><span class="shape2"></span><i class="fas fa-home sidemenu-icon"></i><span class="sidemenu-label">Home</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/spv/coaching-mentoring"><span class="shape1"></span><span class="shape2"></span><i class="fas fa-chalkboard sidemenu-icon"></i><span class="sidemenu-label">Coaching Mentoring</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i class="fas fa-book sidemenu-icon"></i><span class="sidemenu-label">Competency Tools</span></a>
                <ul class="nav-sub">
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="/spv/sistem-proteksi">Sistem Proteksi</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i class="fas fa-chart-bar sidemenu-icon"></i><span class="sidemenu-label">Assessment Chart</span><i class="angle fe fe-chevron-right"></i></a>
                <ul class="nav-sub">
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="/spv/chart-personal">Assessment Chart (Personal)</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="/spv/chart-team">Assessment Chart (Team)</a>
                    </li>
                </ul>
            </li>
            <li class="nav-header"><span class="nav-label">Operator</span></li>
            <li class="nav-item">
                <a class="nav-link" href="#"><span class="shape1"></span><span class="shape2"></span><i class="fas fa-home sidemenu-icon"></i><span class="sidemenu-label">Home</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('competency-tools.index') }}"><span class="shape1"></span><span class="shape2"></span><i class="fas fa-book sidemenu-icon"></i><span class="sidemenu-label">Competency Tools</span></a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i class="fas fa-book sidemenu-icon"></i><span class="sidemenu-label">Competency Tools</span></a>
                <ul class="nav-sub">
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="{{ route('competency-tools.index') }}">Tools Gas Turbin</a>
                    </li>
                </ul>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" href="#"><span class="shape1"></span><span class="shape2"></span><i class="fas fa-percent sidemenu-icon"></i><span class="sidemenu-label">Competency Score</span></a>
            </li>
        </ul>
    </div>
</div>
