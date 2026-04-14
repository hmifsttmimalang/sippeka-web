<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/profile/img/logo_jatim.png') }}" alt="Logo">
            <span class="d-none d-lg-block">SIPPEKA</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    @if($registration && $registration->formal_photo_path)
                        <img src="{{ asset('storage/' . $registration->formal_photo_path) }}" alt="Profile" class="rounded-circle" width="35" height="35">
                    @else
                        <img src="{{ asset('assets/admin/img/undraw_profile.svg') }}" alt="Profile" class="rounded-circle" width="35" height="35">
                    @endif
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ $user->username }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ $user->username }}</h6>
                        <span>Peserta</span>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('user.dashboard') }}">
                            <i class="bi bi-grid"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('student.edit_profile') }}">
                            <i class="bi bi-person"></i>
                            <span>Edit Profil</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Keluar</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
