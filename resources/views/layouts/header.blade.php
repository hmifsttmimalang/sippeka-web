<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="/" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('assets/user/img/silastri/logo_jatim.png') }}" alt="">
            <h1 class="sitename">SIPPEKA</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero" class="active">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#services">Services</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        @if (Route::has('login'))
        @auth
        <a class="btn-getstarted" href="{{ route('user.dashboard', ['username' => auth()->user()->username]) }}">{{ auth()->user()->username }}</a>
        <a class="btn-getstarted" href="/logout">Keluar</a>
        @else
        <a class="btn-getstarted" href="{{ route('login') }}">Masuk</a>
        <a class="btn-getstarted" href="{{ route('register') }}">Buat Akun</a>
        @endauth
        @endif
    </div>
</header>
