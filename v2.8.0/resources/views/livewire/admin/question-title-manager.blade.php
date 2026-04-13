<div class="space-y-10 pb-12">
    <!-- Header Area -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-2">
            <h2 class="text-3xl font-heading font-extrabold text-slate-900 tracking-tight">Manajemen Mata Soal</h2>
            <p class="text-slate-500 font-medium italic">Kelola kategori atau mata soal yang akan diujikan pada tes keahlian.</p>
        </div>
        
        <div class="flex items-center space-x-3">
            <button wire:click="openModal" class="px-5 py-3 bg-primary-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-primary-600/20 hover:bg-primary-700 hover:-translate-y-0.5 transition-all flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Tambah Mata Soal</span>
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
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-primary-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </span>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama mata soal..." 
                class="block w-full pl-12 pr-4 py-3 bg-white/60 border-slate-200/60 focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-medium transition-all shadow-sm">
        </div>
    </div>

    <!-- Table Section -->
    <div class="glass-card shadow-2xl shadow-slate-200/60 overflow-hidden bg-white/60">
        <div class="overflow-x-auto min-h-[400px]">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100/50">
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em]">Nama Mata Soal</th>
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-center">Jumlah Tes</th>
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80">
                    @forelse($categories as $category)
                    <tr class="hover:bg-primary-50/30 transition-all group">
                        <td class="px-8 py-6">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-500 to-indigo-600 text-white flex items-center justify-center font-bold text-lg shadow-lg shadow-primary-600/20">
                                    {{ substr($category->nama, 0, 1) }}
                                </div>
                                <span class="font-bold text-slate-900 group-hover:text-primary-600 transition-colors">{{ $category->nama }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="inline-flex px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs font-black ring-1 ring-slate-200">
                                {{ $category->skill_tests_count ?? 0 }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <button wire:click="openModal({{ $category->id }})" class="p-2.5 text-slate-400 hover:text-primary-600 hover:bg-white rounded-xl hover:shadow-md transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <button onclick="confirm('Yakin ingin menghapus mata soal ini?') || event.stopImmediatePropagation()" wire:click="delete({{ $category->id }})" class="p-2.5 text-slate-400 hover:text-rose-600 hover:bg-white rounded-xl hover:shadow-md transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-8 py-32 text-center text-slate-400 italic">Belum ada mata soal yang terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100/50">
            {{ $categories->links() }}
        </div>
    </div>

    <!-- Modal Form -->
    @if($showingModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-6 bg-slate-900/40 backdrop-blur-sm animate-fade-in">
        <div class="w-full max-w-lg bg-white rounded-3xl shadow-2xl border border-white/60 overflow-hidden transform animate-scale-up">
            <div class="px-8 py-6 bg-slate-50/80 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-xl font-heading font-black text-slate-900">{{ $editingId ? 'Edit Mata Soal' : 'Tambah Mata Soal Baru' }}</h3>
                <button wire:click="closeModal" class="p-2 text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form wire:submit="save" class="p-8 space-y-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none">Nama Kategori / Mata Soal</label>
                    <input wire:model="name" type="text" placeholder="Contoh: Pemrograman Dasar" 
                        class="block w-full px-4 py-3.5 bg-slate-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-900 transition-all">
                    @error('name') <span class="text-rose-600 text-[10px] font-bold block">{{ $message }}</span> @enderror
                </div>

                <div class="pt-4 flex items-center justify-end space-x-3">
                    <button type="button" wire:click="closeModal" class="px-6 py-3 text-slate-500 font-bold text-sm hover:bg-slate-50 rounded-2xl transition-all">Batalkan</button>
                    <button type="submit" class="px-8 py-3 bg-slate-900 text-white rounded-2xl font-bold text-sm shadow-xl shadow-slate-900/20 hover:bg-primary-600 hover:shadow-primary-600/30 transition-all flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
