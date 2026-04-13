<div class="fixed inset-0 bg-[#fafbfc] z-50 overflow-hidden flex flex-col font-sans">
    <!-- Exam Header -->
    <header class="h-24 bg-white border-b border-slate-100 px-8 lg:px-20 flex items-center justify-between shadow-sm flex-shrink-0 relative z-20">
        <div class="flex items-center space-x-6">
            <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center shadow-lg">
                <span class="text-white font-black text-xl">U</span>
            </div>
            <div>
                <h2 class="text-lg font-black text-slate-900 leading-none">{{ $session->test->nama_tes }}</h2>
                <p class="text-[10px] font-black text-primary-600 uppercase tracking-widest mt-1.5">{{ $session->jenis_sesi }} • {{ $questions->count() }} Pertanyaan</p>
            </div>
        </div>

        <div class="flex items-center space-x-10">
            <!-- Timer -->
            <div class="hidden md:flex items-center space-x-4 px-6 py-3 bg-rose-50 border border-rose-100 rounded-2xl" 
                 x-data="{ 
                    timer: {{ $remainingSeconds }},
                    formatTime(s) {
                        const h = Math.floor(s / 3600);
                        const m = Math.floor((s % 3600) / 60);
                        const sec = s % 60;
                        return `${h > 0 ? h + ':' : ''}${m.toString().padStart(2, '0')}:${sec.toString().padStart(2, '0')}`;
                    }
                 }"
                 x-init="setInterval(() => { if(timer > 0) timer--; else $wire.submit(); }, 1000)">
                <div class="w-8 h-8 rounded-lg bg-rose-500 flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-[9px] font-black text-rose-400 uppercase tracking-widest leading-none">Sisa Waktu</p>
                    <p class="text-lg font-black text-rose-600 mt-0.5" x-text="formatTime(timer)"></p>
                </div>
            </div>

            <button onclick="confirm('Selesaikan ujian sekarang?') && @this.submit()" class="px-8 py-4 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-slate-900/20 hover:bg-emerald-600 hover:shadow-emerald-600/30 transition-all">
                Selesai Ujian
            </button>
        </div>
    </header>

    <div class="flex-1 flex overflow-hidden">
        @if(!$isFinished)
            <!-- Sidebar: Question Navigation -->
            <aside class="w-80 bg-white border-r border-slate-100 flex-shrink-0 hidden lg:flex flex-col relative z-10">
                <div class="p-8 border-b border-slate-50">
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Navigasi Soal</h3>
                </div>
                <div class="flex-1 overflow-y-auto p-8 custom-scrollbar">
                    <div class="grid grid-cols-4 gap-3">
                        @foreach($questions as $index => $q)
                            <button wire:click="goTo({{ $index }})" @class([
                                'w-full aspect-square rounded-xl text-xs font-black transition-all flex items-center justify-center border-2',
                                'bg-slate-900 text-white border-slate-900 shadow-lg' => $currentIndex === $index,
                                'bg-emerald-50 text-emerald-600 border-emerald-100' => $currentIndex !== $index && $userAnswers[$q->id] !== null,
                                'bg-slate-50 text-slate-400 border-slate-50 hover:border-slate-200' => $currentIndex !== $index && $userAnswers[$q->id] === null,
                            ])>
                                {{ $index + 1 }}
                            </button>
                        @endforeach
                    </div>
                </div>
                <div class="p-8 bg-slate-50/50 border-t border-slate-100">
                    <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest">
                        <div class="flex items-center space-x-2">
                            <span class="w-3 h-3 bg-emerald-500 rounded-full"></span>
                            <span class="text-slate-500">Dijawab</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="w-3 h-3 bg-slate-200 rounded-full"></span>
                            <span class="text-slate-500">Belum</span>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content: Current Question -->
            <main class="flex-1 overflow-y-auto bg-slate-50/30 relative">
                <div class="max-w-4xl mx-auto py-16 px-8 lg:px-12 space-y-12 animate-fade-in">
                    <!-- Question Title -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <span class="px-4 py-1.5 bg-slate-900 text-white rounded-xl text-xs font-black">Soal {{ $currentIndex + 1 }}</span>
                        </div>
                        <h1 class="text-2xl font-bold text-slate-900 leading-relaxed font-heading">
                            {{ $questions[$currentIndex]->soal }}
                        </h1>
                    </div>

                    <!-- Options -->
                    <div class="grid grid-cols-1 gap-4">
                        @foreach($questions[$currentIndex]->shuffled_options as $key => $val)
                            <button wire:click="selectAnswer({{ $questions[$currentIndex]->id }}, '{{ $key }}')" @class([
                                'w-full p-6 lg:p-8 rounded-[32px] border-2 text-left transition-all duration-300 flex items-start space-x-6 relative overflow-hidden group',
                                'bg-white border-primary-600 ring-4 ring-primary-500/5 shadow-xl' => $userAnswers[$questions[$currentIndex]->id] === $key,
                                'bg-white border-slate-100 shadow-sm hover:border-slate-200 hover:bg-slate-50/50' => $userAnswers[$questions[$currentIndex]->id] !== $key
                            ])>
                                <div @class([
                                    'w-10 h-10 rounded-xl flex items-center justify-center font-black text-sm uppercase flex-shrink-0 transition-colors',
                                    'bg-primary-600 text-white shadow-lg' => $userAnswers[$questions[$currentIndex]->id] === $key,
                                    'bg-slate-100 text-slate-400 group-hover:bg-slate-200 group-hover:text-slate-600' => $userAnswers[$questions[$currentIndex]->id] !== $key
                                ])>
                                    {{ $key }}
                                </div>
                                <span @class([
                                    'text-lg font-bold transition-colors mt-1.5',
                                    'text-primary-900' => $userAnswers[$questions[$currentIndex]->id] === $key,
                                    'text-slate-600 group-hover:text-slate-900' => $userAnswers[$questions[$currentIndex]->id] !== $key
                                ])>
                                    {{ $val }}
                                </span>

                                @if($userAnswers[$questions[$currentIndex]->id] === $key)
                                    <div class="absolute top-0 right-0 p-8 opacity-10">
                                        <svg class="w-16 h-16 text-primary-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                                    </div>
                                @endif
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Bottom Navigation -->
                <div class="sticky bottom-0 w-full bg-white border-t border-slate-100 p-8 flex items-center justify-between">
                    <button wire:click="goTo({{ $currentIndex - 1 }})" @if($currentIndex === 0) disabled @endif @class(['px-8 py-4 rounded-2xl font-bold text-sm transition-all flex items-center space-x-2', 'text-slate-300 bg-slate-50 cursor-not-allowed' => $currentIndex === 0, 'text-slate-600 bg-white border border-slate-200 hover:shadow-lg' => $currentIndex > 0])>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        <span>Sebelumnya</span>
                    </button>

                    <div class="lg:hidden text-xs font-black text-slate-400 uppercase tracking-widest">
                        Soal {{ $currentIndex + 1 }} dari {{ $questions->count() }}
                    </div>

                    @if($currentIndex < $questions->count() - 1)
                        <button wire:click="goTo({{ $currentIndex + 1 }})" class="px-10 py-4 bg-slate-900 text-white rounded-2xl font-bold text-sm shadow-xl shadow-slate-900/20 hover:bg-primary-600 hover:shadow-primary-600/30 transition-all flex items-center space-x-2">
                            <span>Selanjutnya</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    @else
                        <button wire:click="submit" class="px-10 py-4 bg-emerald-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-emerald-500/30 hover:bg-emerald-700 transition-all flex items-center space-x-2">
                            <span>Konfirmasi & Selesai</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </button>
                    @endif
                </div>
            </main>
        @else
            <!-- Practice Result Summary -->
            <main class="flex-1 overflow-y-auto bg-slate-50/30 relative flex items-center justify-center p-8">
                <div class="max-w-xl w-full glass-card p-12 bg-white text-center space-y-10 animate-scale-up">
                    <div class="space-y-4">
                        <div class="w-24 h-24 bg-primary-50 rounded-full flex items-center justify-center mx-auto text-primary-600">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h2 class="text-3xl font-heading font-black text-slate-900">Simulasi Selesai!</h2>
                        <p class="text-slate-500 font-medium italic">Bagus! Anda telah menyelesaikan sesi latihan ujian.</p>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Skor Anda</p>
                            <p class="text-4xl font-black text-primary-600">{{ number_format($scorePercentage, 0) }}</p>
                        </div>
                        <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Status Latihan</p>
                            <p @class(['text-lg font-black', 'text-emerald-600' => $scorePercentage >= 70, 'text-rose-600' => $scorePercentage < 70])>
                                {{ $scorePercentage >= 70 ? 'LULUS' : 'GAGAL' }}
                            </p>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button wire:click="exit" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-slate-900/20 hover:bg-primary-600 transition-all">
                            Kembali ke Dashboard
                        </button>
                    </div>
                </div>
            </main>
        @endif
    </div>
</div>
