<x-layouts.app :title="$title ?? 'Admin Dashboard'">
    <div class="flex h-screen overflow-hidden bg-[#fafbfc]">
        <!-- Sidebar -->
        <aside class="w-80 bg-slate-900 h-full hidden md:flex flex-col z-20 relative shadow-2xl">
            <div class="absolute inset-0 bg-gradient-to-b from-primary-600/5 to-transparent pointer-events-none"></div>
            
            <div class="p-10 relative z-10">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-primary-600 rounded-2xl flex items-center justify-center shadow-lg shadow-primary-600/40 ring-4 ring-primary-500/20">
                        <span class="text-white font-black text-2xl">S</span>
                    </div>
                    <div>
                        <span class="font-heading font-black text-2xl tracking-tight text-white block leading-none">SIPPEKA</span>
                        <span class="text-[10px] font-black text-primary-500 uppercase tracking-widest mt-1 block">Enterprise v2.8</span>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-6 space-y-2 overflow-y-auto relative z-10 custom-scrollbar">
                <div class="pb-6 pt-4">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] px-4 mb-4">Main Experience</p>
                    <a href="{{ route('admin.dashboard') }}" @class([
                        'flex items-center space-x-4 px-4 py-4 rounded-2xl transition-all duration-300 group',
                        'bg-primary-600 text-white shadow-lg shadow-primary-600/20' => request()->routeIs('admin.dashboard'),
                        'text-slate-400 hover:text-white hover:bg-slate-800' => !request()->routeIs('admin.dashboard'),
                    ])>
                        <span @class([
                            'w-10 h-10 rounded-xl flex items-center justify-center transition-all',
                            'bg-white/10 shadow-inner' => request()->routeIs('admin.dashboard'),
                            'bg-slate-800 group-hover:bg-slate-700' => !request()->routeIs('admin.dashboard'),
                        ])>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </span>
                        <span class="font-bold text-sm tracking-tight">Dashboard</span>
                    </a>
                    
                    <a href="{{ route('admin.registration_list') }}" @class([
                        'flex items-center space-x-4 px-4 py-4 rounded-2xl transition-all duration-300 group mt-2',
                        'bg-primary-600 text-white shadow-lg shadow-primary-600/20' => request()->routeIs('admin.registration_list'),
                        'text-slate-400 hover:text-white hover:bg-slate-800' => !request()->routeIs('admin.registration_list'),
                    ])>
                        <span @class([
                            'w-10 h-10 rounded-xl flex items-center justify-center transition-all',
                            'bg-white/10 shadow-inner' => request()->routeIs('admin.registration_list'),
                            'bg-slate-800 group-hover:bg-slate-700' => !request()->routeIs('admin.registration_list'),
                        ])>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </span>
                        <span class="font-bold text-sm tracking-tight">Pendaftar</span>
                    </a>
                </div>

                <div class="pb-6 pt-4">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] px-4 mb-4">Academic & Tests</p>
                    
                    <a href="{{ route('admin.question_title_manager') }}" @class([
                        'flex items-center space-x-4 px-4 py-4 rounded-2xl transition-all duration-300 group',
                        'bg-primary-600 text-white shadow-lg shadow-primary-600/20' => request()->routeIs('admin.question_title_manager'),
                        'text-slate-400 hover:text-white hover:bg-slate-800' => !request()->routeIs('admin.question_title_manager'),
                    ])>
                        <span @class([
                            'w-10 h-10 rounded-xl flex items-center justify-center transition-all',
                            'bg-white/10 shadow-inner' => request()->routeIs('admin.question_title_manager'),
                            'bg-slate-800 group-hover:bg-slate-700' => !request()->routeIs('admin.question_title_manager'),
                        ])>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </span>
                        <span class="font-bold text-sm tracking-tight">Mata Soal</span>
                    </a>

                    <a href="{{ route('admin.skill_test_manager') }}" @class([
                        'flex items-center space-x-4 px-4 py-4 rounded-2xl transition-all duration-300 group mt-2',
                        'bg-primary-600 text-white shadow-lg shadow-primary-600/20' => request()->routeIs('admin.skill_test_manager') || request()->routeIs('admin.question_manager'),
                        'text-slate-400 hover:text-white hover:bg-slate-800' => !(request()->routeIs('admin.skill_test_manager') || request()->routeIs('admin.question_manager')),
                    ])>
                        <span @class([
                            'w-10 h-10 rounded-xl flex items-center justify-center transition-all',
                            'bg-white/10 shadow-inner' => request()->routeIs('admin.skill_test_manager') || request()->routeIs('admin.question_manager'),
                            'bg-slate-800 group-hover:bg-slate-700' => !(request()->routeIs('admin.skill_test_manager') || request()->routeIs('admin.question_manager')),
                        ])>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </span>
                        <span class="font-bold text-sm tracking-tight">Tes Keahlian</span>
                    </a>

                    <a href="{{ route('admin.evaluation_manager') }}" @class([
                        'flex items-center space-x-4 px-4 py-4 rounded-2xl transition-all duration-300 group mt-2',
                        'bg-primary-600 text-white shadow-lg shadow-primary-600/20' => request()->routeIs('admin.evaluation_manager'),
                        'text-slate-400 hover:text-white hover:bg-slate-800' => !request()->routeIs('admin.evaluation_manager'),
                    ])>
                        <span @class([
                            'w-10 h-10 rounded-xl flex items-center justify-center transition-all',
                            'bg-white/10 shadow-inner' => request()->routeIs('admin.evaluation_manager'),
                            'bg-slate-800 group-hover:bg-slate-700' => !request()->routeIs('admin.evaluation_manager'),
                        ])>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        </span>
                        <span class="font-bold text-sm tracking-tight">Evaluasi & Nilai</span>
                    </a>
                </div>

                <div class="pb-6 pt-4">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] px-4 mb-4">Core Settings</p>
                    <a href="{{ route('admin.user_manager') }}" @class([
                        'flex items-center space-x-4 px-4 py-4 rounded-2xl transition-all duration-300 group',
                        'bg-primary-600 text-white shadow-lg shadow-primary-600/20' => request()->routeIs('admin.user_manager'),
                        'text-slate-400 hover:text-white hover:bg-slate-800' => !request()->routeIs('admin.user_manager'),
                    ])>
                        <span @class([
                            'w-10 h-10 rounded-xl flex items-center justify-center transition-all',
                            'bg-white/10 shadow-inner' => request()->routeIs('admin.user_manager'),
                            'bg-slate-800 group-hover:bg-slate-700' => !request()->routeIs('admin.user_manager'),
                        ])>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </span>
                        <span class="font-bold text-sm tracking-tight">Akun User</span>
                    </a>
                </div>
            </nav>

            <div class="px-8 py-10 relative z-10 border-t border-slate-800">
                <div class="flex items-center space-x-4 bg-slate-800/40 p-4 rounded-2xl border border-white/5">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name=Admin+Sippeka&background=4f46e5&color=fff" class="w-12 h-12 rounded-xl shadow-lg ring-2 ring-primary-500/20" alt="Admin">
                    </div>
                    <div class="overflow-hidden">
                        <p class="font-black text-white leading-tight text-sm truncate">Super Admin</p>
                        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wider mt-0.5">Control Center</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 h-screen overflow-y-auto relative bg-[#fafbfc] border-l border-slate-100">
            <header class="sticky top-0 z-10 w-full h-24 px-12 flex items-center justify-between bg-white/70 backdrop-blur-xl border-b border-slate-100/50">
                <h1 class="text-xl font-heading font-black text-slate-900 tracking-tight">{{ $header ?? '' }}</h1>
                
                <div class="flex items-center space-x-8">
                    <div class="hidden lg:flex items-center px-4 py-2 bg-slate-50 rounded-xl border border-slate-100 space-x-3">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                        <span class="text-xs font-bold text-slate-500">System Online</span>
                    </div>

                    <div class="h-10 w-px bg-slate-100"></div>

                    <div class="flex items-center space-x-5">
                        <button class="w-12 h-12 rounded-2xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-primary-600 hover:border-primary-200 hover:shadow-lg transition-all relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        </button>

                        <form action="#" method="POST">
                            @csrf
                            <button type="submit" class="w-12 h-12 rounded-2xl bg-slate-900 text-white shadow-xl shadow-slate-900/30 flex items-center justify-center hover:bg-primary-600 hover:shadow-primary-600/30 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <div class="p-12 pb-24 max-w-[1600px] mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>
</x-layouts.app>
