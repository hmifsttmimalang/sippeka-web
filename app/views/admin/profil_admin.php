    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" href="../admin/dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="../admin/kelola_data">
                    <i class="bi bi-card-list"></i>
                    <span>Kelola Data Peserta</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="../admin/peserta">
                    <i class="bi bi-person"></i>
                    <span>Peserta</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../auth/logout">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->
        </ul>
    </aside>
    <!-- End Sidebar-->

    <main id="main" class="main">
        <div class="pagetitle">
            <h1><?= $data['title'] ?></h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Profil</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <!-- Section-->
        <section class="section dashboard">
            <?php if (isset($data['error'])) : ?>
                <div class="alert alert-danger mb-5" role="alert">
                    <?= $data['error']; ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="row">
                    <div class="col-md-8">
                        <form class="" method="post" action="./profil_admin" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" value="" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" value="" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="" autocomplete="off">
                            </div>

                            <div class="form-group row mb-4">
                                <div class="col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password Anda..." required>
                                </div>
                                <div class="col-md-6">
                                    <label for="ulangi_password">Ulangi Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Ulang Password Anda..." required>
                                </div>
                            </div>

                            <button type="submit" name="simpan" class="btn btn-primary mb-5">Ubah</button>
                            <a href="./dashboard" class="btn btn-danger mb-5">Kembali</a>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <img src="" alt="Profile Image" class="img-fluid">
                        <p>Tidak ada gambar yang diunggah</p>
                        <input type="file" name="profile_image" class="form-control mt-2">
                    </div>
                </div>
            </div>
        </section>
        <!-- End Section -->
    </main>