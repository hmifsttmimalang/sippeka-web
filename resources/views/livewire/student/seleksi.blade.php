<div @class([
    'min-h-screen font-sans transition-colors duration-700 selection:bg-indigo-100 selection:text-indigo-900 overflow-x-hidden',
    'bg-[#F8F9FF]' => $session->jenis_sesi === 'Seleksi',
    'bg-[#899bbd]' => $session->jenis_sesi === 'Simulasi'
])>
    <style>
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes headerSlide { from { transform: translateY(-100%); } to { transform: translateY(0); } }
        @keyframes successPop { 0% { transform: scale(1); } 50% { transform: scale(1.05); } 100% { transform: scale(1); } }
        
        .animate-fade-in { animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .animate-header { animation: headerSlide 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .success-pop { animation: successPop 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); }
        
        .premium-glass { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(16px); border-bottom: 1px border-slate-200/50; }
        .premium-card { border-radius: 32px; border: none; background: rgba(255, 255, 255, 0.98); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.03); }
        .nav-btn { transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
        .option-btn { transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1); }
        
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.08); border-radius: 10px; }
    </style>

    <!-- Persistence Indicator (Floating) -->
    <div class="fixed bottom-6 left-6 z-[100] animate-fade-in" style="animation-delay: 1s">
        <div class="px-4 py-2 bg-slate-900/90 backdrop-blur text-white rounded-full text-[10px] font-black uppercase tracking-widest flex items-center space-x-2 shadow-2xl">
            <div class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></div>
            <span>Auto-Save Active</span>
        </div>
    </div>

    <!-- Top Glow Progress Bar -->
    <div class="h-1.5 w-full bg-slate-100 fixed top-0 left-0 z-[100] overflow-hidden">
        <div class="h-full bg-gradient-to-r from-indigo-500 via-indigo-600 to-violet-600 transition-all duration-1000 ease-out shadow-[0_0_15px_rgba(99,102,241,0.5)]" 
             style="width: {{ $progress }}%"></div>
    </div>

    @if(!$isFinished)
        <!-- Premium HUD Header -->
        <header class="sticky top-0 z-50 h-20 premium-glass px-6 lg:px-12 flex items-center justify-between animate-header">
            <div class="flex items-center space-x-5">
                <div class="w-12 h-12 bg-slate-900 rounded-[18px] flex items-center justify-center shadow-2xl shadow-slate-300 transform hover:rotate-6 transition-transform cursor-pointer">
                    <span class="text-white font-black font-outfit text-2xl italic leading-none">S</span>
                </div>
                <div class="hidden sm:block">
                    <h2 class="text-lg font-black text-slate-900 tracking-tight font-outfit uppercase leading-tight">{{ $session->test->nama_tes }}</h2>
                    <div class="flex items-center space-x-3 mt-1">
                        <span class="px-2.5 py-0.5 bg-indigo-600 text-[9px] font-black text-white rounded-md tracking-wider uppercase shadow-sm">
                            {{ $session->jenis_sesi }}
                        </span>
                        <div class="flex items-center space-x-1.5">
                            <i class="bi bi-tag-fill text-[10px] text-slate-300"></i>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Bidang {{ $session->test->category->nama ?? 'Umum' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modern Timer HUD -->
            <div class="flex items-center space-x-6"
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
                <div @class([
                    'flex items-center space-x-5 px-6 py-2.5 rounded-2xl border transition-all duration-700',
                    'bg-white/50 border-white/40 shadow-sm' => $remainingSeconds >= 300,
                    'bg-rose-50 border-rose-200 text-rose-600 shadow-xl shadow-rose-100' => $remainingSeconds < 300
                ])>
                    <div class="flex flex-col text-right">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1.5 italic">Time Left</p>
                        <p class="text-xl font-black font-outfit tabular-nums tracking-tighter leading-none" x-text="formatTime(timer)"></p>
                    </div>
                    <div @class([
                        'w-10 h-10 rounded-xl flex items-center justify-center text-white text-lg transition-colors',
                        'bg-slate-900' => $remainingSeconds >= 300,
                        'bg-rose-500 animate-pulse' => $remainingSeconds < 300
                    ])>
                        <i class="bi bi-clock-fill"></i>
                    </div>
                </div>
                
                <div class="hidden lg:flex flex-col items-end">
                    <span class="text-[9px] font-black text-slate-300 uppercase tracking-[0.2em] mb-1">Participant</span>
                    <div class="flex items-center space-x-3">
                        <span class="text-xs font-black text-slate-900 font-outfit uppercase tracking-tight">{{ auth()->user()->name }}</span>
                        <div class="w-8 h-8 rounded-full bg-indigo-100 border-2 border-white flex items-center justify-center text-[10px] font-bold text-indigo-600 shadow-sm">
                            {{ substr(auth()->user()->name, 0, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container py-8 lg:py-14">
            <div class="row g-5">
                <!-- Question Area (Left) -->
                <div class="col-lg-8">
                    <div class="card premium-card animate-fade-in">
                        <div class="card-body p-8 lg:p-14">
                            <div class="flex items-center space-x-4 mb-12">
                                <span class="bg-indigo-600/5 text-indigo-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] border border-indigo-100/50">
                                    Pertanyaan {{ $currentIndex + 1 }} dari {{ $questions->count() }}
                                </span>
                                <div class="h-px flex-1 bg-slate-50"></div>
                            </div>

                            <div class="min-h-[250px]">
                                <h1 class="text-2xl lg:text-4xl font-black text-slate-900 leading-[1.35] font-outfit tracking-tight mb-16 px-2">
                                    {{ $questions[$currentIndex]->soal }}
                                </h1>

                                <!-- Options Container -->
                                <div class="grid grid-cols-1 gap-5">
                                    @php 
                                        $currentId = $questions[$currentIndex]->id;
                                        $options = $shuffledOptions[$currentId] ?? [];
                                    @endphp
                                    @foreach($options as $key => $val)
                                        <button wire:click="selectAnswer({{ $currentId }}, '{{ $key }}')" 
                                                @class([
                                                    'option-btn w-full p-6 sm:p-8 rounded-[36px] border-2 text-left flex items-center space-x-6 relative group overflow-hidden',
                                                    'bg-white border-indigo-600 shadow-2xl shadow-indigo-100/60 ring-8 ring-indigo-500/5 success-pop' => $userAnswers[$currentId] === $key,
                                                    'bg-white border-slate-100 hover:border-indigo-200 hover:bg-slate-50/30' => $userAnswers[$currentId] !== $key
                                                ])>
                                            <div @class([
                                                'w-12 h-12 rounded-2xl flex items-center justify-center font-black text-base uppercase flex-shrink-0 transition-all duration-500',
                                                'bg-indigo-600 text-white shadow-xl shadow-indigo-200 md:rotate-6' => $userAnswers[$currentId] === $key,
                                                'bg-slate-100 text-slate-400 group-hover:bg-indigo-50 group-hover:text-indigo-600' => $userAnswers[$currentId] !== $key
                                            ])>
                                                {{ $key }}
                                            </div>
                                            <span @class([
                                                'text-lg lg:text-xl font-bold transition-all duration-300 font-outfit',
                                                'text-slate-900 translate-x-1' => $userAnswers[$currentId] === $key,
                                                'text-slate-600 group-hover:text-slate-900' => $userAnswers[$currentId] !== $key
                                            ])>
                                                {{ $val }}
                                            </span>

                                            @if($userAnswers[$currentId] === $key)
                                                <div class="absolute right-12 top-1/2 -translate-y-1/2 text-indigo-100/40 pointer-events-none transition-all duration-700">
                                                    <i class="bi bi-check-circle-fill text-7xl"></i>
                                                </div>
                                            @endif
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mt-20 pt-10 border-t border-slate-50 flex flex-col sm:flex-row items-center justify-between gap-6">
                                <button wire:click="goTo({{ $currentIndex - 1 }})" 
                                        @if($currentIndex === 0) disabled @endif 
                                        class="w-full sm:w-auto flex items-center justify-center space-x-3 px-10 py-4 bg-white border border-slate-200 rounded-3xl text-slate-500 font-black text-[11px] uppercase tracking-widest transition-all hover:bg-slate-50 hover:shadow-xl disabled:opacity-20 active:scale-95">
                                    <i class="bi bi-chevron-left text-lg"></i>
                                    <span>Sebelumnya</span>
                                </button>
                                
                                <div class="hidden md:flex items-center space-x-1.5">
                                    @php
                                        $start = max(0, $currentIndex - 4);
                                        $end = min($questions->count() - 1, $start + 9);
                                        if($end - $start < 9) $start = max(0, $end - 9);
                                    @endphp
                                    @for($i = $start; $i <= $end; $i++)
                                        <div @class(['h-2.5 rounded-full transition-all duration-700', $currentIndex === $i ? 'w-10 bg-indigo-600 shadow-[0_0_10px_rgba(79,70,229,0.3)]' : 'w-2.5 bg-slate-100'])></div>
                                    @endfor
                                </div>

                                <button wire:click="goTo({{ $currentIndex + 1 }})" 
                                        @if($currentIndex >= $questions->count() - 1) disabled @endif 
                                        class="w-full sm:w-auto flex items-center justify-center space-x-3 px-10 py-4 bg-slate-900 text-white rounded-3xl font-black text-[11px] uppercase tracking-widest shadow-2xl shadow-slate-200 transition-all hover:bg-indigo-600 active:scale-95 disabled:opacity-0 pointer-events-none:disabled">
                                    <span>Selanjutnya</span>
                                    <i class="bi bi-chevron-right text-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Sidebar (Right) -->
                <div class="col-lg-4">
                    <div class="space-y-6 lg:sticky lg:top-32 animate-fade-in" style="animation-delay: 0.15s">
                        <div class="card premium-card overflow-hidden">
                            <div class="p-8 bg-slate-900 relative overflow-hidden">
                                <div class="absolute top-0 right-0 p-4 opacity-10">
                                    <i class="bi bi-grid-3x3-gap text-7xl text-white"></i>
                                </div>
                                <h3 class="text-[10px] font-black text-white/50 uppercase tracking-[0.3em] leading-none m-0 mb-2">Navigator</h3>
                                <div class="flex items-end justify-between">
                                    <h4 class="text-2xl font-black text-white font-outfit m-0">Question Grid</h4>
                                    <div class="text-right">
                                        <span class="text-[10px] font-black text-emerald-400 uppercase tracking-widest">{{ $progress }}% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-8">
                                <div class="grid grid-cols-5 gap-3.5 max-h-[450px] overflow-y-auto pr-1 custom-scrollbar">
                                    @foreach($questions as $index => $q)
                                        <button wire:click="goTo({{ $index }})" 
                                                @class([
                                                    'nav-btn aspect-square rounded-[18px] text-[13px] font-black transition-all flex items-center justify-center border-2',
                                                    'bg-indigo-600 text-white border-indigo-600 shadow-2xl shadow-indigo-200 z-10 scale-110' => $currentIndex === $index,
                                                    'bg-emerald-50 text-emerald-600 border-emerald-100 shadow-sm' => $currentIndex !== $index && $userAnswers[$q->id] !== null,
                                                    'bg-slate-50/50 text-slate-300 border-slate-100 hover:border-slate-300 hover:text-slate-500' => $currentIndex !== $index && $userAnswers[$q->id] === null,
                                                ])>
                                            {{ $index + 1 }}
                                        </button>
                                    @endforeach
                                </div>

                                <div class="mt-10 pt-8 border-t border-slate-50 grid grid-cols-3 gap-2 text-center text-[8px] font-black uppercase tracking-widest text-slate-400">
                                    <div>
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full mx-auto mb-2"></div>
                                        <span>Answered</span>
                                    </div>
                                    <div>
                                        <div class="w-2 h-2 bg-indigo-500 rounded-full mx-auto mb-2"></div>
                                        <span>Active</span>
                                    </div>
                                    <div>
                                        <div class="w-2 h-2 bg-slate-200 rounded-full mx-auto mb-2"></div>
                                        <span>Empty</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Card -->
                        <div class="card premium-card p-8 bg-gradient-to-br from-white to-rose-50/30 border border-rose-100/50">
                             <div class="mb-5 text-center">
                                <p class="text-[10px] font-black text-rose-400 uppercase tracking-wider mb-1">Sudah Selesai?</p>
                                <p class="text-xs font-medium text-slate-500 italic">Pastikan semua kolom terjawab.</p>
                             </div>
                             <button onclick="confirm('Semua jawaban akan disimpan secara permanen. Akhiri sesi sekarang?') && @this.submit()" 
                                     class="w-full py-5 bg-rose-600 text-white rounded-[24px] font-black text-xs uppercase tracking-[0.2em] shadow-2xl shadow-rose-200 hover:bg-rose-700 hover:shadow-rose-300 transform active:scale-95 transition-all flex items-center justify-center space-x-3">
                                 <i class="bi bi-check-all text-xl"></i>
                                 <span>Akhiri Ujian</span>
                             </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Premium Result Summary -->
        <div class="container py-16 lg:py-24 min-h-screen flex items-center justify-center animate-fade-in px-4">
             <div class="max-w-4xl w-full bg-white rounded-[60px] shadow-2xl p-10 lg:p-24 text-center relative overflow-hidden border border-slate-50">
                <div class="absolute top-0 right-0 p-16 opacity-[0.05] pointer-events-none">
                    <i class="bi bi-award-fill text-[160px] text-slate-900 rotate-12"></i>
                </div>

                <div class="space-y-12 relative z-10">
                    <div @class([
                            'w-32 h-32 rounded-[40px] flex items-center justify-center mx-auto text-white shadow-2xl transform rotate-6 scale-110',
                            'bg-gradient-to-br from-emerald-500 to-teal-700 shadow-emerald-200' => $scorePercentage >= 70,
                            'bg-gradient-to-br from-rose-500 to-pink-700 shadow-rose-200' => $scorePercentage < 70
                        ])>
                        <i @class(['bi', 'bi-trophy-fill text-6xl' => $scorePercentage >= 70, 'bi-exclamation-octagon-fill text-6xl' => $scorePercentage < 70])></i>
                    </div>
                    
                    <div class="space-y-4">
                        <h2 class="text-4xl lg:text-5xl font-black text-slate-900 font-outfit uppercase tracking-tighter leading-none">Examination Report</h2>
                        <div class="flex items-center justify-center space-x-3 text-slate-400 font-bold uppercase tracking-widest text-[10px]">
                            <span>Sesi {{ $session->jenis_sesi }}</span>
                            <span class="w-1.5 h-1.5 bg-slate-200 rounded-full"></span>
                            <span>{{ $session->test->nama_tes }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-8 py-4">
                        <div class="px-14 py-10 bg-slate-50/50 rounded-[48px] border border-slate-100/50 backdrop-blur shadow-sm min-w-[220px] transition-transform hover:scale-105">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1.5 italic">Final Score</span>
                            <span class="text-7xl font-black text-slate-900 font-outfit tracking-tighter leading-none">{{ number_format($scorePercentage, 0) }}<span class="text-3xl text-slate-300 ml-1">%</span></span>
                        </div>
                        <div class="px-14 py-10 bg-slate-50/50 rounded-[48px] border border-slate-100/50 backdrop-blur shadow-sm min-w-[220px] transition-transform hover:scale-105">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1.5 italic">Status</span>
                            <span @class(['text-4xl font-black font-outfit uppercase tracking-tighter', 'text-emerald-600' => $scorePercentage >= 70, 'text-rose-600' => $scorePercentage < 70])>
                                {{ $scorePercentage >= 70 ? 'Passed' : 'Not Passed' }}
                            </span>
                            <div @class(['h-1 w-full mt-3 rounded-full', 'bg-emerald-500' => $scorePercentage >= 70, 'bg-rose-500' => $scorePercentage < 70])></div>
                        </div>
                    </div>

                    @if($session->jenis_sesi === 'Simulasi')
                        <div class="text-left space-y-10 mt-24 pt-20 border-t border-slate-100">
                             <div class="flex items-center space-x-5">
                                <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                                    <i class="bi bi-search text-xl"></i>
                                </div>
                                <h4 class="text-2xl font-black text-slate-800 font-outfit uppercase tracking-tight">Review Your Answers</h4>
                             </div>

                             <div class="grid grid-cols-1 gap-8">
                                @foreach($questions as $index => $q)
                                    @php
                                        $userChar = $userAnswers[$q->id] ?? null;
                                        $isCorrect = $userChar === $q->jawaban_benar;
                                    @endphp
                                    <div @class([
                                        'p-10 rounded-[44px] border-2 transition-all duration-500',
                                        'bg-emerald-50/30 border-emerald-100 shadow-xl shadow-emerald-50' => $isCorrect,
                                        'bg-rose-50/30 border-rose-100 shadow-xl shadow-rose-50' => !$isCorrect && $userChar !== null,
                                        'bg-slate-50 border-slate-100' => $userChar === null
                                    ])>
                                        <div class="flex items-start justify-between space-x-6 mb-8 px-2">
                                            <p class="text-xl font-bold text-slate-800 leading-[1.5] font-outfit">{{ $index + 1 }}. {{ $q->soal }}</p>
                                            <div @class([
                                                'w-10 h-10 rounded-2xl flex items-center justify-center text-white text-xl flex-shrink-0 shadow-lg',
                                                'bg-emerald-500 shadow-emerald-100' => $isCorrect,
                                                'bg-rose-500 shadow-rose-100' => !$isCorrect && $userChar !== null,
                                                'bg-slate-300' => $userChar === null
                                            ])>
                                                <i @class(['bi', 'bi-check2-circle' => $isCorrect, 'bi-x-circle' => !$isCorrect && $userChar !== null, 'bi-dash-circle' => $userChar === null])></i>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 pt-8 border-t border-black/5">
                                            <div class="px-4">
                                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-2 italic">Your Submission</span>
                                                <p @class(['font-black text-base font-outfit', 'text-emerald-700' => $isCorrect, 'text-rose-700' => !$isCorrect && $userChar !== null, 'text-slate-400 italic' => $userChar === null])>
                                                    {{ $userChar ? strtoupper($userChar) . '. ' . ($q->{"pilihan_".strtolower($userChar)} ?? '') : 'None' }}
                                                </p>
                                            </div>
                                            <div class="px-4">
                                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-2 italic">Correct Key</span>
                                                <p class="font-black text-base font-outfit text-emerald-700">{{ strtoupper($q->jawaban_benar) . '. ' . ($q->{"pilihan_".strtolower($q->jawaban_benar)} ?? '') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                             </div>
                        </div>
                    @endif

                    <div class="pt-16 pb-6">
                        <button wire:click="exit" class="w-full sm:w-auto px-16 py-6 bg-slate-900 text-white rounded-[32px] font-black text-xs uppercase tracking-[0.3em] shadow-[0_20px_40px_rgba(0,0,0,0.1)] hover:bg-indigo-600 transition-all transform active:scale-95 flex items-center justify-center space-x-4 mx-auto group">
                            <i class="bi bi-chevron-left group-hover:-translate-x-1 transition-transform"></i>
                            <span>Return to Dashboard</span>
                        </button>
                    </div>
                </div>
             </div>
        </div>
    @endif
</div>
