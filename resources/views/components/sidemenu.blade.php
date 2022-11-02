<div class="main-sidebar main-sidebar-sticky side-menu">
    <div class="sidemenu-logo">
        <a class="main-logo" href="index.html">
            <img src="{{ asset('assets/img/brand/logo-ip.png') }}" class="header-brand-img desktop-logo" alt="logo">
            <img src="{{ asset('assets/img/brand/logo-pln.png') }}" class="header-brand-img icon-logo w-75" alt="logo">
            <img src="{{ asset('assets/img/brand/logo-ip.png') }}" class="header-brand-img desktop-logo theme-logo"
                alt="logo">
            <img src="{{ asset('assets/img/brand/logo-pln.png') }}" class="header-brand-img icon-logo theme-logo w-75"
                alt="logo">
        </a>
    </div>
    <div class="main-sidebar-body">
        {{-- <ul class="nav"> --}}
        @role('admin')
            <ul class="nav">
                {{-- <li class="nav-header"><span class="nav-label">Admin</span></li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.index') }}"><span class="shape1"></span><span
                            class="shape2"></span><i class="fas fa-home sidemenu-icon"></i><span
                            class="sidemenu-label">Dashboard</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i
                            class="fas fa-users sidemenu-icon"></i><span class="sidemenu-label">Employee</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-sub-item">
                            <a class="nav-sub-link" href="{{ route('employee.index') }}">List Employee</a>
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
                    <a class="nav-link" href="#"><span class="shape1"></span><span class="shape2"></span><i
                            class="fas fa-chalkboard sidemenu-icon"></i><span class="sidemenu-label">Mentoring</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i
                            class="fas fa-users sidemenu-icon"></i><span class="sidemenu-label">Monitoring Chart</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-sub-item">
                            <a class="nav-sub-link" href="{{ route('progress-chart.index') }}">Monitoring Progress Chart</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i
                            class="fas fa-wrench sidemenu-icon"></i><span class="sidemenu-label">Utilities</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-sub-item">
                            <a class="nav-sub-link" href="{{ route('slider.index') }}">Slider</a>
                        </li>
                        <li class="nav-sub-item">
                            <a class="nav-sub-link" href="{{ route('competency.index') }}">Competency</a>
                        </li>
                    </ul>
                </li>
            </ul>
        @endrole

        @role('supervisor senior')
            <ul class="nav">
                {{-- <li class="nav-header"><span class="nav-label">Supervisor</span></li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('spv.senior.index') }}"><span class="shape1"></span><span
                            class="shape2"></span><i class="fas fa-home sidemenu-icon"></i><span
                            class="sidemenu-label">Home</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('spv.senior.coaching.list')}}"><span class="shape1"></span><span
                            class="shape2"></span><i class="fas fa-chalkboard sidemenu-icon"></i><span
                            class="sidemenu-label">Coaching Mentoring</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link with-sub" href="#"><span class="shape1"></span><span
                            class="shape2"></span><i class="fas fa-chart-bar sidemenu-icon"></i><span
                            class="sidemenu-label">Assessment Chart</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-sub-item">
                            <a class="nav-sub-link" href="{{ route('chart-personal.personal') }}">Assessment Chart
                                (Personal)</a>
                        </li>
                        <li class="nav-sub-item">
                            <a class="nav-sub-link" href="{{ route('chart-team.team') }}">Assessment Chart (Team)</a>
                        </li>
                    </ul>
                </li>
            </ul>
        @endrole

        @role('supervisor')
            <ul class="nav">
                {{-- <li class="nav-header"><span class="nav-label">Supervisor</span></li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('spv.index') }}"><span class="shape1"></span><span
                            class="shape2"></span><i class="fas fa-home sidemenu-icon"></i><span
                            class="sidemenu-label">Home</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('spv.coaching.list')}}"><span class="shape1"></span><span
                            class="shape2"></span><i class="fas fa-chalkboard sidemenu-icon"></i><span
                            class="sidemenu-label">Coaching Mentoring</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('competency-tools-spv.index') }}"><span
                            class="shape1"></span><span class="shape2"></span><i
                            class="fas fa-book sidemenu-icon"></i><span class="sidemenu-label">Competency Tools</span></a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link with-sub" href="#"><span class="shape1"></span><span
                            class="shape2"></span><i class="fas fa-chart-bar sidemenu-icon"></i><span
                            class="sidemenu-label">Assessment Chart</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-sub-item">
                            <a class="nav-sub-link" href="{{ route('chart-personal.personal') }}">Assessment Chart
                                (Personal)</a>
                        </li>
                        <li class="nav-sub-item">
                            <a class="nav-sub-link" href="{{ route('chart-team.team') }}">Assessment Chart (Team)</a>
                        </li>
                    </ul>
                </li>
            </ul>
        @endrole

        @role('operator')
            <ul class="nav">
                {{-- <li class="nav-header"><span class="nav-label">Operator</span></li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('op.index') }}"><span class="shape1"></span><span
                            class="shape2"></span><i class="fas fa-home sidemenu-icon"></i><span
                            class="sidemenu-label">Home</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('competency-tools-op.index') }}"><span
                            class="shape1"></span><span class="shape2"></span><i
                            class="fas fa-book sidemenu-icon"></i><span class="sidemenu-label">Competency Tools</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><span class="shape1"></span><span class="shape2"></span><i
                            class="fas fa-percent sidemenu-icon"></i><span class="sidemenu-label">Competency
                            Score</span></a>
                </li>
            </ul>
        @endrole
        {{-- </ul> --}}
    </div>
</div>
