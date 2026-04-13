<div class="space-y-10 pb-12">
    <!-- Header Area -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-2">
            <h2 class="text-3xl font-heading font-extrabold text-slate-900 tracking-tight">Manajemen Tes Keahlian</h2>
            <p class="text-slate-500 font-medium italic">Konfigurasi tes keahlian untuk setiap program keahlian yang tersedia.</p>
        </div>
        
        <div class="flex items-center space-x-3">
            <button wire:click="openModal" class="px-5 py-3 bg-primary-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-primary-600/20 hover:bg-primary-700 hover:-translate-y-0.5 transition-all flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Buat Tes Baru</span>
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center space-x-2 font-bold text-sm shadow-sm animate-fade-in-down">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <!-- Filters Area -->
    <div class="glass-card p-6 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white/40 border-white/60">
        <div class="relative flex-1 max-w-lg group">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-primary-600 transition-colors">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </span>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama tes..." 
                class="block w-full pl-12 pr-4 py-3 bg-white/60 border-slate-200/60 focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-medium transition-all shadow-sm">
        </div>
    </div>

    <!-- Table Section -->
    <div class="glass-card shadow-2xl shadow-slate-200/60 overflow-hidden bg-white/60">
        <div class="overflow-x-auto min-h-[400px]">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100/50">
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em]">Detail Tes</th>
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-center">Kategori & Skill</th>
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-center">Durasi</th>
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-center">Acak</th>
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80">
                    @forelse($tests as $test)
                    <tr class="hover:bg-primary-50/30 transition-all group">
                        <td class="px-8 py-6">
                            <span class="font-bold text-slate-900 group-hover:text-primary-600 transition-colors block">{{ $test->nama_tes }}</span>
                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-1">ID: #{{ str_pad($test->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <div class="flex flex-col items-center space-y-1">
                                <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-lg text-[10px] font-bold ring-1 ring-indigo-100">
                                    {{ $test->category->nama ?? '-' }}
                                </span>
                                <span class="text-[10px] text-slate-400 font-bold italic">{{ $test->skill->nama ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="text-sm font-black text-slate-900">{{ $test->durasi_menit }} <small class="text-slate-400 font-bold">MIN</small></span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <span @class([
                                    'px-2 py-0.5 rounded-md text-[9px] font-black uppercase tracking-tighter',
                                    'bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100' => $test->acak_soal === 'y',
                                    'bg-slate-50 text-slate-400' => $test->acak_soal === 't'
                                ]) title="Acak Soal">SOAL</span>
                                <span @class([
                                    'px-2 py-0.5 rounded-md text-[9px] font-black uppercase tracking-tighter',
                                    'bg-indigo-50 text-indigo-600 ring-1 ring-indigo-100' => $test->acak_jawaban === 'y',
                                    'bg-slate-50 text-slate-400' => $test->acak_jawaban === 't'
                                ]) title="Acak Jawaban">JAWAB</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.question_manager', $test->id) }}" class="p-2.5 text-slate-400 hover:text-indigo-600 hover:bg-white rounded-xl hover:shadow-md transition-all" title="Kelola Soal">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </a>
                                <button wire:click="openModal({{ $test->id }})" class="p-2.5 text-slate-400 hover:text-primary-600 hover:bg-white rounded-xl hover:shadow-md transition-all" title="Edit Pengaturan">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <button onclick="confirm('Hapus tes ini?') || event.stopImmediatePropagation()" wire:click="delete({{ $test->id }})" class="p-2.5 text-slate-400 hover:text-rose-600 hover:bg-white rounded-xl hover:shadow-md transition-all" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-32 text-center text-slate-400 italic font-medium">Belum ada tes keahlian yang dikonfigurasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100/50">
            {{ $tests->links() }}
        </div>
    </div>

    <!-- Modal Form -->
    @if($showingModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-6 bg-slate-900/60 backdrop-blur-sm animate-fade-in">
        <div class="w-full max-w-2xl bg-white rounded-[32px] shadow-2xl border border-white/60 overflow-hidden transform animate-scale-up">
            <div class="px-10 py-8 bg-slate-50/80 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-heading font-black text-slate-900">{{ $editingId ? 'Edit Konfigurasi Tes' : 'Buat Tes Keahlian Baru' }}</h3>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Konfigurasi Pengaturan Tes</p>
                </div>
                <button wire:click="closeModal" class="p-3 text-slate-400 hover:text-slate-600 transition-colors bg-white rounded-2xl shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form wire:submit="save" class="p-10 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] leading-none ml-2">Nama Tes Keahlian</label>
                        <input wire:model="nama_tes" type="text" placeholder="Contoh: Tes Kompetensi Welding Dasar" 
                            class="block w-full px-6 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-900 transition-all">
                        @error('nama_tes') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] leading-none ml-2 text-primary-600">Kategori / Mata Soal</label>
                        <select wire:model="mata_soal" class="block w-full px-6 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-900 transition-all">
                            <option value="">Pilih Mata Soal</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                            @endforeach
                        </select>
                        @error('mata_soal') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] leading-none ml-2 text-indigo-600">Program Keahlian</label>
                        <select wire:model="keahlian" class="block w-full px-6 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-900 transition-all">
                            <option value="">Pilih Skill</option>
                            @foreach($skills as $sk)
                                <option value="{{ $sk->id }}">{{ $sk->nama }}</option>
                            @endforeach
                        </select>
                        @error('keahlian') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] leading-none ml-2">Durasi (Menit)</label>
                        <input wire:model="durasi_menit" type="number" 
                            class="block w-full px-6 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-900 transition-all">
                        @error('durasi_menit') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] leading-none ml-2">Pengaturan Acak</label>
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center space-x-2 cursor-pointer group">
                                <input type="checkbox" wire:model="acak_soal" value="y" true-value="y" false-value="t" class="w-5 h-5 rounded-lg border-slate-200 text-primary-600 focus:ring-primary-500 transition-all">
                                <span class="text-sm font-bold text-slate-600 group-hover:text-slate-900">Acak Soal</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer group">
                                <input type="checkbox" wire:model="acak_jawaban" value="y" true-value="y" false-value="t" class="w-5 h-5 rounded-lg border-slate-200 text-indigo-600 focus:ring-primary-500 transition-all">
                                <span class="text-sm font-bold text-slate-600 group-hover:text-slate-900">Acak Jawaban</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="pt-6 flex items-center justify-end space-x-4 border-t border-slate-100">
                    <button type="button" wire:click="closeModal" class="px-8 py-4 text-slate-500 font-bold text-sm hover:bg-slate-50 rounded-2xl transition-all">Batalkan</button>
                    <button type="submit" class="px-10 py-4 bg-slate-900 text-white rounded-2xl font-bold text-sm shadow-2xl shadow-slate-900/30 hover:bg-primary-600 hover:shadow-primary-600/40 transition-all flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Simpan Konfigurasi</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
