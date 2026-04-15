<div>
    <div id="wrapper">
        @include('livewire.admin.partials.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('livewire.admin.partials.topbar')
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-4">
                            <li class="breadcrumb-item"><a href="{{ route('admin.skill_test_manager') }}">Tes Keahlian</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Manajemen Soal</li>
                        </ol>
                    </nav>

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">{{ $test->name }}</h1>
                        <div class="d-flex gap-2">
                            <button wire:click="showingImportModal" class="d-none d-sm-inline-block btn btn-sm btn-outline-success shadow-sm mr-2">
                                <i class="fas fa-file-excel fa-sm mr-2"></i> Impor Excel
                            </button>
                            <button wire:click="openModal"
                                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-plus fa-sm text-white-50 mr-2"></i> Tambah Soal Baru
                            </button>
                        </div>
                    </div>

                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- Search -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0"><i
                                            class="fas fa-search text-gray-400"></i></span>
                                </div>
                                <input wire:model.live.debounce.300ms="search" type="text"
                                    class="form-control border-left-0" placeholder="Cari isi soal...">
                            </div>
                        </div>
                    </div>

                    <!-- Questions List -->
                    <div class="row">
                        @forelse($questions as $index => $question)
                            <div class="col-12 mb-4">
                                <div class="card shadow border-left-primary h-100 py-2">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div class="h5 font-weight-bold text-primary mb-0">Pertanyaan
                                                #{{ $questions->firstItem() + $index }}</div>
                                            <div class="btn-group">
                                                <button wire:click="openModal({{ $question->id }})"
                                                    class="btn btn-sm btn-warning btn-circle shadow-sm"
                                                    title="Edit"><i class="fas fa-edit"></i></button>
                                                <button
                                                    onclick="confirm('Hapus soal ini?') || event.stopImmediatePropagation()"
                                                    wire:click="delete({{ $question->id }})"
                                                    class="btn btn-sm btn-danger btn-circle shadow-sm ml-1"
                                                    title="Hapus"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                        <p class="text-gray-800 font-weight-bold mb-4" style="font-size: 1.1rem;">
                                            {{ $question->question }}</p>

                                        <div class="row">
                                            @foreach (['a', 'b', 'c', 'd'] as $option)
                                                <div class="col-md-6 mb-3">
                                                    <div
                                                        class="p-3 rounded border {{ $question->correct_answer === $option ? 'bg-success text-white border-success' : 'bg-light border-gray-200' }}">
                                                        <span
                                                            class="badge {{ $question->correct_answer === $option ? 'badge-light text-success' : 'badge-dark' }} mr-2">
                                                            {{ strtoupper($option) }}
                                                        </span>
                                                        {{ $question->{'option_' . $option} }}
                                                        @if ($question->correct_answer === $option)
                                                            <i class="fas fa-check-circle float-right mt-1"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <img src="{{ asset('assets/admin/img/undraw_no_data.svg') }}"
                                    style="width: 250px; opacity: 0.5;">
                                <h4 class="mt-4 text-gray-400 font-italic">Belum ada soal untuk tes ini.</h4>
                            </div>
                        @endforelse
                    </div>

                    <div class="mb-5">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Simulation -->
    @if ($showingModal)
        <div class="fixed-top w-100 h-100 d-flex align-items-center justify-content-center"
            style="background: rgba(0,0,0,0.6); z-index: 1050; padding: 2rem;">
            <div class="card shadow mb-4 animate-fade-in"
                style="width: 100%; max-width: 800px; max-height: 90vh; overflow-y: auto;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between sticky-top bg-white"
                    style="z-index: 10;">
                    <h6 class="m-0 font-weight-bold text-primary">
                        {{ $editingId ? 'Edit Pertanyaan' : 'Tambah Pertanyaan Baru' }}</h6>
                    <button wire:click="closeModal" class="btn btn-sm btn-link text-gray-400"><i
                            class="fas fa-times"></i></button>
                </div>
                <div class="card-body">
                    <form wire:submit="save">
                        <div class="form-group">
                            <label class="font-weight-bold small text-uppercase">Isi Pertanyaan</label>
                            <textarea wire:model="question" rows="3" class="form-control @error('question') is-invalid @enderror"
                                placeholder="Ketikkan isi pertanyaan..."></textarea>
                            @error('question')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            @foreach (['a', 'b', 'c', 'd'] as $option)
                                <div class="col-md-6">
                                    <div
                                        class="card mb-3 border-left-{{ $correct_answer === $option ? 'success' : 'secondary' }} bg-light">
                                        <div class="card-body p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <label class="font-weight-bold small text-uppercase mb-0">Pilihan
                                                    {{ strtoupper($option) }}</label>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="radio_{{ $option }}"
                                                        wire:model="correct_answer" value="{{ $option }}"
                                                        class="custom-control-input">
                                                    <label
                                                        class="custom-control-label small font-weight-bold text-success"
                                                        for="radio_{{ $option }}">Kunci</label>
                                                </div>
                                            </div>
                                            <input wire:model="option_{{ $option }}" type="text"
                                                class="form-control form-control-sm @error('option_' . $option) is-invalid @enderror"
                                                placeholder="Isi pilihan {{ $option }}...">
                                            @error('option_' . $option)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="text-right">
                            <button type="button" wire:click="closeModal"
                                class="btn btn-secondary btn-sm px-4">Batal</button>
                            <button type="submit" class="btn btn-primary btn-sm px-4 shadow-sm">Simpan
                                Pertanyaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Import Modal -->
    @if ($showingImportModal)
        <div class="fixed-top w-100 h-100 d-flex align-items-center justify-content-center"
            style="background: rgba(0,0,0,0.6); z-index: 1050; padding: 2rem;">
            <div class="card shadow mb-4 animate-fade-in" style="width: 100%; max-width: 500px;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-file-excel mr-2"></i>Impor Soal Excel</h6>
                    <button wire:click="closeModal" class="btn btn-sm btn-link text-gray-400"><i class="fas fa-times"></i></button>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="importFromExcel">
                        <div class="alert alert-info small">
                            <h6 class="font-weight-bold mb-1">Format Excel:</h6>
                            <ul class="mb-0 pl-3">
                                <li>Kolom A: Isi Pertanyaan</li>
                                <li>Kolom B: Pilihan A</li>
                                <li>Kolom C: Pilihan B</li>
                                <li>Kolom D: Pilihan C</li>
                                <li>Kolom E: Pilihan D</li>
                                <li>Kolom F: Jawaban Benar (A/B/C/D)</li>
                            </ul>
                            <div class="mt-2 text-primary font-weight-bold">Baris pertama (header) akan diabaikan.</div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Pilih File Excel (.xlsx / .xls)</label>
                            <input type="file" wire:model="excelFile" class="form-control-file @error('excelFile') is-invalid @enderror">
                            @error('excelFile') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            
                            <div wire:loading wire:target="excelFile" class="mt-2 text-primary small">
                                <i class="fas fa-spinner fa-spin mr-1"></i> Sedang mengunggah...
                            </div>
                        </div>

                        <hr>
                        <div class="text-right">
                            <button type="button" wire:click="closeModal" class="btn btn-secondary btn-sm px-4">Batal</button>
                            <button type="submit" class="btn btn-success btn-sm px-4 shadow-sm" wire:loading.attr="disabled">
                                <i class="fas fa-upload mr-1"></i> Impor Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
