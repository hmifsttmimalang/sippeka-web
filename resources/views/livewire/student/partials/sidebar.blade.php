<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.dashboard') ? '' : 'collapsed' }}" href="{{ route('user.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>



        <li class="nav-item">
            @if ($registration && $registration->verification_status === 'Rejected')
                <a class="nav-link {{ request()->routeIs('registration.form') ? '' : 'collapsed' }} text-danger" href="{{ route('registration.form') }}">
                    <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                    <span>Ulangi Daftar</span>
                </a>
            @else
                <a class="nav-link {{ request()->routeIs('student.edit_profile') ? '' : 'collapsed' }}" href="{{ route('student.edit_profile') }}">
                    <i class="bi bi-person-fill-gear"></i>
                    <span>Edit Profil</span>
                </a>
            @endif
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Keluar</span>
            </a>
        </li>
    </ul>
</aside>
