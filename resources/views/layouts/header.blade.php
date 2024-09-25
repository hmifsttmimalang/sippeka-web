<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('assets/user/img/silastri/logo_jatim.png') }}" alt="">
            <h1 class="sitename">SIPPEKA</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero" class="active">Beranda</a></li>
                <li><a href="#about">Tentang Kami</a></li>
                <li><a href="#features">Layanan</a></li>
                <li><a href="#services">Pengumuman</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        @if (Route::has('auth.login'))
        @auth
        <a class="btn-getstarted" href="{{ route('user.dashboard', ['username' => auth()->user()->username]) }}">{{ auth()->user()->username }}</a>
        <form action="{{ route('auth.logout') }}" method="post">
            @csrf
            @method('POST')
            <button class="btn btn-getstarted" tyoe="submit">Keluar</button>
        </form>
        @else
        <a class="btn-getstarted" href="{{ route('auth.login') }}">Masuk</a>
        <a class="btn-getstarted" href="{{ route('auth.register') }}">Buat Akun</a>
        @endauth
        @endif
    </div>
</header>
