<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./dashboard">
            <div class="sidebar-brand-text mx-3">Admin SIPPEKA</div>
        </a>

        <!-- Heading -->
        <div class="sidebar-heading">Admin</div>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="./dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item active">
            <a class="nav-link" href="./kelola_data">
                <i class="fas fa-fw fa-list"></i>
                <span>Kelola Data Peserta</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item ">
            <a class="nav-link" href="./peserta">
                <i class="fas fa-fw fa-user"></i>
                <span>Peserta</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="./info_user">
                <i class="fas fa-fw fa-user"></i>
                <span>Info User</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item">
            <a class="nav-link" href="../auth/logout" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrator</span>
                            <img class="img-profile rounded-circle" src="<?= MAIN_URL ?>assets/admin-layout/img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="./profil_admin">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profil
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../auth/logout" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Keluar
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Data Pendaftar</h1>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Tempat Lahir</td>
                                <td>Tanggal Lahir</td>
                                <td>Jenis Kelamin</td>
                                <td>Agama</td>
                                <td>Alamat</td>
                                <td>Nomor Telepon</td>
                                <td>Status</td>
                                <td>Aksi</td>
                            </tr>
                            <?php $i = 1;
                            foreach ($data['registrations'] as $registrant) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $registrant['nama'] ?></td>
                                    <td><?= $registrant['tempat_lahir'] ?></td>
                                    <td><?= $registrant['tanggal_lahir'] ?></td>
                                    <td><?= $registrant['jenis_kelamin'] ?></td>
                                    <td><?= $registrant['agama'] ?></td>
                                    <td><?= $registrant['alamat'] ?></td>
                                    <td><?= $registrant['no_telepon'] ?></td>
                                    <form action="./kelola_data" method="post">
                                        <td>
                                            <input type="hidden" name="id" value="<?= $registrant['id'] ?>">
                                            <select class="form-select form-select-sm" aria-label="Small select example" name="keterangan">
                                                <option disabled>Pilih Keterangan Peserta</option>
                                                <option value="Diterima" <?php if ($registrant['keterangan'] == 'Diterima') echo 'selected' ?>>Diterima</option>
                                                <option value="Tidak Diterima" <?php if ($registrant['keterangan'] == 'Tidak Diterima') echo 'selected' ?>>Tidak Diterima</option>
                                                <option value="Sedang Diproses" <?php if ($registrant['keterangan'] == 'Sedang Diproses') echo 'selected' ?>>Sedang Diproses</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a href="./detail_pendaftar" class="btn btn-primary btn-sm">Detail</a>
                                            <a href="" class="btn btn-danger btn-sm">Hapus</a>
                                            <button type="submit" class="btn btn-primary btn-sm mt-2">Perbarui</button>
                                        </td>
                                    </form>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>

                <!-- Content Row -->


                <!-- /.container-fluid -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yakin untuk keluar?</h5>
                        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Pilih "Keluar" di bawah ini jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                        <a class="btn btn-primary" href="../auth/logout">Keluar</a>
                    </div>
                </div>
            </div>
        </div>