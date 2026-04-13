<div>
    <div id="wrapper">
        @include('livewire.admin.partials.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('livewire.admin.partials.topbar')
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Kelola Jurusan</h1>

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
                                        Jurusan</h6>
                                </div>
                                <div class="card-body">
                                    <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                                        <div class="form-group">
                                            <label>Nama Jurusan</label>
                                            <input type="text" wire:model="nama_jurusan"
                                                class="form-control @error('nama_jurusan') is-invalid @enderror">
                                            @error('nama_jurusan')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Kuota</label>
                                            <input type="number" wire:model="kuota"
                                                class="form-control @error('kuota') is-invalid @enderror">
                                            @error('kuota')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select wire:model="status" class="form-control">
                                                <option value="dibuka">Dibuka</option>
                                                <option value="ditutup">Ditutup</option>
                                            </select>
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
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Jurusan</h6>
                                    <input type="text" wire:model.live="search"
                                        class="form-control form-control-sm w-25" placeholder="Cari...">
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead-dark">
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Nama Jurusan</th>
                                                    <th>Kuota</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($jurusans as $jurusan)
                                                    <tr class="text-center">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td class="text-left">{{ $jurusan->nama_jurusan }}</td>
                                                        <td>{{ $jurusan->kuota }}</td>
                                                        <td>
                                                            <span
                                                                class="badge badge-{{ $jurusan->status == 'dibuka' ? 'success' : 'danger' }}">
                                                                {{ ucfirst($jurusan->status) }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <button wire:click="edit({{ $jurusan->id }})"
                                                                class="btn btn-sm btn-circle btn-warning"><i
                                                                    class="fas fa-edit"></i></button>
                                                            <button
                                                                onclick="confirm('Yakin hapus?') || event.stopImmediatePropagation()"
                                                                wire:click="delete({{ $jurusan->id }})"
                                                                class="btn btn-sm btn-circle btn-danger"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $jurusans->links() }}
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
