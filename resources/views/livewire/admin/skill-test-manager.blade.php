<div>
    <div id="wrapper">
        @include('livewire.admin.partials.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('livewire.admin.partials.topbar')
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manajemen Tes Keahlian</h1>
                        <button wire:click="openModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50 mr-2"></i> Buat Tes Baru
                        </button>
                    </div>

                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Konfigurasi Tes Kompetensi</h6>
                            <input wire:model.live.debounce.300ms="search" type="text"
                                class="form-control form-control-sm w-25" placeholder="Cari nama tes...">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-dark text-center">
                                        <tr>
                                            <th>Nama Tes</th>
                                            <th>Kategori & Skill</th>
                                            <th>Durasi</th>
                                            <th>Pengaturan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($tests as $test)
                                            <tr class="text-center">
                                                <td class="text-left font-weight-bold text-primary">
                                                    {{ $test->nama_tes }}
                                                    <div class="small text-gray-500 font-weight-normal">ID:
                                                        #{{ str_pad($test->id, 5, '0', STR_PAD_LEFT) }}</div>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-indigo border border-indigo-100 text-indigo-700 bg-indigo-50">{{ $test->category->nama ?? '-' }}</span>
                                                    <div class="small text-gray-400 font-italic mt-1">
                                                        {{ $test->skill->nama ?? '-' }}</div>
                                                </td>
                                                <td>
                                                    <span class="font-weight-bold">{{ $test->durasi_menit }}</span>
                                                    <small class="text-gray-500 font-weight-bold">MENIT</small>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-1">
                                                        <span
                                                            class="badge {{ $test->acak_soal === 'y' ? 'badge-success' : 'badge-light' }} text-xs"
                                                            title="Acak Soal">Soal</span>
                                                        <span
                                                            class="badge {{ $test->acak_jawaban === 'y' ? 'badge-info' : 'badge-light' }} text-xs"
                                                            title="Acak Jawaban">Opsi</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.question_manager', $test->id) }}"
                                                            class="btn btn-primary btn-sm btn-circle shadow-sm"
                                                            title="Kelola Soal">
                                                            <i class="fas fa-list-ul"></i>
                                                        </a>
                                                        <button wire:click="openModal({{ $test->id }})"
                                                            class="btn btn-warning btn-sm btn-circle shadow-sm"
                                                            title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button
                                                            onclick="confirm('Hapus tes ini?') || event.stopImmediatePropagation()"
                                                            wire:click="delete({{ $test->id }})"
                                                            class="btn btn-danger btn-sm btn-circle shadow-sm"
                                                            title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-5 text-gray-400 font-italic">
                                                    Belum ada tes keahlian yang dikonfigurasi.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $tests->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Livewire Modal (SB Admin 2 Style) -->
    @if ($showingModal)
        <div class="fixed-top w-100 h-100 d-flex align-items-center justify-content-center"
            style="background: rgba(0,0,0,0.5); z-index: 1050;">
            <div class="card shadow mb-4 animate-fade-in" style="width: 650px;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        {{ $editingId ? 'Edit Konfigurasi Tes' : 'Buat Tes Baru' }}</h6>
                    <button wire:click="closeModal" class="btn btn-sm btn-link text-gray-400"><i
                            class="fas fa-times"></i></button>
                </div>
                <div class="card-body">
                    <form wire:submit="save">
                        <div class="form-group">
                            <label class="font-weight-bold small text-uppercase">Nama Tes Keahlian</label>
                            <input wire:model="nama_tes" type="text"
                                class="form-control @error('nama_tes') is-invalid @enderror"
                                placeholder="Contoh: Tes Kompetensi Welding">
                            @error('nama_tes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold small text-uppercase">Mata Soal (Kategori)</label>
                                <select wire:model="mata_soal"
                                    class="form-control @error('mata_soal') is-invalid @enderror">
                                    <option value="">-- Pilih Mata Soal --</option>
                                    @foreach ($categories_list as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                                    @endforeach
                                </select>
                                @error('mata_soal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold small text-uppercase">Program Keahlian (Skill)</label>
                                <select wire:model="keahlian"
                                    class="form-control @error('keahlian') is-invalid @enderror">
                                    <option value="">-- Pilih Skill --</option>
                                    @foreach ($skills_list as $sk)
                                        <option value="{{ $sk->id }}">{{ $sk->nama }}</option>
                                    @endforeach
                                </select>
                                @error('keahlian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold small text-uppercase">Durasi (Menit)</label>
                                <input wire:model="durasi_menit" type="number"
                                    class="form-control @error('durasi_menit') is-invalid @enderror">
                                @error('durasi_menit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold small text-uppercase d-block">Lainnya</label>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" wire:model="acak_soal" value="y" true-value="y"
                                        false-value="t" class="custom-control-input" id="acakSoal">
                                    <label class="custom-control-label font-weight-bold text-gray-600"
                                        for="acakSoal">Acak Soal</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" wire:model="acak_jawaban" value="y" true-value="y"
                                        false-value="t" class="custom-control-input" id="acakOpsi">
                                    <label class="custom-control-label font-weight-bold text-gray-600"
                                        for="acakOpsi">Acak Opsi</label>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="text-right">
                            <button type="button" wire:click="closeModal"
                                class="btn btn-secondary btn-sm px-4">Batal</button>
                            <button type="submit" class="btn btn-primary btn-sm px-4 shadow-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
