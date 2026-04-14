<div>
    <div id="wrapper">
        @include('livewire.admin.partials.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('livewire.admin.partials.topbar')
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Kelas Keahlian</h1>
                        <button wire:click="openModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50 mr-2"></i> Tambah Kelas Keahlian
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
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Kelas Keahlian</h6>
                            <input wire:model.live.debounce.300ms="search" type="text"
                                class="form-control form-control-sm w-25" placeholder="Cari kelas keahlian...">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                    <thead class="thead-dark text-center">
                                        <tr>
                                            <th width="60">No</th>
                                            <th>Nama Kelas Keahlian</th>
                                            <th width="150">Jumlah Pendaftar</th>
                                            <th width="150">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($skills as $index => $skill)
                                            <tr class="text-center">
                                                <td>{{ $skills->firstItem() + $index }}</td>
                                                <td class="text-left font-weight-bold">{{ $skill->nama }}</td>
                                                <td>
                                                    <span class="badge badge-primary badge-counter p-2">
                                                        {{ $skill->registrations_count }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button wire:click="openModal({{ $skill->id }})"
                                                        class="btn btn-warning btn-sm btn-circle shadow-sm"
                                                        title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button
                                                        onclick="confirm('Yakin ingin menghapus kelas keahlian ini? Data pendaftar yang terkait mungkin terpengaruh.') || event.stopImmediatePropagation()"
                                                        wire:click="delete({{ $skill->id }})"
                                                        class="btn btn-danger btn-sm btn-circle shadow-sm"
                                                        title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-5 text-gray-400 font-italic">
                                                    Belum ada kelas keahlian yang terdaftar.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $skills->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    @if ($showingModal)
        <div class="fixed-top w-100 h-100 d-flex align-items-center justify-content-center"
            style="background: rgba(0,0,0,0.5); z-index: 1050;">
            <div class="card shadow mb-4" style="width: 500px;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        {{ $editingId ? 'Edit Kelas Keahlian' : 'Tambah Kelas Keahlian' }}
                    </h6>
                    <button wire:click="closeModal" class="btn btn-sm btn-link text-gray-400">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="card-body">
                    <form wire:submit="save">
                        <div class="form-group">
                            <label class="font-weight-bold small text-uppercase">Nama Kelas Keahlian</label>
                            <input wire:model="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Contoh: Teknik Informatika">
                            @error('name')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Nama ini akan tampil sebagai pilihan program di form
                                pendaftaran peserta.</small>
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
