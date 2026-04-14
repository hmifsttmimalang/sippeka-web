<div>
    <div id="wrapper">
        @include('livewire.admin.partials.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('livewire.admin.partials.topbar')
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Kelola Data Peserta</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Seluruh Pendaftar SIPPEKA</h6>
                            <div class="d-flex gap-2">
                                <select wire:model.live="filterSkill" class="form-control form-control-sm mr-2"
                                    style="width: 200px;">
                                    <option value="">Semua Program Keahlian</option>
                                    @foreach ($skills as $skill)
                                        <option value="{{ $skill->id }}">{{ $skill->nama }}</option>
                                    @endforeach
                                </select>
                                <input wire:model.live.debounce.300ms="search" type="text"
                                    class="form-control form-control-sm" placeholder="Cari nama/telepon..."
                                    style="width: 200px;">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr class="text-center">
                                            <th>Data Diri</th>
                                            <th>Telepon</th>
                                            <th>Program</th>
                                            <th>Skor</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($registrants as $registrant)
                                            <tr class="text-center">
                                                <td class="text-left font-weight-bold text-primary">
                                                    {{ $registrant->nama }}</td>
                                                <td>{{ $registrant->telepon }}</td>
                                                <td><span
                                                        class="badge badge-indigo text-indigo-700 bg-indigo-50 border border-indigo-100">{{ $registrant->skill->nama ?? '-' }}</span>
                                                </td>
                                                <td><span
                                                        class="font-weight-bold text-gray-800">{{ $registrant->average_score ?? '-' }}</span>
                                                </td>
                                                <td>
                                                    @php
                                                        $badgeClass = match ($registrant->status) {
                                                            'Lulus' => 'badge-success',
                                                            'Gagal' => 'badge-danger',
                                                            'Sedang Diproses' => 'badge-warning',
                                                            default => 'badge-secondary',
                                                        };
                                                    @endphp
                                                    <span
                                                        class="badge {{ $badgeClass }}">{{ $registrant->status }}</span>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button wire:click="showProfile({{ $registrant->id }})" class="btn btn-sm btn-info" title="Lihat Profil"><i
                                                                class="fas fa-user"></i></button>
                                                        <button class="btn btn-sm btn-danger"
                                                            onclick="confirm('Hapus pendaftar?') || event.stopImmediatePropagation()"
                                                            wire:click="delete({{ $registrant->id }})" title="Hapus"><i
                                                                class="fas fa-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-5 text-gray-500 font-italic">
                                                    Tidak ditemukan data pendaftar.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $registrants->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Review Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold">Review Data Pendaftar</h5>
                    <button type="button" class="close text-white" aria-label="Close" wire:click="closeProfileModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    @if($selectedRegistrant)
                    <div class="row">
                        <!-- Data Diri & Nilai Sidebar -->
                        <div class="col-lg-4 mb-4">
                            <div class="card shadow-sm border-0 mb-4 h-100">
                                <div class="card-body text-center">
                                    @if($selectedRegistrant->foto_bg_biru)
                                        <img src="{{ asset('storage/' . $selectedRegistrant->foto_bg_biru) }}" alt="Foto Background Biru" class="img-thumbnail rounded mb-3" style="width: 150px; height: 200px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary rounded mx-auto mb-3 d-flex align-items-center justify-content-center text-white" style="width: 150px; height: 200px;">
                                            <i class="fas fa-user fa-4x"></i>
                                        </div>
                                    @endif
                                    <h5 class="font-weight-bold text-gray-900 mb-1">{{ strtoupper($selectedRegistrant->nama) }}</h5>
                                    <p class="text-primary mb-3">{{ $selectedRegistrant->skill->nama ?? 'Belum memilih' }}</p>
                                    
                                    <div class="text-left mt-4">
                                        <p class="mb-2"><i class="fas fa-map-marker-alt fa-fw text-gray-500 mr-2"></i>{{ $selectedRegistrant->tempat_lahir }}, {{ $selectedRegistrant->formatted_birth_date }}</p>
                                        <p class="mb-2"><i class="fas fa-venus-mars fa-fw text-gray-500 mr-2"></i>{{ $selectedRegistrant->jenis_kelamin }}</p>
                                        <p class="mb-2"><i class="fas fa-praying-hands fa-fw text-gray-500 mr-2"></i>{{ $selectedRegistrant->agama }}</p>
                                        <p class="mb-2"><i class="fas fa-home fa-fw text-gray-500 mr-2"></i>{{ $selectedRegistrant->alamat }}</p>
                                        <p class="mb-2"><i class="fas fa-envelope fa-fw text-gray-500 mr-2"></i>{{ $selectedRegistrant->user->email ?? '-' }}</p>
                                        <p class="mb-0"><i class="fas fa-phone fa-fw text-gray-500 mr-2"></i>{{ $selectedRegistrant->telepon }}</p>
                                    </div>
                                    
                                    <hr class="my-4">
                                    
                                    <div class="text-left">
                                        <h6 class="font-weight-bold text-gray-800 mb-3"><i class="fas fa-star text-warning mr-2"></i>Rekap Nilai</h6>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-gray-600">Tes Keahlian</span>
                                            <span class="font-weight-bold">{{ $selectedRegistrant->nilai_keahlian ?? '-' }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-gray-600">Rata-rata</span>
                                            <span class="font-weight-bold">{{ $selectedRegistrant->average_score ?? '-' }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-gray-600">Status</span>
                                            <span class="badge {{ match($selectedRegistrant->status) { 'Lulus' => 'badge-success', 'Gagal' => 'badge-danger', 'Sedang Diproses' => 'badge-warning', default => 'badge-secondary'} }}">
                                                {{ $selectedRegistrant->status }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lampiran & Review Panel -->
                        <div class="col-lg-8">
                            <div class="card shadow-sm border-0 mb-4 h-100">
                                <div class="card-header bg-white py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Lampiran Identitas</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-4 text-center">
                                            <p class="font-weight-bold text-gray-800 mb-2">KTP / Kartu Keluarga</p>
                                            @if($selectedRegistrant->foto_identitas)
                                            <img src="{{ asset('storage/' . $selectedRegistrant->foto_identitas) }}" alt="Foto Identitas" class="img-fluid rounded border p-1" style="max-height: 250px; object-fit: contain;">
                                            @else
                                            <div class="bg-light border rounded d-flex align-items-center justify-content-center p-5 text-gray-500">
                                                Belum diunggah
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-4 text-center">
                                            <p class="font-weight-bold text-gray-800 mb-2">Ijazah Terakhir</p>
                                            @if($selectedRegistrant->foto_ijazah)
                                            <img src="{{ asset('storage/' . $selectedRegistrant->foto_ijazah) }}" alt="Foto Ijazah" class="img-fluid rounded border p-1" style="max-height: 250px; object-fit: contain;">
                                            @else
                                            <div class="bg-light border rounded d-flex align-items-center justify-content-center p-5 text-gray-500">
                                                Belum diunggah
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    
                                    <h6 class="font-weight-bold text-gray-800 mb-3"><i class="fas fa-clipboard-check text-success mr-2"></i>Status Verifikasi Berkas</h6>
                                    
                                    <div class="mb-4 p-3 border rounded {{ $selectedRegistrant->verification_status == 'Approved' ? 'bg-success-light border-success' : ($selectedRegistrant->verification_status == 'Rejected' ? 'bg-danger-light border-danger' : 'bg-warning-light border-warning') }}">
                                        <div class="row align-items-center">
                                            <div class="col-md-4">
                                                <span class="font-weight-bold">Status: </span>
                                                <span class="badge {{ $selectedRegistrant->verification_status == 'Approved' ? 'badge-success' : ($selectedRegistrant->verification_status == 'Rejected' ? 'badge-danger' : 'badge-warning') }} p-2">
                                                    {{ $selectedRegistrant->verification_status }}
                                                </span>
                                            </div>
                                            <div class="col-md-8 text-right">
                                                @if($selectedRegistrant->verification_status !== 'Approved')
                                                    <button type="button" class="btn btn-sm btn-success mr-2" wire:click="terimaBerkas"><i class="fas fa-check mr-1"></i> Terima Berkas</button>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        @if($selectedRegistrant->verification_status !== 'Approved')
                                        <div class="mt-3 pt-3 border-top">
                                            <label class="small font-weight-bold text-danger">Bila menolak, masukkan alasan:</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" wire:model.defer="verification_notes" placeholder="Tulis alasan penolakan berkas...">
                                                <div class="input-group-append">
                                                    <button class="btn btn-danger" type="button" wire:click="tolakBerkas"><i class="fas fa-times mr-1"></i> Tolak Berkas</button>
                                                </div>
                                            </div>
                                            @error('verification_notes') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                        </div>
                                        @endif
                                        @if($selectedRegistrant->verification_status == 'Rejected')
                                        <div class="mt-2 text-danger small">
                                            <strong>Catatan Penolakan Terakhir:</strong> {{ $selectedRegistrant->verification_notes }}
                                        </div>
                                        @endif
                                    </div>
                                    
                                    @if($selectedRegistrant->verification_status == 'Approved')
                                    <h6 class="font-weight-bold text-gray-800 mb-3 mt-4"><i class="fas fa-star text-warning mr-2"></i>Input Nilai Wawancara</h6>
                                    <form wire:submit.prevent="saveReview">
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-gray-800 font-weight-bold">Nilai Wawancara (0-100)</label>
                                            <div class="col-sm-4">
                                                <input type="number" step="0.01" min="0" max="100" class="form-control" wire:model="nilai_wawancara" placeholder="0 - 100">
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save mr-2"></i>Simpan</button>
                                            </div>
                                            @error('nilai_wawancara') <div class="col-12 mt-1 text-danger small">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="alert alert-info border-left-info mt-3 mb-0 small">
                                            <i class="fas fa-info-circle mr-1"></i> Mengisi nilai wawancara akan otomatis memproses Kelulusan peserta (Lulus >= 70 rata-rata nilai).
                                        </div>
                                    </form>
                                    @else
                                    <div class="alert alert-secondary small text-center mt-3"><i class="fas fa-lock mr-2"></i>Verifikasi berkas harus 'Approved' sebelum memasukkan nilai wawancara.</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-3 text-gray-600">Memuat data pendaftar...</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @script
    <script>
        $wire.on('show-profile-modal', () => {
            $('#profileModal').modal('show');
        });
        $wire.on('hide-profile-modal', () => {
            $('#profileModal').modal('hide');
        });
    </script>
    @endscript

</div>
