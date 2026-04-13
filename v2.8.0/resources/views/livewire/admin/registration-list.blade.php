<div class="space-y-10 pb-12">
    <!-- Header Area -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-2">
            <h2 class="text-3xl font-heading font-extrabold text-slate-900 tracking-tight">Data Peserta Pendaftar</h2>
            <p class="text-slate-500 font-medium italic">Kelola dan validasi seluruh calon peserta pelatihan SIPPEKA.</p>
        </div>
        
        <div class="flex items-center space-x-3">
            <button class="px-5 py-3 bg-primary-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-primary-600/20 hover:bg-primary-700 hover:-translate-y-0.5 transition-all flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Tambah Peserta</span>
            </button>
        </div>
    </div>

    <!-- Filters Area -->
    <div class="glass-card p-6 flex flex-col lg:flex-row lg:items-center justify-between gap-6 bg-white/40 border-white/60">
        <div class="flex flex-col sm:flex-row sm:items-center gap-4 flex-1">
            <div class="relative flex-1 max-w-lg group">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-primary-600 transition-colors">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari berdasarkan nama atau telepon..." 
                    class="block w-full pl-12 pr-4 py-3.5 bg-white/60 border-slate-200/60 focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-medium transition-all shadow-sm">
            </div>

            <div class="w-full sm:w-64">
                <select wire:model.live="filterSkill" 
                    class="block w-full px-4 py-3.5 bg-white/60 border-slate-200/60 focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-700 transition-all shadow-sm appearance-none">
                    <option value="">Semua Program Keahlian</option>
                    @foreach($skills as $skill)
                        <option value="{{ $skill->id }}">{{ $skill->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex items-center space-x-2">
            <button class="p-3.5 bg-white text-slate-400 hover:text-slate-600 rounded-2xl border border-slate-200/60 hover:bg-slate-50 transition-all shadow-sm" title="Refresh">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            </button>
            <button class="p-3.5 bg-white text-slate-400 hover:text-slate-600 rounded-2xl border border-slate-200/60 hover:bg-slate-50 transition-all shadow-sm" title="Filter Lanjut">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
            </button>
        </div>
    </div>

    <!-- Table Section -->
    <div class="glass-card shadow-2xl shadow-slate-200/60 overflow-hidden bg-white/60">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100/50">
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em]">Data Diri</th>
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-center">Program</th>
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-center">Skor Rata-rata</th>
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-center">Status Akhir</th>
                        <th class="px-8 py-4 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80">
                    @forelse($registrants as $registrant)
                    <tr class="hover:bg-primary-50/30 transition-all group">
                        <td class="px-8 py-6">
                            <div class="flex items-center space-x-5">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200 border-4 border-white shadow-sm flex items-center justify-center text-slate-500 font-extrabold text-xl group-hover:from-primary-500 group-hover:to-indigo-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-primary-600/20 transition-all duration-300">
                                    {{ substr($registrant->nama, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-extrabold text-slate-900 group-hover:text-primary-600 transition-colors tracking-tight">{{ $registrant->nama }}</p>
                                    <div class="flex items-center space-x-3 mt-1.5">
                                        <span class="text-[11px] text-slate-400 font-bold bg-slate-50 px-2 py-0.5 rounded-lg border border-slate-100">{{ $registrant->telepon }}</span>
                                        <span class="text-[11px] text-slate-400 font-medium italic underline decoration-slate-200">{{ $registrant->user->email ?? 'no email' }}</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <div class="inline-flex flex-col items-center">
                                <span class="px-4 py-1.5 bg-indigo-50 text-indigo-700 rounded-xl text-[10px] font-extrabold uppercase tracking-wide ring-1 ring-indigo-100">
                                    {{ $registrant->keahlian->nama ?? '-' }}
                                </span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <div class="flex flex-col items-center">
                                <span class="text-lg font-black text-slate-900 leading-none">{{ $registrant->average_score ?? '-' }}</span>
                                @if($registrant->average_score)
                                    <p class="text-[9px] font-bold text-slate-400 uppercase mt-1 tracking-tighter">Points</p>
                                @endif
                            </div>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span @class([
                                'px-4 py-2 rounded-2xl text-[10px] font-black uppercase tracking-[0.1em] shadow-sm ring-2 ring-white',
                                'bg-emerald-100 text-emerald-800' => $registrant->status === 'Lulus',
                                'bg-rose-100 text-rose-800' => $registrant->status === 'Gagal',
                                'bg-amber-100 text-amber-800' => $registrant->status === 'Sedang Diproses',
                                'bg-slate-100 text-slate-500' => $registrant->status === 'Belum Mengikuti Tes',
                            ])>
                                {{ $registrant->status }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end space-x-1">
                                <button class="p-2.5 text-slate-400 hover:text-primary-600 hover:bg-white rounded-xl hover:shadow-md transition-all" title="View Profile">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </button>
                                <button class="p-2.5 text-slate-400 hover:text-emerald-500 hover:bg-white rounded-xl hover:shadow-md transition-all" title="Fast Action">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                                <div class="w-px h-6 bg-slate-100 mx-1"></div>
                                <button class="p-2.5 text-slate-400 hover:text-rose-500 hover:bg-white rounded-xl hover:shadow-md transition-all" title="Remove">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-32 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-24 h-24 bg-slate-50 rounded-3xl flex items-center justify-center mb-6 shadow-inner ring-1 ring-slate-100">
                                    <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <h4 class="text-xl font-heading font-extrabold text-slate-900 mb-1">Data Tidak Ditemukan</h4>
                                <p class="text-slate-400 font-medium italic">Tidak ada peserta yang cocok dengan kriteria pencarian Anda.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100/50">
            {{ $registrants->links() }}
        </div>
    </div>
</div>
