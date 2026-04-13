<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManager extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterRole = '';

    // Form fields
    public string $name = '';
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $role = 'user';

    public ?int $editingId = null;
    public bool $showingModal = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'filterRole' => ['except' => ''],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function openModal(?int $id = null): void
    {
        $this->resetErrorBag();
        $this->editingId = $id;
        $this->showingModal = true;

        if ($id) {
            $user = User::findOrFail($id);
            $this->name = $user->name;
            $this->username = $user->username;
            $this->email = $user->email;
            $this->role = $user->role;
            $this->password = ''; // Don't show password on edit
        } else {
            $this->reset(['name', 'username', 'email', 'password', 'role']);
        }
    }

    public function closeModal(): void
    {
        $this->showingModal = false;
        $this->editingId = null;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($this->editingId)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->editingId)],
            'password' => $this->editingId ? 'nullable|min:8' : 'required|min:8',
            'role' => 'required|in:admin,instruktur,user',
        ]);

        $data = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'role' => $this->role,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->editingId) {
            $user = User::findOrFail($this->editingId);
            $user->update($data);
            session()->flash('success', 'User berhasil diperbarui.');
        } else {
            User::create($data);
            session()->flash('success', 'User berhasil ditambahkan.');
        }

        $this->closeModal();
    }

    public function delete(int $id): void
    {
        if (auth()->id() === $id) {
            session()->flash('error', 'Anda tidak bisa menghapus akun sendiri.');
            return;
        }

        $user = User::findOrFail($id);
        $user->delete();
        session()->flash('success', 'User berhasil dihapus.');
    }

    public function render(): View
    {
        $users = User::query()
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('username', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterRole, fn($q) => $q->where('role', $this->filterRole))
            ->latest()
            ->paginate(10);

        return view('livewire.admin.user-manager', [
            'users' => $users
        ])->layout('components.layouts.admin', ['header' => 'Manajemen Akun User']);
    }
}
