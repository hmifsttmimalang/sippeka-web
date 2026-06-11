<div class="container pb-5">
    <!-- Stepper Header -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-10">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" 
                             style="width: {{ (($currentStep) / ($totalSteps)) * 100 }}%" 
                             aria-valuenow="{{ $currentStep }}" aria-valuemin="1" aria-valuemax="{{ $totalSteps }}"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2 small font-weight-bold text-uppercase tracking-wider">
                        <span class="{{ $currentStep >= 1 ? 'text-primary' : 'text-muted' }}">1. Profil</span>
                        <span class="{{ $currentStep >= 2 ? 'text-primary' : 'text-muted' }}">2. Program</span>
                        <span class="{{ $currentStep >= 3 ? 'text-primary' : 'text-muted' }}">3. Berkas</span>
                        <span class="{{ $currentStep >= 4 ? 'text-primary' : 'text-muted' }}">4. Review</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Wizard Content -->
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0">
                <div class="card-body p-4 p-md-5">
                    
                    @if($currentStep === 1)
                        <!-- Step 1: Personal Information -->
                        <div class="animate-fade-in">
                            <h4 class="font-weight-bold text-gray-800 mb-4 text-uppercase">Lengkapi Profil Anda</h4>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Nama Lengkap</label>
                                    <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama Lengkap Anda...">
                                    @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Tempat Lahir</label>
                                    <input wire:model="place_of_birth" type="text" class="form-control @error('place_of_birth') is-invalid @enderror" placeholder="Tempat Lahir Anda...">
                                    @error('place_of_birth') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Tanggal Lahir</label>
                                    <input wire:model="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror">
                                    @error('date_of_birth') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Jenis Kelamin</label>
                                    <div class="mt-2 text-gray-700">
                                        <div class="form-check form-check-inline">
                                            <input wire:model="gender" class="form-check-input" type="radio" name="jk" id="laki" value="Male">
                                            <label class="form-check-label" for="laki">Laki-laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input wire:model="gender" class="form-check-input" type="radio" name="jk" id="perempuan" value="Female">
                                            <label class="form-check-label" for="perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                    @error('gender') <span class="text-danger small d-block mt-1 font-weight-bold">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Agama</label>
                                    <select wire:model="religion" class="form-control @error('religion') is-invalid @enderror">
                                        <option value="">Pilih Agama</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                    @error('religion') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Alamat Tinggal Sekarang</label>
                                    <textarea wire:model="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="Alamat Lengkap..."></textarea>
                                    @error('address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Nomor Telepon (WhatsApp)</label>
                                    <input wire:model="phone" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="08xxxxxx">
                                    @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                    @elseif($currentStep === 2)
                        <!-- Step 2: Skill Selection -->
                        <div class="animate-fade-in">
                            <h4 class="font-weight-bold text-gray-800 mb-4 text-uppercase">Pilih Program Keahlian</h4>
                            <div class="row">
                                @foreach($skills as $skill)
                                    <div class="col-md-6 mb-3">
                                        <div class="card h-100 border-{{ $skill_id == $skill->id ? 'primary shadow-sm' : 'light' }} cursor-pointer" 
                                             wire:click="$set('skill_id', {{ $skill->id }})" 
                                             style="cursor: pointer;">
                                            <div class="card-body d-flex align-items-center">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" checked="{{ $skill_id == $skill->id }}">
                                                    <label class="custom-control-label font-weight-bold text-gray-900">{{ $skill->name }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('skill_id') <span class="text-danger small font-weight-bold d-block mt-2 ml-1">{{ $message }}</span> @enderror
                        </div>

                    @elseif($currentStep === 3)
                        <!-- Step 3: Document Uploads -->
                        <div class="animate-fade-in">
                            <h4 class="font-weight-bold text-gray-800 mb-4 text-uppercase">Unggah Berkas Persyaratan</h4>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="font-weight-bold small text-muted text-uppercase mb-2 d-block">Foto KTP / Kartu Keluarga</label>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" wire:model="identity_document">
                                        <label class="custom-file-label">{{ $identity_document ? 'Berkas Terpilih' : 'Pilih Berkas PDF/JPG' }}</label>
                                    </div>
                                    @if($identity_document) <span class="text-success small font-weight-bold"><i class="bi bi-check-lg me-1"></i>Siap diunggah</span> @endif
                                    @error('identity_document') <span class="text-danger small d-block font-weight-bold">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="font-weight-bold small text-muted text-uppercase mb-2 d-block">Ijazah Terakhir</label>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" wire:model="certificate_document">
                                        <label class="custom-file-label">{{ $certificate_document ? 'Berkas Terpilih' : 'Pilih Berkas PDF/JPG' }}</label>
                                    </div>
                                    @if($certificate_document) <span class="text-success small font-weight-bold"><i class="bi bi-check-lg me-1"></i>Siap diunggah</span> @endif
                                    @error('certificate_document') <span class="text-danger small d-block font-weight-bold">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-12 mb-4">
                                    <label class="font-weight-bold small text-muted text-uppercase mb-2 d-block">Pas Foto (Background Biru 3x4)</label>
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            @if($formal_photo)
                                                <img src="{{ $formal_photo->temporaryUrl() }}" class="img-thumbnail" style="width: 100px; height: 130px; object-cover;">
                                            @else
                                                <div class="bg-light border rounded d-flex align-items-center justify-content-center" style="width: 100px; height: 130px;">
                                                    <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" wire:model="formal_photo">
                                                <label class="custom-file-label">Pilih Foto (JPG/PNG)</label>
                                            </div>
                                            <p class="text-muted small mt-2">* Gunakan pas foto formal dengan latar belakang biru sesuai ketentuan.</p>
                                        </div>
                                    </div>
                                    @error('formal_photo') <span class="text-danger small d-block font-weight-bold mt-2">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                    @elseif($currentStep === 4)
                        <!-- Step 4: Review & Submit -->
                        <div class="animate-fade-in">
                            <h4 class="font-weight-bold text-gray-800 mb-4 text-uppercase text-center text-primary">Konfirmasi Pendaftaran</h4>
                            <div class="alert alert-info py-3 small">
                                <i class="bi bi-info-circle-fill me-2"></i>
                                Pastikan seluruh data di bawah ini benar sebelum menekan tombol <strong>Kirim Pendaftaran</strong>.
                                Data yang sudah dikirim tidak dapat diubah sendiri oleh peserta.
                            </div>

                            <div class="card bg-light border-0 mt-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-7 border-right">
                                            <h6 class="font-weight-bold text-primary mb-3 text-uppercase">Data Personal</h6>
                                            <table class="table table-sm table-borderless small mb-0">
                                                <tr><td class="text-muted" width="120">Nama:</td><td class="font-weight-bold">{{ $name }}</td></tr>
                                                <tr><td class="text-muted">TTL:</td><td class="font-weight-bold">{{ $place_of_birth }}, {{ date('d-m-Y', strtotime($date_of_birth)) }}</td></tr>
                                                <tr><td class="text-muted">Gender:</td><td class="font-weight-bold">{{ $gender }}</td></tr>
                                                <tr><td class="text-muted">Phone/WA:</td><td class="font-weight-bold">{{ $phone }}</td></tr>
                                                <tr><td class="text-muted">Alamat:</td><td class="font-weight-bold">{{ $address }}</td></tr>
                                            </table>
                                        </div>
                                        <div class="col-md-5 mt-3 mt-md-0">
                                            <h6 class="font-weight-bold text-primary mb-3 text-uppercase">Program & Berkas</h6>
                                            <p class="small mb-1 text-muted">Program Pilihan:</p>
                                            <h6 class="font-weight-bold text-gray-900 mb-3">{{ $skills->firstWhere('id', $skill_id)->name ?? '-' }}</h6>
                                            
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="bi bi-file-earmark-check-fill text-success me-2"></i>
                                                <span class="small font-weight-bold">Berkas Identitas (OK)</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-file-earmark-check-fill text-success me-2"></i>
                                                <span class="small font-weight-bold">Berkas Ijazah (OK)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <hr class="my-5">

                    <!-- Navigation Buttons -->
                    <div class="d-flex justify-content-between align-items-center">
                        @if($currentStep > 1)
                            <button type="button" wire:click="previousStep" class="btn btn-outline-secondary px-4 py-2 font-weight-bold shadow-sm">
                                <i class="bi bi-arrow-left me-2"></i>Sebelumnya
                            </button>
                        @else
                            <div></div>
                        @endif

                        @if($currentStep < $totalSteps)
                            <button type="button" wire:click="nextStep" class="btn btn-primary px-5 py-2 font-weight-bold shadow">
                                Lanjutkan<i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        @else
                            <button type="button" wire:click="submit" wire:loading.attr="disabled" class="btn btn-success px-5 py-2 font-weight-bold shadow shadow-success">
                                <span wire:loading.remove>Kirim Pendaftaran</span>
                                <span wire:loading><i class="bi bi-hourglass-split me-2 animate-spin"></i>Memproses...</span>
                            </button>
                        @endif
                    </div>

                </div>
            </div>
            
            <p class="mt-4 text-center small text-muted font-italic">
                &copy; {{ date('Y') }} SIPPEKA BALAI UPT SINGOSARI - Proses Pendaftaran Peserta Online
            </p>
        </div>
    </div>
</div>
