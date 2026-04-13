<div>
    <div id="wrapper">
        @php
            $sidebar =
                auth()->user()->role === 'admin'
                    ? 'livewire.admin.partials.sidebar'
                    : 'livewire.instructor.partials.sidebar';
            $topbar =
                auth()->user()->role === 'admin'
                    ? 'livewire.admin.partials.topbar'
                    : 'livewire.instructor.partials.topbar';
        @endphp
        @include($sidebar)
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include($topbar)
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Evaluasi & Penilaian Akhir</h1>

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Hasil Seleksi Peserta</h6>
                            <div class="d-flex gap-2">
                                <select wire:model.live="filterSkill" class="form-control form-control-sm mr-2"
                                    style="width: 200px;">
                                    <option value="">Semua Program</option>
                                    @foreach ($skills as $skill)
                                        <option value="{{ $skill->id }}">{{ $skill->nama }}</option>
                                    @endforeach
                                </select>
                                <input wire:model.live.debounce.300ms="search" type="text"
                                    class="form-control form-control-sm" placeholder="Cari nama..."
                                    style="width: 200px;">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr class="text-center">
                                            <th>Nama Peserta</th>
                                            <th>Nilai Seleksi</th>
                                            <th>Nilai Wawancara</th>
                                            <th>Rata-rata</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($registrations as $reg)
                                            <tr class="text-center">
                                                <td class="text-left">
                                                    <div class="font-weight-bold text-primary">{{ $reg->nama }}</div>
                                                    <div class="small text-gray-500 uppercase">
                                                        {{ $reg->keahlian_rel->nama ?? '-' }}</div>
                                                </td>
                                                <td><span
                                                        class="badge badge-info">{{ number_format($reg->nilai_keahlian, 1) }}</span>
                                                </td>
                                                <td>
                                                    @if ($editingId === $reg->id)
                                                        <div
                                                            class="d-flex justify-content-center align-items-center gap-1">
                                                            <input wire:model="tempNilaiWawancara" type="number"
                                                                step="0.5"
                                                                class="form-control form-control-sm text-center"
                                                                style="width: 70px;">
                                                            <button wire:click="saveScore"
                                                                class="btn btn-sm btn-success"><i
                                                                    class="fas fa-check"></i></button>
                                                            <button wire:click="cancelEdit"
                                                                class="btn btn-sm btn-secondary"><i
                                                                    class="fas fa-times"></i></button>
                                                        </div>
                                                        @error('tempNilaiWawancara')
                                                            <div class="text-danger small">{{ $message }}</div>
                                                        @enderror
                                                    @else
                                                        <span
                                                            class="font-weight-bold {{ $reg->nilai_wawancara !== null ? 'underline' : 'text-gray-400 font-italic' }}">
                                                            {{ $reg->nilai_wawancara !== null ? number_format($reg->nilai_wawancara, 1) : 'Belum Ada' }}
                                                        </span>
                                                        <button wire:click="editScore({{ $reg->id }})"
                                                            class="btn btn-sm btn-link"><i
                                                                class="fas fa-edit"></i></button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($reg->average_score !== null)
                                                        <span
                                                            class="font-weight-bold text-gray-800">{{ number_format($reg->average_score, 1) }}</span>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $badgeClass = match ($reg->status) {
                                                            'Lulus' => 'badge-success',
                                                            'Gagal' => 'badge-danger',
                                                            'Sedang Diproses' => 'badge-warning',
                                                            default => 'badge-secondary',
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }}">{{ $reg->status }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.reports.registration', $reg->id) }}"
                                                        target="_blank"
                                                        class="btn btn-sm btn-outline-primary shadow-sm">
                                                        <i class="fas fa-print fa-sm mr-1"></i> PDF
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-5 text-gray-500 font-italic">
                                                    Belum ada peserta yang menyelesaikan seleksi.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $registrations->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
