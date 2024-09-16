@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="{{ route('home') }}" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('assets/user/img/logo.png') }}" alt="Logo Sippeka">
                                    <span class="d-none d-lg-block">SIPPEKA</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Masuk Ke Akun Kamu</h5>
                                        <p class="text-center small">Masukkan username atau email & password untuk login</p>
                                    </div>

                                    <form class="row g-3 needs-validation" method="post" action="{{ route('auth.login.store') }}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="identifier" class="form-label">Username atau Email</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="identifier" class="form-control"
                                                    id="yourUsername" required>
                                                <div class="invalid-feedback">Harap masukkan username atau email.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword"
                                                required>
                                            <div class="invalid-feedback">Harap masukkan password!</div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Saya ingat</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Masuk</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Belum punya akun? <a href="{{ route('auth.register') }}">Buat akun</a></p>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>

                            <div class="credits">
                                Designed by <a href="{{ route('home') }}">SIPPEKA</a>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>
@endsection
