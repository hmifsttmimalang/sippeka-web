@extends('layouts.pendaftaran_app')

@section('title', 'Registrasi | Sippeka')

@section('content')
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
                                <form class="user" action="{{ route('pendaftaran.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" class="form-control" id="nama"
                                            placeholder="Masukkan Nama Lengkap Anda..." required>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" class="form-control"
                                                id="tempat_lahir" placeholder="Tempat Lahir Anda..." required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                                class="form-control" min="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <div class="form-check">
                                                <input type="radio" name="jenis_kelamin" value="Laki-laki"
                                                    class="form-check-input" id="laki">
                                                <label for="laki" class="form-check-label">Laki-Laki</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" name="jenis_kelamin" value="Perempuan"
                                                    class="form-check-input" id="perempuan">
                                                <label for="perempuan" class="form-check-label">Perempuan</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="agama">Agama</label>
                                            <select name="agama" id="agama" class="form-control" required>
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
                                        <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="telepon">Telepon</label>
                                        <input type="text" name="telepon" class="form-control" id="telepon"
                                            placeholder="No Telepon Anda...">
                                    </div>
                                    <div class="form-group">
                                        <label for="keahlian">Keahlian</label>
                                        <select name="keahlian" class="form-control" id="keahlian">
                                            <option value="">Pilih Keahlian</option>
                                            @foreach($skills as $skill)
                                            <option value="{{ $skill->id }}">{{ $skill->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="">Foto KK atau KTP (*apabila ada)</label>
                                            <input style="padding:3px" type="file" name="foto_identitas"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Foto Ijazah</label>
                                            <input style="padding:3px" type="file" name="foto_ijazah"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="">Foto Background Biru (3x4)</label>
                                            <input style="padding:3px" type="file" name="foto_bg_biru"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary btn-user btn-block mt-5">Daftar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const tanggalLahirInput = document.getElementById('tanggal_lahir');

    tanggalLahirInput.addEventListener('input', () => {
        const inputValue = tanggalLahirInput.value;
        const inputDate = new Date(inputValue);
        const currentDate = new Date();

        if (isNaN(inputDate.getTime())) {
            alert('Tanggal lahir tidak valid');
            tanggalLahirInput.value = '';
        } else {
            const age = currentDate.getFullYear() - inputDate.getFullYear();
            const isWithinRange = age >= 15 && age <= 40;

            if (!isWithinRange) {
                if (age < 15) {
                    Swal.fire({
                        title: "Tidak dapat memilih tanggal lahir!",
                        text: "Anda harus berusia minimal 15 tahun untuk mendaftar.",
                        icon: "warning"
                    });
                } else if (age >= 40) {
                    Swal.fire({
                        title: "Tidak dapat memilih tanggal lahir!",
                        text: "Anda harus berusia maksimal 40 tahun untuk mendaftar.",
                        icon: "warning"
                    });
                }
            }
        }
    });
</script>
@endsection