<?php
  include 'header.php'; 
?>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets2/img/logo.png" alt="">
                  <span class="d-none d-lg-block">SILASTRI</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Masuk Ke Akun Kamu</h5>
                    <p class="text-center small">Masukkan username & password untuk login</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Harap masukkan username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Harap masukkan password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Saya ingat</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <a href="index.html">
                        <button class="btn btn-primary w-100" type="submit">Login</button>
                      </a>                    
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Belum punya akun? <a href="register.php">Buat akun</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                Designed by <a href="index.html">SILASTRI</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>
  <!-- End #main -->

<?php 
include 'footer.php'; 
?>