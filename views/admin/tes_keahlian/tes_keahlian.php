<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
                <div class="sidebar-brand-text mx-3">Admin SIPPEKA</div>
            </a>

            <!-- Heading -->
            <div class="sidebar-heading">
                Admin
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/admin">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="/admin/kelola_data">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Kelola Data Peserta</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admin/peserta">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Peserta</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admin/info_user">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Info User</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item ">
                <a class="nav-link" href="/admin/kelola_data" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Keahlian</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/admin/mata_soal_keahlian">Mata Soal Keahlian</a>
                        <a class="collapse-item" href="/admin/kelas_keahlian">Kelas Keahlian</a>
                        <a class="collapse-item active" href="/admin/tes_keahlian">Tes Keahlian</a>
                        <a class="collapse-item" href="/admin/sesi_tes_keahlian">Sesi Tes Keahlian</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="/logout" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Keluar</span>
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
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrator</span>
                                <img class="img-profile rounded-circle" src="../../../assets/admin/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout" data-toggle="modal" data-target="#logoutModal">
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
                    <h1 class="h3 mb-3 text-gray-800 ">Tes Keahlian</h1>

                    <!-- Button Add Data -->
                    <div class="d-flex justify-content-left">
                        <div></div>
                        <form action="" class="form-inline my-2 my-lg-0">
                            <a href="/admin/tes_keahlian/tambah_tes_keahlian" class="btn btn-primary btn-sm mr-sm-4 mb-4">Tambah</a>
                        </form>
                    </div>

                    <?php if (!empty($tesKeahlianList)) : ?>
                        <!-- Search Bar -->
                        <div class="d-flex justify-content-between">
                            <div></div>
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2 mb-4" type="search" placeholder="Search" aria-label="Search">
                            </form>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Nama Tes Keahlian</td>
                                            <td>Mata Keahlian</td>
                                            <td>Kelas Keahlian</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($tesKeahlianList as $item) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td>Tes - <?= $item['nama_tes'] ?></td>
                                                <td><?= $item['mata_soal_nama'] ?></td>
                                                <td><?= $item['keahlian_nama'] ?></td>
                                                <td>
                                                    <a href="/admin/tes_keahlian/detail_ujian/<?= $item['id'] ?>" class="btn btn-secondary btn-sm">View</a>
                                                    <a href="/admin/tes_keahlian/edit_tes_keahlian/<?= $item['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="/admin/tes_keahlian/hapus_tes_keahlian/<?= $item['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <nav aria-label="..." class="mr-3">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a class="page-link">Previous</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    <?php else : ?>
                        <h3 class="text-center mt-2">Tidak ada tes yang tersedia</h3>
                    <?php endif; ?>

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

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
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Keluar" di bawah ini jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="/logout">Keluar</a>
                </div>
            </div>
        </div>
    </div>