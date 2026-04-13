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
                                <select wire:model.live="filterSkill" class="form-control form-control-sm mr-2" style="width: 200px;">
                                    <option value="">Semua Program Keahlian</option>
                                    @foreach($skills as $skill)
                                        <option value="{{ $skill->id }}">{{ $skill->nama }}</option>
                                    @endforeach
                                </select>
                                <input wire:model.live.debounce.300ms="search" type="text" class="form-control form-control-sm" placeholder="Cari nama/telepon..." style="width: 200px;">
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
                                                <td class="text-left font-weight-bold text-primary">{{ $registrant->nama }}</td>
                                                <td>{{ $registrant->telepon }}</td>
                                                <td><span class="badge badge-indigo text-indigo-700 bg-indigo-50 border border-indigo-100">{{ $registrant->keahlian->nama ?? '-' }}</span></td>
                                                <td><span class="font-weight-bold text-gray-800">{{ $registrant->average_score ?? '-' }}</span></td>
                                                <td>
                                                    @php
                                                        $badgeClass = match($registrant->status) {
                                                            'Lulus' => 'badge-success',
                                                            'Gagal' => 'badge-danger',
                                                            'Sedang Diproses' => 'badge-warning',
                                                            default => 'badge-secondary'
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }}">{{ $registrant->status }}</span>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-info" title="Lihat Profil"><i class="fas fa-user"></i></button>
                                                        <button class="btn btn-sm btn-danger" onclick="confirm('Hapus pendaftar?') || event.stopImmediatePropagation()" wire:click="delete({{ $registrant->id }})" title="Hapus"><i class="fas fa-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-5 text-gray-500 font-italic">Tidak ditemukan data pendaftar.</td>
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
</div>
