<x-layouts.app :title="$title ?? 'Pendaftaran Peserta'">
    <div class="min-h-screen bg-[#fafbfc] flex flex-col">
        <!-- Minimalist Header -->
        <header class="w-full h-24 px-8 lg:px-20 flex items-center justify-between bg-white border-b border-slate-100 shadow-sm relative z-50">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-primary-600 rounded-2xl flex items-center justify-center shadow-lg shadow-primary-600/40">
                    <span class="text-white font-black text-2xl">S</span>
                </div>
                <div>
                    <span class="font-heading font-black text-2xl tracking-tight text-slate-900 block leading-none">SIPPEKA</span>
                    <span class="text-[10px] font-black text-primary-600 uppercase tracking-widest mt-1 block">Sistem Pendaftaran v2.8</span>
                </div>
            </div>

            <div class="flex items-center space-x-6">
                <div class="hidden md:flex items-center space-x-3 px-4 py-2 bg-slate-50 rounded-xl border border-slate-100">
                    <div class="w-10 h-10 rounded-lg bg-white border border-slate-200 flex items-center justify-center overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=4f46e5&color=fff" alt="User">
                    </div>
                    <div class="text-left">
                        <p class="text-xs font-black text-slate-900 leading-none">{{ auth()->user()->name }}</p>
                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">Calon Peserta</p>
                    </div>
                </div>

                <form method="POST" action="#">
                    @csrf
                    <button type="submit" class="p-3 bg-white border border-slate-200 text-slate-400 hover:text-rose-500 hover:border-rose-100 hover:bg-rose-50 rounded-2xl transition-all shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 w-full max-w-7xl mx-auto p-6 md:p-12 lg:p-20 relative">
            <!-- Background Decorations -->
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-primary-100/30 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute bottom-0 right-0 w-80 h-80 bg-indigo-100/20 rounded-full blur-[100px] pointer-events-none"></div>

            <div class="relative z-10">
                {{ $slot }}
            </div>
        </main>

        <!-- Minimalist Footer -->
        <footer class="w-full py-10 px-8 text-center border-t border-slate-100 bg-white/50">
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em]">&copy; 2026 SIPPEKA Enterprise • Professional Training System</p>
        </footer>
    </div>
</x-layouts.app>
