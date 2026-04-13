<div>
    <div id="wrapper">
        @include('livewire.admin.partials.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('livewire.admin.partials.topbar')
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Sesi Tes Keahlian</h1>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Sesi Tes Keahlian</h6>
                            <div class="d-flex gap-2">
                                <input wire:model.live.debounce.300ms="search" type="text"
                                    class="form-control form-control-sm" placeholder="Cari Sesi Tes..."
                                    style="width: 200px;">
                                <button class="btn btn-sm btn-primary ml-2" wire:click="openModal">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Tes Keahlian</th>
                                            <th>Sesi</th>
                                            <th>Mulai</th>
                                            <th>Selesai</th>
                                            <th>Jenis Sesi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($sessions as $index => $item)
                                            <tr class="text-center align-middle">
                                                <td>{{ $sessions->firstItem() + $index }}</td>
                                                <td class="text-left font-weight-bold text-primary">
                                                    {{ $item->skillTest->nama_tes ?? 'N/A' }}
                                                </td>
                                                <td>{{ $item->nama_sesi }}</td>
                                                <td>{{ $item->waktu_mulai }}</td>
                                                <td>{{ $item->waktu_selesai }}</td>
                                                <td>{{ $item->jenis_sesi }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-secondary" title="Detail Peserta"
                                                            wire:click="showDetail({{ $item->id }})"><i class="fas fa-eye"></i></button>
                                                        <button class="btn btn-sm btn-primary" title="Edit Data"
                                                            wire:click="openModal({{ $item->id }})"><i class="fas fa-pencil-alt"></i></button>
                                                        <button class="btn btn-sm btn-danger" title="Hapus"
                                                            onclick="confirm('Hapus sesi ini?') || event.stopImmediatePropagation()"
                                                            wire:click="delete({{ $item->id }})"><i class="fas fa-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-5 text-gray-500 font-italic">
                                                    Tidak ada Sesi Tes yang ditemukan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $sessions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form Tambah/Edit -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="save">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">{{ $editingId ? 'Edit Sesi Tes' : 'Tambah Sesi Tes' }}</h5>
                        <button type="button" class="close text-white" aria-label="Close" wire:click="closeModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Tes Keahlian <span class="text-danger">*</span></label>
                            <select wire:model="skill_test_id" class="form-control @error('skill_test_id') is-invalid @enderror">
                                <option value="">-- Pilih Tes Keahlian --</option>
                                @foreach($skillTests as $test)
                                    <option value="{{ $test->id }}">{{ $test->nama_tes }}</option>
                                @endforeach
                            </select>
                            @error('skill_test_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold">Nama Sesi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_sesi') is-invalid @enderror" wire:model="nama_sesi" placeholder="Contoh: Gelombang 1">
                            @error('nama_sesi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Waktu Mulai <span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control @error('waktu_mulai') is-invalid @enderror" wire:model="waktu_mulai">
                                    @error('waktu_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Waktu Selesai <span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control @error('waktu_selesai') is-invalid @enderror" wire:model="waktu_selesai">
                                    @error('waktu_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Jenis Sesi <span class="text-danger">*</span></label>
                            <select wire:model="jenis_sesi" class="form-control @error('jenis_sesi') is-invalid @enderror">
                                <option value="Seleksi">Seleksi</option>
                                <option value="Simulasi">Simulasi</option>
                            </select>
                            @error('jenis_sesi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title font-weight-bold">Detail Peserta Ujian</h5>
                    <button type="button" class="close text-white" aria-label="Close" wire:click="closeDetail">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    @if($selectedSession)
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td width="30%" class="font-weight-bold">Tes Keahlian</td>
                                        <td>: {{ $selectedSession->skillTest->nama_tes ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Sesi</td>
                                        <td>: {{ $selectedSession->nama_sesi }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td width="30%" class="font-weight-bold">Waktu Mulai</td>
                                        <td>: {{ $selectedSession->waktu_mulai }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Waktu Selesai</td>
                                        <td>: {{ $selectedSession->waktu_selesai }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="card shadow-sm">
                            <div class="card-header py-3 bg-white d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Peserta Mengikuti Ujian</h6>
                                <div class="d-flex gap-2">
                                    <input wire:model.live.debounce.300ms="detailSearch" type="text"
                                        class="form-control form-control-sm" placeholder="Cari Nama..."
                                        style="width: 200px;">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="thead-light text-center">
                                            <tr>
                                                <th>Nama Peserta</th>
                                                <th>Keahlian</th>
                                                <th>Mulai Tes</th>
                                                <th>Selesai Tes</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($detailAttempts as $attempt)
                                                <tr class="align-middle text-center">
                                                    <td class="text-left font-weight-bold">{{ $attempt->registration->nama ?? '-' }}</td>
                                                    <td>{{ $attempt->registration->skill->nama ?? '-' }}</td>
                                                    <td>{{ $attempt->waktu_mulai }}</td>
                                                    <td>{{ $attempt->waktu_selesai }}</td>
                                                    <td>
                                                        <span class="badge {{ $attempt->status == 'Selesai' ? 'badge-success' : 'badge-warning' }}">
                                                            {{ $attempt->status }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-4 text-muted">Belum ada peserta yang mengikuti sesi ini.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @script
    <script>
        $wire.on('show-form-modal', () => {
            $('#formModal').modal('show');
        });
        $wire.on('hide-form-modal', () => {
            $('#formModal').modal('hide');
            $('.modal-backdrop').remove(); // Extra cleanup for Bootstrap 4
            $('body').removeClass('modal-open');
        });
        $wire.on('show-detail-modal', () => {
            $('#detailModal').modal('show');
        });
        $wire.on('hide-detail-modal', () => {
            $('#detailModal').modal('hide');
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
        });
    </script>
    @endscript
</div>
