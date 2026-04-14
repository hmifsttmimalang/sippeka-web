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
                                    <h6 class="m-0 font-weight-bold text-primary">{{ $isEditing ? 'Ubah' : 'Tambah' }} Jadwal Tes</h6>
                                </div>
                                <div class="card-body">
                                    <form wire:submit.prevent="save">
                                        <div class="form-group">
                                            <label>Jurusan</label>
                                            <select wire:model="major_id" class="form-control @error('major_id') is-invalid @enderror">
                                                <option value="">-- Pilih Jurusan --</option>
                                                @foreach ($majors as $major)
                                                    <option value="{{ $major->id }}">{{ $major->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('major_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Pelaksanaan</label>
                                            <input type="date" wire:model="test_date" class="form-control @error('test_date') is-invalid @enderror">
                                            @error('test_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Waktu Pelaksanaan</label>
                                            <input type="time" wire:model="test_time" class="form-control @error('test_time') is-invalid @enderror">
                                            @error('test_time') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>

                                        <button type="submit" class="btn btn-{{ $isEditing ? 'warning' : 'primary' }} btn-block">
                                            {{ $isEditing ? 'Update' : 'Simpan' }}
                                        </button>
                                        @if ($isEditing)
                                            <button type="button" wire:click="resetFields" class="btn btn-secondary btn-block">Batal</button>
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
                                                @forelse ($testSchedules as $schedule)
                                                    <tr class="text-center">
                                                        <td>{{ ($testSchedules->currentPage() - 1) * $testSchedules->perPage() + $loop->iteration }}</td>
                                                        <td class="text-left font-weight-bold">{{ $schedule->major->name ?? '-' }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($schedule->test_date)->translatedFormat('d F Y') }}</td>
                                                        <td>{{ $schedule->test_time }}</td>
                                                        <td>
                                                            <button wire:click="edit({{ $schedule->id }})" class="btn btn-sm btn-circle btn-warning" title="Edit"><i class="fas fa-edit"></i></button>
                                                            <button onclick="confirm('Hapus jadwal?') || event.stopImmediatePropagation()" wire:click="delete({{ $schedule->id }})" class="btn btn-sm btn-circle btn-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">Data kosong</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        {{ $testSchedules->links() }}
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
