<div class="space-y-10 pb-12">
    <!-- Header with Breadcrumbs & Actions -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <div class="flex items-center space-x-2 text-slate-400 text-sm mb-2 font-medium">
                <span>Pelatihan</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-primary-600">Admin Dashboard</span>
            </div>
            <h2 class="text-3xl font-heading font-extrabold text-slate-900 tracking-tight">
                Selamat Datang, <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary-600 to-indigo-500">Administrator</span> 👋
            </h2>
            <p class="text-slate-500 mt-1 font-medium italic">Pantau progres pendaftaran dan hasil seleksi peserta secara real-time.</p>
        </div>
        
        <div class="flex items-center space-x-3">
            <button class="px-5 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl font-bold text-sm shadow-sm hover:bg-slate-50 transition-all flex items-center space-x-2">
                <svg class="w-4 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span>Unduh Laporan</span>
            </button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Total Registrations Card -->
        <div class="relative group">
            <div class="absolute -inset-1 bg-gradient-to-r from-primary-600 to-indigo-500 rounded-3xl blur opacity-10 group-hover:opacity-20 transition duration-1000 group-hover:duration-200"></div>
            <div class="relative glass-card p-8 h-full flex flex-col justify-between overflow-hidden">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-primary-100/30 rounded-full blur-2xl"></div>
                <div class="flex items-start justify-between relative z-10">
                    <div>
                        <p class="text-xs font-bold text-primary-600 uppercase tracking-widest mb-1">Total Pendaftaran</p>
                        <h3 class="text-5xl font-heading font-extrabold text-slate-900 leading-tight tracking-tighter">{{ number_format($totalPendaftar) }}</h3>
                    </div>
                    <div class="w-14 h-14 bg-primary-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-primary-600/30 transition-transform group-hover:scale-110 duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    </div>
                </div>
                <div class="mt-8 flex items-center space-x-3 text-sm font-bold relative z-10">
                    <span class="flex items-center text-emerald-500 bg-emerald-50 px-3 py-1 rounded-full">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        12%
                    </span>
                    <span class="text-slate-400 font-medium italic">Sejak bulan lalu</span>
                </div>
            </div>
        </div>

        <!-- Success Rate Card -->
        <div class="relative group">
            <div class="absolute -inset-1 bg-gradient-to-r from-emerald-500 to-teal-400 rounded-3xl blur opacity-10 group-hover:opacity-20 transition duration-1000 group-hover:duration-200"></div>
            <div class="relative glass-card p-8 h-full flex flex-col justify-between overflow-hidden">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-emerald-100/30 rounded-full blur-2xl"></div>
                <div class="flex items-start justify-between relative z-10">
                    <div>
                        <p class="text-xs font-bold text-emerald-600 uppercase tracking-widest mb-1">Lolos Seleksi</p>
                        <h3 class="text-5xl font-heading font-extrabold text-slate-900 leading-tight tracking-tighter">{{ number_format($pendaftarLolos) }}</h3>
                    </div>
                    <div class="w-14 h-14 bg-emerald-500 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-emerald-500/30 transition-transform group-hover:scale-110 duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div class="mt-8 relative z-10">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Tingkat Kelulusan</span>
                        <span class="text-xs font-extrabold text-emerald-600">{{ number_format($progressLolos, 1) }}%</span>
                    </div>
                    <div class="h-3 w-full bg-slate-100 rounded-full overflow-hidden shadow-inner">
                        <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-400 rounded-full transition-all duration-1000 ease-out shadow-sm" style="width: {{ $progressLolos }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tables and Insights Section -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Main Table -->
        <div class="xl:col-span-2 space-y-4">
            <div class="flex items-end justify-between px-2">
                <h3 class="text-xl font-heading font-extrabold text-slate-900">Peserta Baru Terdaftar</h3>
                <a href="{{ route('admin.registration_list') }}" class="text-sm font-bold text-primary-600 hover:text-primary-700 underline decoration-2 underline-offset-4 decoration-primary-600/30 transition-all">Kelola Seluruh Peserta</a>
            </div>

            <div class="glass-card shadow-2xl shadow-slate-200/50 border-white/40 overflow-hidden">
                <div class="overflow-x-auto min-h-[400px]">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100/50">
                                <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] leading-none">Informasi Calon Peserta</th>
                                <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] leading-none text-center">Program Keahlian</th>
                                <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] leading-none text-center">Status Berkas</th>
                                <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] leading-none text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100/60">
                            @forelse($pendaftarBaru as $registrant)
                            <tr class="hover:bg-slate-50/50 transition-all duration-200 group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="relative">
                                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-500 to-indigo-600 text-white flex items-center justify-center font-bold text-xl shadow-lg shadow-primary-600/20 ring-4 ring-white">
                                                {{ substr($registrant->nama, 0, 1) }}
                                            </div>
                                            <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-white rounded-lg flex items-center justify-center shadow-sm">
                                                <div class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></div>
                                            </div>
                                        </div>
                                        <div class="max-w-[200px]">
                                            <p class="font-bold text-slate-900 group-hover:text-primary-600 transition-colors truncate">{{ $registrant->nama }}</p>
                                            <p class="text-xs text-slate-400 font-medium flex items-center mt-1">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                {{ $registrant->created_at->translatedFormat('d F Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="inline-flex px-4 py-1.5 bg-indigo-50 text-indigo-700 rounded-xl text-[11px] font-bold tracking-tight shadow-sm ring-1 ring-indigo-100">
                                        {{ $registrant->keahlian->nama ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span @class([
                                        'px-4 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-widest shadow-sm ring-1',
                                        'bg-emerald-50 text-emerald-700 ring-emerald-100' => $registrant->status === 'Lulus',
                                        'bg-rose-50 text-rose-700 ring-rose-100' => $registrant->status === 'Gagal',
                                        'bg-amber-50 text-amber-700 ring-amber-100' => $registrant->status === 'Sedang Diproses',
                                        'bg-slate-50 text-slate-500 ring-slate-100' => $registrant->status === 'Belum Mengikuti Tes',
                                    ])>
                                        {{ $registrant->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <button class="px-4 py-2 bg-slate-900 text-white rounded-xl text-xs font-bold shadow-lg hover:shadow-primary-600/30 hover:bg-primary-600 transition-all">Detail</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-24 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-6">
                                            <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                        </div>
                                        <p class="text-slate-400 font-bold italic tracking-wide">Belum ada pendaftar baru hari ini.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar Activity/Info -->
        <div class="space-y-8">
            <h3 class="text-xl font-heading font-extrabold text-slate-900 px-2">Info Pelatihan</h3>
            
            <div class="glass-card p-6 bg-primary-600 text-white shadow-xl shadow-primary-600/20 relative overflow-hidden">
                <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl"></div>
                <div class="relative z-10">
                    <h4 class="font-heading font-bold text-lg mb-2">Tingkatkan Efisiensi</h4>
                    <p class="text-sm opacity-80 leading-relaxed text-indigo-50 font-medium">Validasi berkas peserta lebih cepat dengan menggunakan dashboard modern ini.</p>
                    <button class="mt-6 px-5 py-2.5 bg-white text-primary-600 rounded-xl font-extrabold text-xs shadow-lg uppercase tracking-widest hover:bg-indigo-50 transition-all">Buka Panduan</button>
                </div>
            </div>

            <div class="glass-card p-6 border-slate-200/60 bg-white/40">
                <h4 class="font-bold text-slate-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Statistik Program
                </h4>
                <div class="space-y-6 mt-6">
                    <div class="flex items-center justify-between group">
                        <span class="text-sm font-bold text-slate-500 group-hover:text-slate-900 transition-colors">Program Dibuka</span>
                        <span class="px-3 py-1 bg-slate-100 rounded-lg text-xs font-extrabold text-slate-900">4</span>
                    </div>
                    <div class="flex items-center justify-between group">
                        <span class="text-sm font-bold text-slate-500 group-hover:text-slate-900 transition-colors">Sesi Aktif</span>
                        <span class="px-3 py-1 bg-primary-50 rounded-lg text-xs font-extrabold text-primary-600">2</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
