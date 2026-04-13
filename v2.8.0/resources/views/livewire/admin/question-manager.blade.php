<div class="space-y-10 pb-12">
    <!-- Header Area -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-2">
            <div class="flex items-center space-x-2 text-slate-400 text-sm mb-1 font-medium">
                <a href="{{ route('admin.skill_test_manager') }}" class="hover:text-primary-600 transition-colors">Tes Keahlian</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-primary-600">Manajemen Soal</span>
            </div>
            <h2 class="text-3xl font-heading font-extrabold text-slate-900 tracking-tight">{{ $test->nama_tes }}</h2>
            <p class="text-slate-500 font-medium italic">Kelola daftar pertanyaan, pilihan jawaban, dan kunci jawaban untuk tes ini.</p>
        </div>
        
        <div class="flex items-center space-x-3">
            <button wire:click="openModal" class="px-6 py-3 bg-slate-900 text-white rounded-2xl font-bold text-sm shadow-xl shadow-slate-900/20 hover:bg-primary-600 hover:-translate-y-0.5 transition-all flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Tambah Soal</span>
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center space-x-2 font-bold text-sm shadow-sm animate-fade-in-down">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <!-- Search Area -->
    <div class="glass-card p-6 bg-white/40 border-white/60">
        <div class="relative max-w-lg group">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-primary-600 transition-colors">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </span>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari isi soal..." 
                class="block w-full pl-12 pr-4 py-3 bg-white/60 border-slate-200/60 focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-medium transition-all shadow-sm">
        </div>
    </div>

    <!-- Questions List -->
    <div class="space-y-6">
        @forelse($questions as $index => $question)
        <div class="glass-card p-8 bg-white/60 border-white/60 hover:border-primary-200 transition-all group relative overflow-hidden">
            <div class="absolute top-0 right-0 p-6 flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                <button wire:click="openModal({{ $question->id }})" class="p-2 text-slate-400 hover:text-primary-600 hover:bg-white rounded-xl shadow-sm border border-slate-100 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </button>
                <button onclick="confirm('Hapus soal ini?') || event.stopImmediatePropagation()" wire:click="delete({{ $question->id }})" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-white rounded-xl shadow-sm border border-slate-100 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </div>

            <div class="flex items-start space-x-6">
                <div class="w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center font-black text-sm shadow-lg flex-shrink-0">
                    {{ $questions->firstItem() + $index }}
                </div>
                <div class="flex-1 space-y-6">
                    <p class="text-base font-bold text-slate-900 leading-relaxed">{{ $question->soal }}</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach(['a', 'b', 'c', 'd'] as $option)
                        <div @class([
                            'p-4 rounded-2xl border transition-all flex items-start space-x-3',
                            'bg-emerald-50 border-emerald-200 ring-2 ring-emerald-500/10' => $question->jawaban_benar === $option,
                            'bg-white border-slate-100' => $question->jawaban_benar !== $option
                        ])>
                            <span @class([
                                'w-6 h-6 rounded-lg flex items-center justify-center font-black text-[10px] uppercase flex-shrink-0 shadow-sm',
                                'bg-emerald-500 text-white' => $question->jawaban_benar === $option,
                                'bg-slate-100 text-slate-400' => $question->jawaban_benar !== $option
                            ])>{{ $option }}</span>
                            <span @class([
                                'text-sm font-bold',
                                'text-emerald-900' => $question->jawaban_benar === $option,
                                'text-slate-600' => $question->jawaban_benar !== $option
                            ])>{{ $question->{'pilihan_' . $option} }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="glass-card py-20 bg-white/40 border-white/60 border-dashed text-center">
            <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <p class="text-slate-400 font-bold italic">Belum ada soal untuk tes ini.</p>
        </div>
        @endforelse

        <div class="pt-4">
            {{ $questions->links() }}
        </div>
    </div>

    <!-- Modal Form (Slide-over / Large Modal) -->
    @if($showingModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-6 bg-slate-900/60 backdrop-blur-sm animate-fade-in">
        <div class="w-full max-w-4xl bg-white rounded-[40px] shadow-2xl border border-white/60 overflow-hidden transform animate-scale-up">
            <div class="px-12 py-8 bg-slate-50/80 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-heading font-black text-slate-900">{{ $editingId ? 'Edit Pertanyaan' : 'Tambah Pertanyaan Baru' }}</h3>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">Gunakan editor di bawah untuk menyusun soal</p>
                </div>
                <button wire:click="closeModal" class="p-3 text-slate-400 hover:text-slate-600 transition-colors bg-white rounded-2xl shadow-sm border border-slate-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form wire:submit="save" class="p-12 space-y-8 max-h-[70vh] overflow-y-auto custom-scrollbar">
                <div class="space-y-4">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Isi Pertanyaan (Soal)</label>
                    <textarea wire:model="soal" rows="4" placeholder="Ketikkan isi pertanyaan di sini..." 
                        class="block w-full px-6 py-5 bg-slate-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-3xl text-base font-bold text-slate-900 transition-all"></textarea>
                    @error('soal') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach(['a', 'b', 'c', 'd'] as $option)
                    <div class="space-y-3 p-6 rounded-[32px] bg-slate-50/50 border border-slate-100 transition-all focus-within:bg-white focus-within:ring-4 focus-within:ring-primary-500/5 focus-within:border-primary-200">
                        <div class="flex items-center justify-between">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Pilihan {{ strtoupper($option) }}</label>
                            <label class="flex items-center space-x-2 cursor-pointer group">
                                <span class="text-[10px] font-black text-slate-400 group-hover:text-emerald-600 transition-colors">Kunci</span>
                                <input type="radio" wire:model="jawaban_benar" value="{{ $option }}" class="w-5 h-5 border-slate-200 text-emerald-500 focus:ring-emerald-500 transition-all">
                            </label>
                        </div>
                        <input wire:model="pilihan_{{ $option }}" type="text" placeholder="Isi pilihan {{ $option }}..." 
                            class="block w-full px-5 py-3 bg-white border border-slate-100 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-900 transition-all">
                        @error('pilihan_' . $option) <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                    </div>
                    @endforeach
                </div>

                <div class="pt-8 flex items-center justify-end space-x-4 border-t border-slate-100">
                    <button type="button" wire:click="closeModal" class="px-8 py-4 text-slate-500 font-bold text-sm hover:bg-slate-50 rounded-2xl transition-all">Batalkan</button>
                    <button type="submit" class="px-10 py-4 bg-slate-900 text-white rounded-2xl font-bold text-sm shadow-2xl shadow-slate-900/30 hover:bg-primary-600 hover:shadow-primary-600/40 transition-all flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Simpan Pertanyaan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
