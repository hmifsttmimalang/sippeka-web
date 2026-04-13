<div>
    <div id="wrapper">
        @include('livewire.admin.partials.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('livewire.admin.partials.topbar')
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Kelola Jadwal Tes</h1>

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="row">
                        <!-- Form Section -->
                        <div class="col-md-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{ $isEditing ? 'Ubah' : 'Tambah' }}
                                        Jadwal</h6>
                                </div>
                                <div class="card-body">
                                    <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                                        <div class="form-group">
                                            <label>Jurusan</label>
                                            <select wire:model="jurusan_id"
                                                class="form-control @error('jurusan_id') is-invalid @enderror">
                                                <option value="">-- Pilih Jurusan --</option>
                                                @foreach ($jurusans as $j)
                                                    <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                                                @endforeach
                                            </select>
                                            @error('jurusan_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Pelaksanaan</label>
                                            <input type="date" wire:model="tanggal_pelaksanaan"
                                                class="form-control @error('tanggal_pelaksanaan') is-invalid @enderror">
                                            @error('tanggal_pelaksanaan')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Waktu Pelaksanaan (HH:mm)</label>
                                            <input type="time" wire:model="waktu_pelaksanaan"
                                                class="form-control @error('waktu_pelaksanaan') is-invalid @enderror">
                                            @error('waktu_pelaksanaan')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit"
                                            class="btn btn-{{ $isEditing ? 'warning' : 'primary' }} btn-block">
                                            {{ $isEditing ? 'Update' : 'Simpan' }}
                                        </button>
                                        @if ($isEditing)
                                            <button type="button" wire:click="resetFields"
                                                class="btn btn-secondary btn-block">Batal</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Table Section -->
                        <div class="col-md-8">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Jadwal Tes</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead-dark">
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Jurusan</th>
                                                    <th>Tanggal</th>
                                                    <th>Waktu</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($jadwalTes as $jadwal)
                                                    <tr class="text-center">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td class="text-left font-weight-bold">
                                                            {{ $jadwal->jurusan->nama_jurusan }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_pelaksanaan)->format('d-m-Y') }}
                                                        </td>
                                                        <td>{{ $jadwal->waktu_pelaksanaan }}</td>
                                                        <td>
                                                            <button wire:click="edit({{ $jadwal->id }})"
                                                                class="btn btn-sm btn-circle btn-warning"><i
                                                                    class="fas fa-edit"></i></button>
                                                            <button
                                                                onclick="confirm('Yakin hapus?') || event.stopImmediatePropagation()"
                                                                wire:click="delete({{ $jadwal->id }})"
                                                                class="btn btn-sm btn-circle btn-danger"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $jadwalTes->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
