<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/user/img/silastri/logo_jatim.png') }}" rel="icon">
    <link href="{{ asset('assets/user/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/user/css/main.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Header -->
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
                    <li><a href="/">Beranda</a></li>
                    <li><a href="/#about">Tentang Kami</a></li>
                    <li><a href="/#features">Layanan</a></li>
                    <li><a href="/#services">Pengumuman</a></li>
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

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    <footer id="footer" class="footer position-relative light-background">
        <div class="container footer-top">
            <div class="row">
                <div class="col-lg-6 col-md-6 footer-about">
                    <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                        <span class="sitename">SIPPEKA</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jl. Raya Singosari, Song Song, Ardimulyo, </p>
                        <p>Kec. Singosari, Kabupaten Malang, Jawa Timur, 65153</p>
                        <p class="mt-3"><strong>Telepon Kantor :</strong> <span>0341 - 458055</span></p>
                        <p class="mt-3"><strong>WhatsApp:</strong> <span>08233435222</span></p>
                        <p><strong>Email:</strong> <span>blk.singosari.jatim@gmail.com</span></p>
                    </div>
    
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 footer-newsletter">
                    <h4>Informasi Terkini</h4>
                    <p>Daftarkan email anda untuk mendapatkan informasi terkini di UPT BLK Singosari.</p>
                    <form action="" method="post" class="php-email-form">
                        <div class="d-flex w-100 gap-2">
                            <label for="newsletter1" class="visually-hidden">Alamat email</label>
                            <input id="newsletter1" type="text" class="form-control" placeholder="Alamat email">
                            <button class="btn btn-primary" type="button">Subscribe</button>
                          </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container copyright text-center mt-4">
            <p>2024 © <span>Copyright</span><strong class="px-1 sitename">SIPPEKA</strong><span>All Rights Reserved</span></p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">SIPPEKA</a>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/user/js/main.js') }}"></script>
</body>
</html>
