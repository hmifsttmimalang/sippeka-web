<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-university"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin SIPPEKA</div>
    </a>

    <!-- Heading -->
    <div class="sidebar-heading">
        Admin
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item {{ request()->routeIs('admin.registration_list') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.registration_list') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Kelola Data Peserta</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.peserta') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.peserta') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Peserta Terurut</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-list"></i>
            <span>Kelola Keahlian</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admin.question_title_manager') ? 'active' : '' }}" href="{{ route('admin.question_title_manager') }}">Mata Soal Keahlian</a>
                <a class="collapse-item {{ request()->routeIs('admin.kelas_keahlian') ? 'active' : '' }}" href="{{ route('admin.kelas_keahlian') }}">Kelas Keahlian</a>
                <a class="collapse-item {{ request()->routeIs('admin.skill_test_manager') ? 'active' : '' }}" href="{{ route('admin.skill_test_manager') }}">Tes Keahlian</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item {{ request()->routeIs('admin.user_manager') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.user_manager') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Info User</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.evaluation_manager') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.evaluation_manager') }}">
            <i class="fas fa-fw fa-check-circle"></i>
            <span>Evaluasi Peserta</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-folder-plus"></i>
            <span>Kelola Informasi</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.info_jurusan') }}">Jurusan</a>
                <a class="collapse-item" href="{{ route('admin.jadwal_tes') }}">Jadwal Tes</a>
                <a class="collapse-item" href="{{ route('admin.pengumuman') }}">Atur Pengumuman</a>
            </div>
        </div>
    </li>

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
