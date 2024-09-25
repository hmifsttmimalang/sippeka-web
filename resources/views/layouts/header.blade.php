<style>
    .auth-buttons {
        display: flex;
        align-items: center;
        /* Sejajarkan secara vertikal */
        gap: 10px;
        /* Beri jarak antara tombol username dan logout */
    }

    .logout-btn {
        background: none;
        font-family: 'Inter', sans-serif;
        border: none;
        font-size: 17px;
        text-decoration: none;
        cursor: pointer;
        padding: 10px 20px;
        margin: 0;
        /* Hilangkan margin tambahan */
    }

    /* Pastikan untuk mereset margin dan padding di tombol */
    .auth-buttons button {
        padding: 10px 20px;
        /* Sesuaikan padding sesuai kebutuhan */
    }

    /* Tampilan mobile */
    @media (max-width: 1024px) {
        .mobile-only {
            display: block;
            text-align: left;
            /* Rata kiri */
        }

        .navmenu ul li {
            margin-bottom: 15px;
            /* Jarak antar item */
        }
    }

    /* Untuk desktop */
    @media (min-width: 1025px) {
        .auth-buttons {
            display: flex;
            align-items: center;
            /* Sejajarkan secara vertikal */
        }

        .mobile-only {
            display: none;
        }
    }
</style>

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
                @auth
                    <li class="mobile-only">
                        <a
                            href="{{ route('user.dashboard', ['username' => auth()->user()->username]) }}">{{ auth()->user()->username }}</a>
                    </li>
                    <li class="mobile-only">
                        <form action="{{ route('auth.logout') }}" method="post" class="d-inline">
                            @csrf
                            @method('POST')
                            <button type="submit" class="logout-btn">Keluar</button>
                        </form>
                    </li>
                @else
                    <li class="mobile-only">
                        <a href="{{ route('auth.login') }}">Masuk</a>
                    </li>
                    <li class="mobile-only">
                        <a href="{{ route('auth.register') }}">Buat Akun</a>
                    </li>
                @endauth
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <div class="auth-buttons d-none d-xl-flex">
            @auth
                <a class="btn-getstarted"
                    href="{{ route('user.dashboard', ['username' => auth()->user()->username]) }}">{{ auth()->user()->username }}</a>
                <form action="{{ route('auth.logout') }}" method="post" class="d-inline">
                    @csrf
                    @method('POST')
                    <button class="btn btn-getstarted" type="submit">Keluar</button>
                </form>
            @else
                <a class="btn-getstarted" href="{{ route('auth.login') }}">Masuk</a>
                <a class="btn-getstarted" href="{{ route('auth.register') }}">Buat Akun</a>
            @endauth
        </div>
    </div>
</header>
