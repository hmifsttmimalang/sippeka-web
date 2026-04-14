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
                                        <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                    @endforeach
                                </select>
                                <input wire:model.live.debounce.300ms="search" type="text"
                                    class="form-control form-control-sm" placeholder="Cari nama..."
                                    style="width: 200px;">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle">
                                    <thead class="thead-dark">
                                        <tr class="text-center">
                                            @if (auth()->user()->isInstructor())
                                                <th>Foto</th>
                                            @endif
                                            <th>Peserta</th>
                                            @if (auth()->user()->isAdmin())
                                                <th>Nilai Seleksi</th>
                                            @endif
                                            <th>Nilai Wawancara</th>
                                            @if (auth()->user()->isAdmin())
                                                <th>Rata-rata</th>
                                                <th>Status</th>
                                                <th>Unduh</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($registrations as $registration)
                                            <tr class="text-center">
                                                @if (auth()->user()->isInstructor())
                                                    <td style="width: 80px;">
                                                        <div class="rounded shadow-sm overflow-hidden"
                                                            style="width: 60px; height: 75px; margin: 0 auto;">
                                                            @if ($registration->formal_photo_path)
                                                                <img src="{{ asset('storage/' . $registration->formal_photo_path) }}"
                                                                    class="img-fluid h-100 w-100 object-fit-cover"
                                                                    onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($registration->name) }}&background=random'"
                                                                    onclick="window.open(this.src, '_blank')"
                                                                    style="cursor: zoom-in;">
                                                            @else
                                                                <div
                                                                    class="bg-light d-flex align-items-center justify-content-center h-100">
                                                                    <i class="fas fa-user text-gray-300"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                @endif
                                                <td class="text-left">
                                                    <div class="font-weight-bold text-gray-800">
                                                        {{ $registration->name }}</div>
                                                    <div
                                                        class="badge badge-light border text-primary small uppercase px-2 py-1 mt-1">
                                                        {{ $registration->skill->name ?? '-' }}</div>
                                                </td>
                                                @if (auth()->user()->isAdmin())
                                                    <td><span class="badge badge-info px-3 py-2"
                                                            style="font-size: 0.9rem;">{{ number_format($registration->skill_test_score, 1) }}</span>
                                                    </td>
                                                @endif
                                                <td>
                                                    @if ($editingId === $registration->id && auth()->user()->isInstructor())
                                                        <div
                                                            class="d-flex justify-content-center align-items-center gap-1">
                                                            <input wire:model="tempInterviewScore" type="number"
                                                                step="0.5"
                                                                class="form-control form-control-sm text-center"
                                                                style="width: 80px;">
                                                            <button wire:click="saveScore"
                                                                class="btn btn-sm btn-success"><i
                                                                    class="fas fa-check"></i></button>
                                                            <button wire:click="cancelEdit"
                                                                class="btn btn-sm btn-secondary"><i
                                                                    class="fas fa-times"></i></button>
                                                        </div>
                                                        @error('tempInterviewScore')
                                                            <div class="text-danger extra-small">{{ $message }}</div>
                                                        @enderror
                                                    @else
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <span
                                                                class="h5 mb-0 font-weight-bold {{ $registration->interview_score !== null ? 'text-dark' : 'text-gray-400 font-italic' }}">
                                                                {{ $registration->interview_score !== null ? number_format($registration->interview_score, 1) : 'Belum Ada' }}
                                                            </span>
                                                            @if (auth()->user()->isInstructor())
                                                                <button wire:click="editScore({{ $registration->id }})"
                                                                    class="btn btn-sm btn-link ml-2"><i
                                                                        class="fas fa-edit"></i></button>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </td>
                                                @if (auth()->user()->isAdmin())
                                                    <td class="font-weight-bold text-primary">
                                                        {{ $registration->average_score !== null ? number_format($registration->average_score, 1) : '-' }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $badgeClass = match ($registration->status) {
                                                                'Passed' => 'badge-success',
                                                                'Failed' => 'badge-danger',
                                                                'In Progress' => 'badge-warning',
                                                                'Not Yet Tested' => 'badge-info',
                                                                default => 'badge-secondary',
                                                            };
                                                        @endphp
                                                        <span
                                                            class="badge {{ $badgeClass }} px-3 py-1">{{ $registration->status }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.reports.registration', $registration->id) }}"
                                                            target="_blank"
                                                            class="btn btn-sm btn-outline-primary border-0 rounded-circle"><i
                                                                class="fas fa-file-pdf"></i></a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="{{ auth()->user()->isAdmin() ? 6 : 4 }}"
                                                    class="text-center py-5 text-gray-500 font-italic">Belum ada peserta
                                                    yang memenuhi kriteria penilaian.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $registrations->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
