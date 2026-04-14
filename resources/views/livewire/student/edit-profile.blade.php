<div>
    @include('livewire.student.partials.header')
    @include('livewire.student.partials.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Profil</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Edit Profil</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                            <h5 class="card-title mb-0 font-weight-bold text-primary">Informasi Akun</h5>
                        </div>
                        <div class="card-body pt-3">
                            <form wire:submit.prevent="updateProfile">
                                <!-- Info Terkunci -->
                                <div class="alert alert-info border-0 shadow-sm small py-2">
                                    <i class="bi bi-info-circle me-1"></i> Data dokumen (foto, identitas, ijazah) dikunci untuk menjamin validitas verifikasi.
                                </div>

                                <div class="row mb-3">
                                    <label for="nama" class="col-md-4 col-form-label text-md-end text-muted">Nama Lengkap</label>
                                    <div class="col-md-7">
                                        <input wire:model="nama" id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" required>
                                        @error('nama')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end text-muted">Email</label>
                                    <div class="col-md-7">
                                        <input wire:model="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <hr class="my-4">
                                <h6 class="font-weight-bold text-muted mb-3"><i class="bi bi-shield-lock me-2"></i>Ganti Password (Opsional)</h6>
                                <p class="text-xs text-muted mb-3">Biarkan kosong jika Anda tidak ingin merubah password.</p>

                                <div class="row mb-3 relative">
                                    <label for="password" class="col-md-4 col-form-label text-md-end text-muted">Password Baru</label>
                                    <div class="col-md-7" x-data="{ show: false }">
                                        <div class="input-group">
                                            <input wire:model="password" id="password" :type="show ? 'text' : 'password'" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter">
                                            <button type="button" class="btn btn-outline-secondary" @click="show = !show">
                                                <i class="bi" :class="show ? 'bi-eye-slash' : 'bi-eye'"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-muted">Ulangi Password</label>
                                    <div class="col-md-7">
                                        <input wire:model="password_confirmation" id="password_confirmation" type="password" class="form-control" placeholder="Konfirmasi password baru">
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-7 offset-md-4">
                                        <button type="submit" class="btn btn-primary px-4 shadow-sm" wire:loading.attr="disabled">
                                            <span wire:loading.remove wire:target="updateProfile"><i class="bi bi-save me-1"></i> Simpan Perubahan</span>
                                            <span wire:loading wire:target="updateProfile">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
