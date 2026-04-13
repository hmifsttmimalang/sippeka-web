<div>
    <div id="wrapper">
        @include('livewire.admin.partials.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('livewire.admin.partials.topbar')
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manajemen Akun User</h1>
                        <button wire:click="openModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-user-plus fa-sm text-white-50 mr-2"></i> Tambah User
                        </button>
                    </div>

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- User Table Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Pengguna Sistem</h6>
                            <div class="d-flex gap-2">
                                <select wire:model.live="filterRole" class="form-control form-control-sm mr-2" style="width: 150px;">
                                    <option value="">Semua Role</option>
                                    <option value="admin">Administrator</option>
                                    <option value="instruktur">Instruktur</option>
                                    <option value="user">Peserta</option>
                                </select>
                                <input wire:model.live.debounce.300ms="search" type="text" class="form-control form-control-sm" placeholder="Search..." style="width: 200px;">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                    <thead class="thead-dark text-center">
                                        <tr>
                                            <th>Nama / Email</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Verifikasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $user)
                                            <tr class="text-center">
                                                <td class="text-left font-weight-bold">
                                                    <div class="text-primary">{{ $user->name }}</div>
                                                    <div class="small text-gray-500 font-weight-normal">{{ $user->email }}</div>
                                                </td>
                                                <td><code class="text-indigo-700 bg-indigo-50 px-1 rounded">{{ $user->username }}</code></td>
                                                <td>
                                                    @php
                                                        $roleBadge = match($user->role) {
                                                            'admin' => 'badge-primary',
                                                            'instruktur' => 'badge-warning',
                                                            'user' => 'badge-success',
                                                            default => 'badge-secondary'
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $roleBadge }} text-uppercase">{{ $user->role }}</span>
                                                </td>
                                                <td>
                                                    @if($user->status_register === 'verified' || $user->role === 'admin')
                                                        <i class="fas fa-check-circle text-success" title="Verified"></i>
                                                    @elseif($user->status_register === 'pending')
                                                        <i class="fas fa-clock text-warning" title="Pending"></i>
                                                    @else
                                                        <i class="fas fa-times-circle text-gray-300" title="Not Registered"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button wire:click="openModal({{ $user->id }})" class="btn btn-sm btn-warning btn-circle shadow-sm" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        @if(auth()->id() !== $user->id)
                                                            <button onclick="confirm('Hapus akun ini?') || event.stopImmediatePropagation()" wire:click="delete({{ $user->id }})" class="btn btn-sm btn-danger btn-circle shadow-sm" title="Hapus">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-5 text-gray-400 font-italic">Data user tidak ditemukan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Livewire Modal Simulation -->
    @if($showingModal)
    <div class="fixed-top w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.5); z-index: 1050;">
        <div class="card shadow mb-4 animate-fade-in" style="width: 600px;">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{{ $editingId ? 'Edit Akun User' : 'Tambah User' }}</h6>
                <button wire:click="closeModal" class="btn btn-sm btn-link text-gray-400"><i class="fas fa-times"></i></button>
            </div>
            <div class="card-body">
                <form wire:submit="save">
                    <div class="form-group">
                        <label class="font-weight-bold small text-uppercase">Nama Lengkap</label>
                        <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold small text-uppercase">Username</label>
                            <input wire:model="username" type="text" class="form-control @error('username') is-invalid @enderror">
                            @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold small text-uppercase">Hak Akses (Role)</label>
                            <select wire:model="role" class="form-control @error('role') is-invalid @enderror">
                                <option value="admin">Administrator</option>
                                <option value="instruktur">Instruktur</option>
                                <option value="user">Peserta</option>
                            </select>
                            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold small text-uppercase">Email</label>
                        <input wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold small text-uppercase text-primary">Password {{ $editingId ? '(Kosongkan jika tidak ingin diubah)' : '' }}</label>
                        <input wire:model="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <hr>
                    <div class="text-right">
                        <button type="button" wire:click="closeModal" class="btn btn-secondary btn-sm px-4">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm px-4 shadow-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
