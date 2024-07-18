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
                <a class="nav-link" href="../admin/peserta">
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
                    <li class="breadcrumb-item active">Peserta</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <!-- Section-->
        <section class="section dashboard">
            <div class="row">

                <!-- Content CRUD -->
                <table border="1">
                    <tr>
                        <th>Nama</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                        <th>Keterangan</th>
                    </tr>
                    <?php foreach ($data['registrations'] as $registrant): ?>
                        <tr>
                            <td><?= $registrant['nama'] ?></td>
                            <td><?= $registrant['tempat_lahir'] ?></td>
                            <td><?= $registrant['tanggal_lahir'] ?></td>
                            <td><?= $registrant['jenis_kelamin'] ?></td>
                            <td><?= $registrant['agama'] ?></td>
                            <td><?= $registrant['alamat'] ?></td>
                            <td><?= $registrant['no_telepon'] ?></td>
                            <td><?= $registrant['keterangan'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>



            </div>
        </section>
        <!-- End Section -->

    </main>
    <!-- End #main -->