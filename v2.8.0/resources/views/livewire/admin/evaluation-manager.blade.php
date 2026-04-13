<div class="space-y-10 pb-12">
    <!-- Header Area -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-2">
            <h2 class="text-3xl font-heading font-extrabold text-slate-900 tracking-tight">Evaluasi & Penilaian Akhir</h2>
            <p class="text-slate-500 font-medium italic">Tentukan hasil akhir peserta dengan menginput nilai wawancara dan validasi tes.</p>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center space-x-2 font-bold text-sm shadow-sm animate-fade-in-down">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Filters Area -->
    <div class="glass-card p-6 flex flex-col lg:flex-row lg:items-center justify-between gap-6 bg-white/40 border-white/60">
        <div class="flex flex-col sm:flex-row sm:items-center gap-4 flex-1">
            <div class="relative flex-1 max-w-lg group">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-primary-600 transition-colors">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama peserta..." 
                    class="block w-full pl-12 pr-4 py-3.5 bg-white/60 border-slate-200/60 focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-medium transition-all shadow-sm">
            </div>

            <div class="w-full sm:w-64">
                <select wire:model.live="filterSkill" 
                    class="block w-full px-4 py-3.5 bg-white/60 border-slate-200/60 focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-700 transition-all shadow-sm appearance-none">
                    <option value="">Semua Program</option>
                    @foreach($skills as $skill)
                        <option value="{{ $skill->id }}">{{ $skill->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Evaluation Table -->
    <div class="glass-card shadow-2xl shadow-slate-200/60 overflow-hidden bg-white/60">
        <div class="overflow-x-auto min-h-[400px]">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100/50">
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em]">Data Peserta</th>
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-center">Nilai Seleksi</th>
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-center">Nilai Wawancara</th>
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-center">Rata-rata</th>
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-center">Status</th>
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80">
                    @forelse($registrations as $reg)
                    <tr class="hover:bg-primary-50/30 transition-all group">
                        <td class="px-8 py-6">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 font-black text-sm">
                                    {{ substr($reg->nama, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900 truncate max-w-[150px]">{{ $reg->nama }}</p>
                                    <p class="text-[9px] text-primary-600 font-black uppercase tracking-widest">{{ $reg->keahlian_rel->nama ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="text-sm font-black text-slate-600">{{ number_format($reg->nilai_keahlian, 1) }}</span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            @if($editingId === $reg->id)
                                <div class="flex items-center justify-center space-x-2 animate-scale-up">
                                    <input wire:model="tempNilaiWawancara" type="number" step="0.5" min="0" max="100" 
                                        class="w-20 px-3 py-2 bg-white border border-primary-500 rounded-xl text-xs font-black text-center focus:ring-4 focus:ring-primary-500/10 transition-all">
                                    <button wire:click="saveScore" class="p-2 bg-emerald-500 text-white rounded-lg shadow-lg shadow-emerald-500/20 hover:bg-emerald-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                    <button wire:click="cancelEdit" class="p-2 bg-slate-100 text-slate-400 rounded-lg hover:bg-slate-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                                @error('tempNilaiWawancara') <p class="text-[9px] text-rose-600 font-bold mt-1">{{ $message }}</p> @enderror
                            @else
                                <div class="group/score relative inline-block">
                                    <span @class([
                                        'text-sm font-black',
                                        'text-slate-900 underline decoration-dotted decoration-slate-300' => $reg->nilai_wawancara !== null,
                                        'text-slate-300 italic' => $reg->nilai_wawancara === null
                                    ])>
                                        {{ $reg->nilai_wawancara !== null ? number_format($reg->nilai_wawancara, 1) : 'N/A' }}
                                    </span>
                                    <button wire:click="editScore({{ $reg->id }})" class="ml-2 p-1.5 opacity-0 group-hover/score:opacity-100 transition-opacity text-primary-500 hover:bg-primary-50 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                </div>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-center">
                            @if($reg->average_score !== null)
                                <span class="text-sm font-black text-primary-600 bg-primary-50 px-3 py-1.5 rounded-xl border border-primary-100">
                                    {{ number_format($reg->average_score, 1) }}
                                </span>
                            @else
                                <span class="text-[10px] font-bold text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span @class([
                                'px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider ring-1',
                                'bg-emerald-50 text-emerald-700 ring-emerald-100' => $reg->status === 'Lulus',
                                'bg-rose-50 text-rose-700 ring-rose-100' => $reg->status === 'Gagal',
                                'bg-amber-50 text-amber-700 ring-amber-100' => $reg->status === 'Sedang Diproses',
                                'bg-slate-50 text-slate-400 ring-slate-100' => $reg->status === 'Belum Mengikuti Tes',
                            ])>
                                {{ $reg->status }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.reports.registration', $reg->id) }}" target="_blank" class="p-2.5 text-slate-400 hover:text-indigo-600 hover:bg-white rounded-xl hover:shadow-md transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 00-2 2h2m3 2h10a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 00-2 2h2m3 2h10m-10-4h10m-10-4h10"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-32 text-center text-slate-400 italic font-bold">Belum ada peserta yang menyelesaikan tes seleksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100/50">
            {{ $registrations->links() }}
        </div>
    </div>
</div>
