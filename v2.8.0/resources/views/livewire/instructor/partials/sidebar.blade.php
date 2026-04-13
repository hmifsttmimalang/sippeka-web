<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('instruktur.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-user-tie"></i>
        </div>
        <div class="sidebar-brand-text mx-2">Instruktur SIPPEKA</div>
    </a>

    <!-- Heading -->
    <div class="sidebar-heading">
        Instruktur
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('instruktur.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('instruktur.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item {{ request()->routeIs('instruktur.kelola_data') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('instruktur.kelola_data') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Kelola Data Peserta</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Keluar</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline mt-3">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
