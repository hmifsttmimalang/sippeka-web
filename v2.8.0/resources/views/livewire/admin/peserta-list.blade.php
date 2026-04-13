<div>
    <div id="wrapper">
        <!-- Sidebar -->
        @include('livewire.admin.partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('livewire.admin.partials.topbar')

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Data Peserta</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 flex justify-between items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Peserta Terurut Nilai Tertinggi</h6>
                            <div class="flex items-center space-x-2">
                                <input type="text" wire:model.live="search" class="form-control form-control-sm"
                                    placeholder="Cari nama...">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Keahlian</th>
                                            <th>Nilai Keahlian</th>
                                            <th>Nilai Wawancara</th>
                                            <th>Rata-rata</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listPendaftar as $item)
                                            <tr class="text-center">
                                                <td>{{ ($listPendaftar->currentPage() - 1) * $listPendaftar->perPage() + $loop->iteration }}
                                                </td>
                                                <td class="text-left font-weight-bold">{{ $item->nama }}</td>
                                                <td>{{ $item->skill->nama ?? '-' }}</td>
                                                <td><span
                                                        class="badge badge-info">{{ $item->nilai_keahlian ?? '0' }}</span>
                                                </td>
                                                <td><span
                                                        class="badge badge-primary">{{ $item->nilai_wawancara ?? '0' }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge {{ $item->rata_rata >= 70 ? 'badge-success' : 'badge-warning' }}">
                                                        {{ number_format($item->rata_rata, 2) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $listPendaftar->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
