<div class="space-y-10 pb-12">
    <!-- Header Area -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-2">
            <h2 class="text-3xl font-heading font-extrabold text-slate-900 tracking-tight">Manajemen Akun User</h2>
            <p class="text-slate-500 font-medium italic">Kelola seluruh akun administrator, instruktur, dan calon peserta.</p>
        </div>
        
        <div class="flex items-center space-x-3">
            <button wire:click="openModal" class="px-5 py-3 bg-primary-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-primary-600/20 hover:bg-primary-700 hover:-translate-y-0.5 transition-all flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                <span>Tambah User</span>
            </button>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center space-x-2 font-bold text-sm shadow-sm animate-fade-in-down">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="p-4 bg-rose-50 border border-rose-100 text-rose-700 rounded-2xl flex items-center space-x-2 font-bold text-sm shadow-sm animate-fade-in-down">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Filters Area -->
    <div class="glass-card p-6 flex flex-col lg:flex-row lg:items-center justify-between gap-6 bg-white/40 border-white/60">
        <div class="flex flex-col sm:flex-row sm:items-center gap-4 flex-1">
            <div class="relative flex-1 max-w-lg group">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-primary-600 transition-colors">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama, email, atau username..." 
                    class="block w-full pl-12 pr-4 py-3.5 bg-white/60 border-slate-200/60 focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-medium transition-all shadow-sm">
            </div>

            <div class="w-full sm:w-48">
                <select wire:model.live="filterRole" 
                    class="block w-full px-4 py-3.5 bg-white/60 border-slate-200/60 focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-700 transition-all shadow-sm appearance-none">
                    <option value="">Semua Role</option>
                    <option value="admin">Administrator</option>
                    <option value="instruktur">Instruktur</option>
                    <option value="user">Peserta</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="glass-card shadow-2xl shadow-slate-200/60 overflow-hidden bg-white/60">
        <div class="overflow-x-auto min-h-[400px]">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100/50">
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em]">Informasi Akun</th>
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-center">Username</th>
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-center">Role</th>
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-center">Status Reg</th>
                        <th class="px-8 py-5 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.2em] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80">
                    @forelse($users as $user)
                    <tr class="hover:bg-primary-50/30 transition-all group">
                        <td class="px-8 py-6">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200 border-4 border-white shadow-sm flex items-center justify-center text-slate-600 font-black text-lg transition-all group-hover:from-primary-500 group-hover:to-indigo-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-primary-600/20">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div class="max-w-[200px]">
                                    <p class="font-bold text-slate-900 group-hover:text-primary-600 transition-colors truncate">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-400 font-medium truncate">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="text-sm font-bold text-slate-600 font-mono tracking-tight">{{ $user->username }}</span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span @class([
                                'px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider ring-1',
                                'bg-indigo-50 text-indigo-700 ring-indigo-100' => $user->role === 'admin',
                                'bg-amber-50 text-amber-700 ring-amber-100' => $user->role === 'instruktur',
                                'bg-emerald-50 text-emerald-700 ring-emerald-100' => $user->role === 'user',
                            ])>
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span @class([
                                'w-3 h-3 inline-block rounded-full ring-4 ring-white shadow-sm',
                                'bg-emerald-500' => $user->status_register === 'verified' || $user->role === 'admin',
                                'bg-amber-500' => $user->status_register === 'pending' && $user->role === 'user',
                                'bg-slate-300' => !$user->status_register && $user->role === 'user',
                            ])></span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <button wire:click="openModal({{ $user->id }})" class="p-2.5 text-slate-400 hover:text-primary-600 hover:bg-white rounded-xl hover:shadow-md transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                @if(auth()->id() !== $user->id)
                                <button onclick="confirm('Hapus akun user ini?') || event.stopImmediatePropagation()" wire:click="delete({{ $user->id }})" class="p-2.5 text-slate-400 hover:text-rose-600 hover:bg-white rounded-xl hover:shadow-md transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-32 text-center text-slate-400 italic">Data user tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100/50">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Modal Form -->
    @if($showingModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-6 bg-slate-900/60 backdrop-blur-sm animate-fade-in">
        <div class="w-full max-w-2xl bg-white rounded-[32px] shadow-2xl border border-white/60 overflow-hidden transform animate-scale-up">
            <div class="px-10 py-8 bg-slate-50/80 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-heading font-black text-slate-900">{{ $editingId ? 'Edit Akun User' : 'Tambah User Baru' }}</h3>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">Konfigurasi Akses dan Identitas</p>
                </div>
                <button wire:click="closeModal" class="p-3 text-slate-400 hover:text-slate-600 transition-colors bg-white rounded-2xl shadow-sm border border-slate-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form wire:submit="save" class="p-10 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2 leading-none">Nama Lengkap</label>
                        <input wire:model="name" type="text" placeholder="Contoh: Ahmad Sulaiman" 
                            class="block w-full px-6 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-900 transition-all">
                        @error('name') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2 leading-none">Username</label>
                        <input wire:model="username" type="text" placeholder="ahmad_2024" 
                            class="block w-full px-6 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-900 transition-all">
                        @error('username') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2 leading-none">Email</label>
                        <input wire:model="email" type="email" placeholder="example@mail.com" 
                            class="block w-full px-6 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-900 transition-all">
                        @error('email') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2 leading-none text-primary-600">Hak Akses (Role)</label>
                        <select wire:model="role" class="block w-full px-6 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-900 transition-all">
                            <option value="admin">Administrator</option>
                            <option value="instruktur">Instruktur</option>
                            <option value="user">Peserta</option>
                        </select>
                        @error('role') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2 leading-none text-indigo-600">Password {{ $editingId ? '(Kosongkan jika tidak ingin diubah)' : '' }}</label>
                        <input wire:model="password" type="password" placeholder="••••••••" 
                            class="block w-full px-6 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 rounded-2xl text-sm font-bold text-slate-900 transition-all">
                        @error('password') <span class="text-rose-600 text-[10px] font-bold block ml-2">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="pt-6 flex items-center justify-end space-x-4 border-t border-slate-100">
                    <button type="button" wire:click="closeModal" class="px-8 py-4 text-slate-500 font-bold text-sm hover:bg-slate-50 rounded-2xl transition-all">Batalkan</button>
                    <button type="submit" class="px-10 py-4 bg-slate-900 text-white rounded-2xl font-bold text-sm shadow-2xl shadow-slate-900/30 hover:bg-primary-600 hover:shadow-primary-600/40 transition-all flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>{{ $editingId ? 'Simpan Perubahan' : 'Buat Akun Sekarang' }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
