<div class="max-w-4xl mx-auto">
    <!-- Stepper Header -->
    <div class="mb-12">
        <div class="flex items-center justify-between relative">
            <!-- Progress Line -->
            <div class="absolute top-1/2 left-0 w-full h-1 bg-slate-100 -translate-y-1/2 rounded-full overflow-hidden">
                <div class="h-full bg-primary-600 transition-all duration-700 ease-in-out" style="width: {{ (($currentStep - 1) / ($totalSteps - 1)) * 100 }}%"></div>
            </div>

            @for($i = 1; $i <= $totalSteps; $i++)
                <div class="relative z-10 flex flex-col items-center group">
                    <div @class([
                        'w-14 h-14 rounded-2xl flex items-center justify-center font-black transition-all duration-500 shadow-lg',
                        'bg-primary-600 text-white shadow-primary-600/30' => $currentStep >= $i,
                        'bg-white text-slate-300 border border-slate-100' => $currentStep < $i
                    ])>
                        @if ($currentStep > $i)
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        @else
                            {{ $i }}
                        @endif
                    </div>
                    <span @class([
                        'text-[10px] font-black uppercase tracking-widest mt-4 transition-colors',
                        'text-primary-600' => $currentStep >= $i,
                        'text-slate-300' => $currentStep < $i
                    ])>
                        @if($i == 1) Profil @elseif($i == 2) Program @elseif($i == 3) Berkas @else Review @endif
                    </span>
                </div>
            @endfor
        </div>
    </div>

    <!-- Wizard Content -->
    <div class="glass-card bg-white/70 backdrop-blur-xl border-white shadow-2xl p-10 md:p-16 rounded-[40px] overflow-hidden relative">
        <div class="absolute top-0 right-0 w-64 h-64 bg-primary-50 rounded-full blur-3xl opacity-40 -mr-32 -mt-32"></div>

        <div class="relative z-10">
            @if($currentStep === 1)
                <!-- Step 1: Personal Information -->
                <div class="space-y-10 animate-fade-in">
                    <div>
                        <h3 class="text-3xl font-heading font-black text-slate-900 leading-tight">Lengkapi Profil Anda</h3>
                        <p class="text-slate-500 font-medium italic mt-2">Gunakan data yang sesuai dengan Identitas Resmi (KTP/KK).</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3 md:col-span-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Nama Lengkap</label>
                            <input wire:model="nama" type="text" class="block w-full px-6 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-900 transition-all shadow-sm">
                            @error('nama') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Tempat Lahir</label>
                            <input wire:model="tempat_lahir" type="text" placeholder="Contoh: Jakarta" class="block w-full px-6 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-900 transition-all shadow-sm">
                            @error('tempat_lahir') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Tanggal Lahir</label>
                            <input wire:model="tanggal_lahir" type="date" class="block w-full px-6 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-900 transition-all shadow-sm">
                            @error('tanggal_lahir') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Jenis Kelamin</label>
                            <select wire:model="jenis_kelamin" class="block w-full px-6 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-900 transition-all shadow-sm appearance-none">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Agama</label>
                            <select wire:model="agama" class="block w-full px-6 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-900 transition-all shadow-sm appearance-none">
                                <option value="">Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                            @error('agama') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-3 md:col-span-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Alamat Tinggal Sekarang</label>
                            <textarea wire:model="alamat" rows="3" class="block w-full px-6 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-900 transition-all shadow-sm"></textarea>
                            @error('alamat') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-3 md:col-span-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Nomor Telepon (WhatsApp)</label>
                            <input wire:model="telepon" type="text" placeholder="Contoh: 081234567890" class="block w-full px-6 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-900 transition-all shadow-sm">
                            @error('telepon') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

            @elseif($currentStep === 2)
                <!-- Step 2: Skill Selection -->
                <div class="space-y-10 animate-fade-in">
                    <div>
                        <h3 class="text-3xl font-heading font-black text-slate-900 leading-tight">Pilih Program Keahlian</h3>
                        <p class="text-slate-500 font-medium italic mt-2">Pilih salah satu program pelatihan yang ingin Anda ikuti.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($skills as $skill)
                            <label class="relative group cursor-pointer">
                                <input type="radio" wire:model="keahlian" value="{{ $skill->id }}" class="peer absolute opacity-0">
                                <div class="p-8 bg-slate-50 border-2 border-transparent rounded-[32px] transition-all duration-300 peer-checked:bg-white peer-checked:border-primary-600 peer-checked:shadow-2xl peer-checked:shadow-primary-600/10 group-hover:bg-white group-hover:border-slate-200">
                                    <div class="w-12 h-12 bg-white rounded-xl shadow-sm border border-slate-100 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform peer-checked:bg-primary-600 peer-checked:text-white">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    </div>
                                    <p class="text-lg font-black text-slate-900 leading-tight">{{ $skill->nama }}</p>
                                    <p class="text-[10px] font-black text-primary-600 uppercase tracking-widest mt-2 opacity-0 peer-checked:opacity-100 transition-opacity">Dipilih</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('keahlian') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                </div>

            @elseif($currentStep === 3)
                <!-- Step 3: Document Uploads -->
                <div class="space-y-10 animate-fade-in">
                    <div>
                        <h3 class="text-3xl font-heading font-black text-slate-900 leading-tight">Unggah Berkas Persyaratan</h3>
                        <p class="text-slate-500 font-medium italic mt-2">Pastikan berkas terbaca dengan jelas. Format yang didukung: PDF, JPG, PNG.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <!-- ID Card -->
                        <div class="space-y-4">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Foto KTP / Kartu Keluarga</label>
                            <label class="block w-full relative">
                                <div @class([
                                    'w-full h-48 rounded-3xl border-2 border-dashed flex flex-col items-center justify-center transition-all p-6 cursor-pointer',
                                    'border-primary-200 bg-primary-50/30' => $foto_identitas,
                                    'border-slate-100 bg-slate-50 hover:bg-white hover:border-primary-400' => !$foto_identitas
                                ])>
                                    @if($foto_identitas)
                                        <svg class="w-12 h-12 text-emerald-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="text-xs font-bold text-slate-700 truncate w-full text-center">Berkas Terunggah</span>
                                    @else
                                        <svg class="w-10 h-10 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                        <span class="text-xs font-bold text-slate-400">Pilih Berkas</span>
                                    @endif
                                </div>
                                <input type="file" wire:model="foto_identitas" class="absolute inset-0 opacity-0 cursor-pointer">
                            </label>
                            @error('foto_identitas') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                        </div>

                        <!-- Ijazah -->
                        <div class="space-y-4">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Ijazah Terakhir</label>
                            <label class="block w-full relative">
                                <div @class([
                                    'w-full h-48 rounded-3xl border-2 border-dashed flex flex-col items-center justify-center transition-all p-6 cursor-pointer',
                                    'border-primary-200 bg-primary-50/30' => $foto_ijazah,
                                    'border-slate-100 bg-slate-50 hover:bg-white hover:border-primary-400' => !$foto_ijazah
                                ])>
                                    @if($foto_ijazah)
                                        <svg class="w-12 h-12 text-emerald-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="text-xs font-bold text-slate-700 truncate w-full text-center">Berkas Terunggah</span>
                                    @else
                                        <svg class="w-10 h-10 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                        <span class="text-xs font-bold text-slate-400">Pilih Berkas</span>
                                    @endif
                                </div>
                                <input type="file" wire:model="foto_ijazah" class="absolute inset-0 opacity-0 cursor-pointer">
                            </label>
                            @error('foto_ijazah') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                        </div>

                        <!-- Pas Foto -->
                        <div class="space-y-4 md:col-span-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Pas Foto (Background Biru)</label>
                            <label class="block w-full relative">
                                <div @class([
                                    'w-full h-64 rounded-3xl border-2 border-dashed flex flex-col items-center justify-center transition-all p-6 cursor-pointer overflow-hidden',
                                    'border-primary-200 bg-primary-50/10' => $foto_bg_biru,
                                    'border-slate-100 bg-slate-50 hover:bg-white hover:border-primary-400' => !$foto_bg_biru
                                ])>
                                    @if($foto_bg_biru)
                                        <img src="{{ $foto_bg_biru->temporaryUrl() }}" class="absolute inset-0 w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                            <span class="text-white text-xs font-black uppercase tracking-widest">Ganti Foto</span>
                                        </div>
                                    @else
                                        <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span class="text-xs font-bold text-slate-400">Pilih Pas Foto</span>
                                    @endif
                                </div>
                                <input type="file" wire:model="foto_bg_biru" class="absolute inset-0 opacity-0 cursor-pointer">
                            </label>
                            @error('foto_bg_biru') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

            @elseif($currentStep === 4)
                <!-- Step 4: Review & Submit -->
                <div class="space-y-12 animate-fade-in">
                    <div>
                        <h3 class="text-3xl font-heading font-black text-slate-900 leading-tight text-center">Tinjau Kembali Data Anda</h3>
                        <p class="text-slate-500 font-medium italic mt-2 text-center">Pastikan semua data sudah benar sebelum mengirim pendaftaran.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <div class="space-y-8">
                            <h4 class="text-xs font-black text-primary-600 uppercase tracking-widest border-b border-primary-100 pb-2">Informasi Personal</h4>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">Nama Lengkap</p>
                                    <p class="text-base font-bold text-slate-900">{{ $nama }}</p>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">TTL</p>
                                        <p class="text-sm font-bold text-slate-700">{{ $tempat_lahir }}, {{ date('d-m-Y', strtotime($tanggal_lahir)) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">Gender</p>
                                        <p class="text-sm font-bold text-slate-700">{{ $jenis_kelamin }}</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">WhatsApp</p>
                                    <p class="text-sm font-bold text-slate-700">{{ $telepon }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-8">
                            <h4 class="text-xs font-black text-indigo-600 uppercase tracking-widest border-b border-indigo-100 pb-2">Program Pilihan</h4>
                            <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-tighter mb-1">Keahlian Yang Diikuti</p>
                                <p class="text-xl font-black text-slate-900 leading-tight">
                                    {{ $skills->firstWhere('id', $keahlian)->nama ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 bg-amber-50 rounded-3xl border border-amber-100/50 flex items-start space-x-4">
                        <div class="p-2 bg-amber-100 rounded-xl text-amber-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-amber-800 leading-relaxed italic">Dengan menekan tombol "Kirim Pendaftaran", saya menyatakan bahwa seluruh data yang saya masukkan adalah benar dan dapat dipertanggungjawabkan.</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Navigation Buttons -->
        <div class="flex items-center justify-between mt-16 pt-10 border-t border-slate-100 relative z-10">
            @if($currentStep > 1)
                <button wire:click="previousStep" class="px-8 py-4 text-slate-500 font-bold text-sm hover:shadow-lg hover:shadow-slate-200 hover:bg-white rounded-2xl transition-all">Sebelumnya</button>
            @else
                <div></div>
            @endif

            @if($currentStep < $totalSteps)
                <button wire:click="nextStep" class="px-10 py-4 bg-slate-900 text-white rounded-2xl font-bold text-sm shadow-2xl shadow-slate-900/30 hover:bg-primary-600 hover:shadow-primary-600/40 transition-all flex items-center space-x-3">
                    <span>Lanjutkan</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            @else
                <button wire:click="submit" wire:loading.attr="disabled" class="px-10 py-4 bg-primary-600 text-white rounded-2xl font-black text-sm shadow-2xl shadow-primary-600/40 hover:bg-indigo-600 hover:shadow-indigo-600/40 transition-all flex items-center space-x-3">
                    <span wire:loading.remove>Kirim Pendaftaran Sekarang</span>
                    <span wire:loading>Memproses...</span>
                    <svg wire:loading.remove class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </button>
            @endif
        </div>
    </div>
</div>
