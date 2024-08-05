<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIPPEKA | Pendaftaran</title>

    <!-- Custom fonts for this template-->
    <link href="assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/admin/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body.bg_register {
            background-color: #f6f9ff;
        }
    </style>

</head>

<body class="bg_register">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-md-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Registrasi Peserta Pelatihan Pekerja</h1>
                                    </div>
                                    <form class="user" action="/pendaftaran/proses" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap Anda...">
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir Anda...">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" placeholder="Tanggal Lahir Anda...">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                                <div class="form-check">
                                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" class="form-check-input" id="laki">
                                                    <label for="laki" class="form-check-label">Laki-Laki</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="jenis_kelamin" value="Perempuan" class="form-check-input" id="perempuan">
                                                    <label for="perempuan" class="form-check-label">Perempuan</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="agama">Agama</label>
                                                <select name="agama" id="agama" class="form-control">
                                                    <option value="">Pilih Agama</option>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Kristen">Kristen</option>
                                                    <option value="Katolik">Katolik</option>
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Buddha">Buddha</option>
                                                    <option value="Konghucu">Konghucu</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea name="alamat" id="alamat" class="form-control"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="telepon">Telepon</label>
                                            <input type="text" name="telepon" class="form-control" id="telepon" placeholder="No Telepon Anda...">
                                        </div>

                                        <div class="form-group">
                                            <label for="keahlian">Keahlian</label>
                                            <select name="keahlian" id="keahlian" class="form-control">
                                                <option value="Pilih Keahlian">Pilih Keahlian</option>
                                                <?php foreach ($keahlianList as $item) : ?>
                                                    <option value="<?= $item['nama'] ?>"><?= $item['nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="">Foto KTP</label>
                                                <input style="padding:3px" type="file" name="foto_ktp" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Foto Ijazah</label>
                                                <input style="padding:3px" type="file" name="foto_ijazah" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="">Foto Background Biru (3x4)</label>
                                                <input style="padding:3px" type="file" name="foto_bg_biru" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Foto Kartu Keluarga</label>
                                                <input style="padding:3px" type="file" name="foto_kk" class="form-control">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block mt-5">Daftar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/admin/vendor/jquery/jquery.min.js"></script>
    <script src="assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/admin/js/sb-admin-2.min.js"></script>

</body>

</html>