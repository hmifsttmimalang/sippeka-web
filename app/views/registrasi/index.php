
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
                                        <h1 class="h4 text-gray-900 mb-4">Registrasi Peserta Pelatihan Pekerja!</h1>
                                    </div>
                                    <form class="user">
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
                                                    <input type="radio" name="jenis_kelamin" value="L" class="form-check-input" id="laki">
                                                    <label for="laki" class="form-check-label">Laki-Laki</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="jenis_kelamin" value="P" class="form-check-input" id="perempuan">
                                                    <label for="perempuan" class="form-check-label">Perempuan</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="agama">Agama</label>
                                                <select name="agama" id="agama" class="form-control">
                                                    <option value="">Pilih Agama</option>
                                                    <option value="islam">Islam</option>
                                                    <option value="kristen">Kristen</option>
                                                    <option value="katholik">Katholik</option>
                                                    <option value="hindu">Hindu</option>
                                                    <option value="budha">Budha</option>
                                                    <option value="konghucu">Konghucu</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea name="alamat" id="alamat" class="form-control"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Registrasi
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>