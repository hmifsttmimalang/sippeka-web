@extends('layouts.auth')

@section('title', 'Daftar Akun')

@section('content')
    <style>
        .position-relative .toggle-password {
            position: absolute;
            top: 50%;
            right: 20px;
            /* Jarak dari sisi kanan */
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.2rem;
            color: #6c757d;
        }

        .position-relative .toggle-password:hover {
            color: #495057;
        }

        .position-relative .form-control {
            padding-right: 40px;
            /* Ruang untuk ikon */
        }

        .toggle-password {
            margin-top: 16px;
            /* Geser lebih jauh ke bawah */
        }
    </style>

    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="{{ route('home') }}" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('assets/user/img/logo_jatim.png') }}" alt="Logo Sippeka">
                                    <span class="d-none d-lg-block">SIPPEKA</span>
                                </a>
                            </div>
                            <!-- End Logo -->

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Buat Akun</h5>
                                        <p class="text-center small">Masukkan informasi Anda untuk membuat akun!</p>
                                    </div>

                                    <form class="row g-3 needs-validation" method="post"
                                        action="{{ route('auth.register.store') }}">
                                        @csrf
                                        @method('POST')
                                        <div class="col-12">
                                            <label for="username" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="username" class="form-control" id="username"
                                                    autocomplete="username" required>
                                                <div class="invalid-feedback">Silakan pilih nama pengguna!</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="email" class="form-label">Email Kamu</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                autocomplete="email" required>
                                            <div class="invalid-feedback">Silakan masukkan email yang benar!</div>
                                        </div>

                                        <div class="col-12 position-relative">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control pr-5" id="password"
                                                required>
                                            <i class="bi bi-eye-slash toggle-password position-absolute"
                                                id="togglePassword"></i>
                                            <div class="invalid-feedback">Silakan masukkan password kamu!</div>
                                        </div>

                                        <div class="col-12 position-relative">
                                            <label for="password_confirmation" class="form-label">Ulangi Password</label>
                                            <input type="password" name="password_confirmation" class="form-control pr-5"
                                                id="password_confirmation" required>
                                            <i class="bi bi-eye-slash toggle-password position-absolute"
                                                id="togglePasswordConfirmation"></i>
                                            <div class="invalid-feedback">Silakan masukkan password ulang!</div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="terms" type="checkbox"
                                                    value="" id="acceptTerms" required>
                                                <label class="form-check-label" for="acceptTerms">Saya setuju dengan <a
                                                        href="#">syarat dan ketentuan</a></label>
                                                <div class="invalid-feedback">Anda harus menyetujui sebelum mengirimkan.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit" name="submit">Buat
                                                Akun</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Sudah mempunyai akun? <a
                                                    href="{{ route('auth.login') }}">Masuk</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer class="credits">
        <div class="container">
            <p class="text-center">All rights reserved. &copy; 2024.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const togglePassword = document.querySelector('#togglePassword');
            const togglePasswordConfirmation = document.querySelector('#togglePasswordConfirmation');

            const password = document.querySelector('#password');
            const passwordConfirmation = document.querySelector('#password_confirmation');

            // Toggle password visibility for the first input
            if (togglePassword && password) {
                togglePassword.addEventListener('click', () => {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);

                    // Change icon
                    togglePassword.classList.toggle('bi-eye');
                    togglePassword.classList.toggle('bi-eye-slash');
                });
            }

            // Toggle password visibility for the confirmation input
            if (togglePasswordConfirmation && passwordConfirmation) {
                togglePasswordConfirmation.addEventListener('click', () => {
                    const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' :
                        'password';
                    passwordConfirmation.setAttribute('type', type);

                    // Change icon
                    togglePasswordConfirmation.classList.toggle('bi-eye');
                    togglePasswordConfirmation.classList.toggle('bi-eye-slash');
                });
            }
        });
    </script>
@endsection
