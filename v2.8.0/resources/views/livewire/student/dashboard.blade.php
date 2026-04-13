<div class="space-y-12 pb-20">
    <!-- Welcome Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-8 animate-fade-in">
        <div class="space-y-2">
            <h2 class="text-4xl font-heading font-black text-slate-900 tracking-tight leading-tight">
                Halo, {{ explode(' ', $user->name)[0] }}! 👋
            </h2>
            <p class="text-slate-500 font-medium italic">Senang melihat Anda kembali. Pantau perkembangan pendaftaran dan tes Anda di sini.</p>
        </div>
        
        <div class="flex items-center space-x-4">
            <div class="p-4 bg-white rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100 flex items-center space-x-4">
                <div @class([
                    'w-12 h-12 rounded-2xl flex items-center justify-center font-black text-lg shadow-inner',
                    'bg-emerald-50 text-emerald-600' => $user->status_register === 'verified',
                    'bg-amber-50 text-amber-600' => $user->status_register === 'terdaftar' || $user->status_register === 'pending',
                ])>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <div>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none">Status Akun</p>
                    <p class="text-sm font-black text-slate-900 mt-1 uppercase">
                        {{ $user->status_register === 'verified' ? 'Terverifikasi' : 'Proses Verifikasi' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats & Info Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-fade-in-up">
        <!-- Training Program Card -->
        <div class="lg:col-span-2 glass-card p-10 bg-slate-900 text-white border-slate-800 shadow-2xl shadow-slate-900/20 overflow-hidden relative group">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary-600/20 rounded-full blur-[80px] -mr-32 -mt-32"></div>
            
            <div class="relative z-10 space-y-8">
                <div>
                    <span class="px-4 py-1.5 bg-primary-600/20 border border-primary-500/30 rounded-full text-[10px] font-black uppercase tracking-widest text-primary-400">Program Terpilih</span>
                    <h3 class="text-3xl font-heading font-black mt-4 leading-tight">
                        {{ $registration->keahlian_rel->nama ?? 'Program Belum Ditentukan' }}
                    </h3>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-6 pt-4">
                    <div class="space-y-1">
                        <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Metode</p>
                        <p class="text-xs font-bold text-slate-200">Pelatihan & Tes</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Durasi</p>
                        <p class="text-xs font-bold text-slate-200">12 - 24 Bulan</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Sertifikasi</p>
                        <p class="text-xs font-bold text-slate-200">Enterprise Grade</p>
                    </div>
                </div>
            </div>

            <div class="absolute bottom-0 right-0 p-10 opacity-10 group-hover:scale-110 transition-transform duration-700">
                <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L1 12h3v9h6v-6h4v6h6v-9h3L12 2z"/></svg>
            </div>
        </div>

        <!-- Progress Card -->
        <div class="glass-card p-10 bg-white border-white shadow-xl shadow-slate-200/40 font-bold">
            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-4">Tahapan Pendaftaran</h4>
            <div class="mt-8 space-y-8">
                <div class="flex items-center space-x-5">
                    <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center shadow-lg shadow-emerald-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="text-sm text-slate-900">Registrasi Berhasil</span>
                </div>
                <div class="flex items-center space-x-5">
                    <div @class([
                        'w-8 h-8 rounded-full flex items-center justify-center shadow-lg',
                        'bg-emerald-500 text-white shadow-emerald-500/20' => $user->status_register === 'verified',
                        'bg-slate-100 text-slate-300' => $user->status_register !== 'verified',
                    ])>
                        @if($user->status_register === 'verified')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        @else
                            <span class="text-xs">2</span>
                        @endif
                    </div>
                    <span @class(['text-sm', 'text-slate-900' => $user->status_register === 'verified', 'text-slate-400' => $user->status_register !== 'verified'])>Verifikasi Dokumen</span>
                </div>
                <div class="flex items-center space-x-5 opacity-40">
                    <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-300 flex items-center justify-center">
                        <span class="text-xs">3</span>
                    </div>
                    <span class="text-sm text-slate-400">Pelaksanaan Tes</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Sessions / Tests -->
    <div class="space-y-6 animate-fade-in-up delay-100">
        <h3 class="text-xl font-heading font-black text-slate-800 tracking-tight">Sesi Tes Tersedia</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($activeSessions as $session)
                <div class="glass-card p-8 bg-white/60 border-white hover:border-primary-200 transition-all group overflow-hidden relative">
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 bg-primary-50 text-primary-600 rounded-lg text-[9px] font-black uppercase tracking-widest border border-primary-100">
                                    {{ $session->jenis_sesi }}
                                </span>
                                <div class="flex items-center space-x-2 text-rose-500">
                                    <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span class="text-[10px] font-black uppercase tracking-widest">Aktif Sekarang</span>
                                </div>
                            </div>
                            <h4 class="text-xl font-black text-slate-900 group-hover:text-primary-600 transition-colors">{{ $session->test->nama_tes }}</h4>
                            <p class="text-xs text-slate-500 font-medium italic">Kategori: {{ $session->test->category->nama }}</p>
                        </div>

                        <div class="mt-8 flex items-center justify-between">
                            <div class="space-y-1">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Berakhir Dalam</p>
                                <p class="text-sm font-bold text-slate-700">
                                    {{ \Carbon\Carbon::parse($session->waktu_selesai)->diffForHumans() }}
                                </p>
                            </div>
                            
                            @if($user->status_register === 'verified')
                                <a href="{{ route('student.examination', ['sessionId' => $session->id]) }}" class="px-6 py-3 bg-slate-900 text-white rounded-2xl font-black text-[10px] uppercase tracking-[0.15em] shadow-xl shadow-slate-900/20 hover:bg-primary-600 hover:shadow-primary-600/30 hover:-translate-y-0.5 transition-all">
                                    Mulai Ujian
                                </a>
                            @else
                                <button disabled class="px-6 py-3 bg-slate-100 text-slate-400 rounded-2xl font-black text-[10px] uppercase tracking-[0.15em] cursor-not-allowed">
                                    Menunggu Verifikasi
                                </button>
                            @endif
                        </div>
                    </div>
                    
                    <div class="absolute -right-4 -bottom-4 w-32 h-32 bg-slate-50 rounded-full opacity-50 group-hover:scale-125 transition-transform duration-700"></div>
                </div>
            @empty
                <div class="md:col-span-2 glass-card py-20 bg-white/40 border-white border-dashed text-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="text-slate-400 font-bold italic">Belum ada sesi tes yang aktif untuk program Anda.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
