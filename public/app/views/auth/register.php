<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                            <a href="./register" class="logo d-flex align-items-center w-auto">
                                <img src="<?= MAIN_URL ?>assets/user-layout/img/logo.png" alt="">
                                <span class="d-none d-block">SIPPEKA</span>
                            </a>
                        </div>
                        <!-- End Logo -->
                        <?php if (isset($data['error'])) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $data['error']; ?>
                            </div>
                        <?php endif; ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                    <p class="text-center small">Masukkan informasi Anda untuk membuat akun!</p>
                                </div>

                                <form class="row g-3 needs-validation" method="post" action="<?= MAIN_URL ?>auth/register">
                                    <div class="col-12">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" name="nama" class="form-control" id="yourName" required>
                                        <div class="invalid-feedback">Silakan masukkan nama kamu!</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="email" class="form-label">Email Kamu</label>
                                        <input type="email" name="email" class="form-control" id="email" required>
                                        <div class="invalid-feedback">Silakan masukkan email yang benar!</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="username" class="form-label">Username</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="username" class="form-control" id="yourUsername" required>
                                            <div class="invalid-feedback">Silakan pilih nama pengguna!</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                                        <div class="invalid-feedback">Silakan masukkan password kamu!</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="confirm_password" class="form-label">Ulangi Password</label>
                                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
                                        <div class="invalid-feedback">Silakan masukkan password ulang!</div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                                            <label class="form-check-label" for="acceptTerms">Saya setuju dengan <a href="#">syarat dan ketentuan</a></label>
                                            <div class="invalid-feedback">Anda harus menyetujui sebelum mengirimkan.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit" name="submit">Buat Akun</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Sudah mempunyai akun? <a href="./login">Log in</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="credits">
                Designed by <a href="..">SIPPEKA</a>
            </div>
        </section>
    </div>
</main>