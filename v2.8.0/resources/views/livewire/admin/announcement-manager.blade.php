<div>
    <div id="wrapper">
        @include('livewire.admin.partials.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('livewire.admin.partials.topbar')
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Atur Pengumuman</h1>

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow mb-4 border-left-primary">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Pengaturan Waktu Pengumuman Kelulusan
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <p class="mb-4 text-gray-800">
                                        Waktu pengumuman saat ini: <br>
                                        <strong><i class="fas fa-clock mr-2"></i>{{ $formattedDate }}</strong>
                                    </p>

                                    <form wire:submit.prevent="save">
                                        <div class="form-group">
                                            <label>Set Tanggal Pengumuman</label>
                                            <input type="date" wire:model="tanggal"
                                                class="form-control @error('tanggal') is-invalid @enderror">
                                            @error('tanggal')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Set Waktu Pengumuman (HH:mm)</label>
                                            <input type="time" wire:model="waktu"
                                                class="form-control @error('waktu') is-invalid @enderror">
                                            @error('waktu')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-primary shadow-sm">
                                            <i class="fas fa-save fa-sm text-white-50 mr-2"></i>Simpan Pengaturan
                                        </button>
                                    </form>
                                </div>
                                <div class="card-footer py-2 text-xs text-gray-500">
                                    * Siswa hanya dapat melihat hasil seleksi setelah waktu yang ditentukan di atas.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card shadow mb-4 bg-light">
                                <div class="card-body">
                                    <h5 class="font-weight-bold">Informasi Penting</h5>
                                    <p>Pastikan semua data nilai peserta sudah masuk sebelum waktu pengumuman tiba.
                                        Pengumuman akan muncul secara otomatis di dashboard masing-masing peserta sesuai
                                        jadwal yang diatur.</p>
                                    <ul class="text-sm">
                                        <li>Cek Kelola Data Peserta untuk memastikan data sudah tervalidasi.</li>
                                        <li>Cek Evaluasi Peserta untuk input nilai wawancara.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
