<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIPPEKA Administrator - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="assets3/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets3/css/sb-admin-2.min.css" rel="stylesheet">

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
        selector: 'textarea#tiny'
        });
    </script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard_admin.php">
                <div class="sidebar-brand-text mx-3">Admin SIPPEKA</div>
            </a>

            <!-- Heading -->
            <div class="sidebar-heading">
              Admin
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard_admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item ">
                <a class="nav-link" href="kelola_data.php">
                  <i class="fas fa-fw fa-list"></i>
                  <span>Kelola Data Peserta</span>
              </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="peserta.php">
                  <i class="fas fa-fw fa-user"></i>
                  <span>Peserta</span>
              </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="info_user.php">
                  <i class="fas fa-fw fa-user"></i>
                  <span>Info User</span>
              </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item ">
                <a class="nav-link" href="kelola_data.php" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                  <i class="fas fa-fw fa-list"></i>
                  <span>Keahlian</span>
              </a>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="mata_soal_keahlian.php">Mata Soal Keahlian</a>
                    <a class="collapse-item" href="kelas_keahlian.php">Kelas Keahlian</a>
                    <a class="collapse-item active" href="tes_keahlian.php">Tes Keahlian</a>
                    <a class="collapse-item" href="sesi_tes_keahlian.php">Sesi Tes Keahlian</a>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="login.php" data-toggle="modal" data-target="#logoutModal">
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
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrator</span>
                                <img class="img-profile rounded-circle"
                                    src="assets3/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="login.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Button Kembali -->
                    <a href="tes_keahlian.php" class="btn btn-primary btn-sm mb-6">Kembali</a>

                    <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-5">
                                    <div class="">
                                        <h1 class="h4 text-gray-900 mb-4">Edit Soal Keahlian</h1>
                                    </div>
                                    <hr class="divider-sidebar">
                                    <form class="user">
                                        <div class="form-group">
                                            <label for="nama_soal">Nama Tes</label>
                                            <input type="text" name="nama_soal" class="form-control" id="nama_soal" placeholder="Masukkan Nama Mata Keahlian">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="mata_soal">Mata Soal</label>
                                                <select name="mata_soal" id="mata_soal" class="form-control">
                                                    <option value="">Pilih Mata Keahlian</option>
                                                    <option value="pemrograman_web">Pemrograman Web</option>
                                                    <option value="desain_web">Design Web</option>
                                                    <option value="desain_sistem">Desain Sistem</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="kelas">Kelas</label>
                                                <select name="mata_soal" id="mata_soal" class="form-control">
                                                    <option value="">Pilih Keahlian</option>
                                                    <option value="android_developer">Android Developer</option>
                                                    <option value="backend_developer">Backend Developer</option>
                                                    <option value="web_developer">Web Developer</option>
                                                    <option value="ui_ux_designer">UI UX Designer</option>
                                                    <option value="it_security">IT Security</option>
                                                </select>
                                            </div>
                                        </div>
                                            <div class="form-group">
                                                <label for="nama_soal">Nama Soal</label>
                                                <form action="" method="post">
                                                    <textarea id="tiny"></textarea>
                                                </form>
                                            </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="acak_soal">Acak Soal</label>
                                                <select name="acak_soal" id="acak_soal" class="form-control">
                                                    <option value="">Pilih</option>
                                                    <option value="y">Y</option>
                                                    <option value="t">T</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="acak_jawaban">Acak Jawaban</label>
                                                <select name="acak_jawaban" id="acak_jawaban" class="form-control">
                                                    <option value="">Pilih</option>
                                                    <option value="y">Y</option>
                                                    <option value="t">T</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="acak_soal">Acak Soal</label>
                                                <select name="acak_soal" id="acak_soal" class="form-control">
                                                    <option value="">Pilih</option>
                                                    <option value="y">Y</option>
                                                    <option value="t">T</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="durasi_menit">Durasi (Menit)</label>
                                                <input type="text" name="durasi_menit" class="form-control" id="durasi_menit" 
                                                placeholder="Masukkan Durasi Tes (Menit)">
                                            </div>
                                        </div>
                                        <a href="tes_keahlian.php" class="btn btn-primary">
                                            Simpan
                                        </a>
                                        <a href="" class="btn btn-primary">
                                            Reset
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah ini jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets3/vendor/jquery/jquery.min.js"></script>
    <script src="assets3/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets3/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets3/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets3/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets3/js/demo/chart-area-demo.js"></script>
    <script src="assets3/js/demo/chart-pie-demo.js"></script>

</body>

</html>