<?php

namespace App\Livewire\Admin;

use App\Actions\SaveUserAction;
use App\Models\User;
use App\Services\Admin\UserService;
use App\Traits\WithAdminPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin_app')]
#[Title('Manajemen User')]
class UserManager extends Component
{
    use WithAdminPagination;

    public string $search = '';

    public string $filterRole = '';

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

    public function openModal(?int $id = null): void
    {
        $this->resetErrorBag();
        $this->editingId = $id;

        if ($id) {
            $user = User::findOrFail($id);
            $this->fill($user->only(['name', 'username', 'email', 'role']));
            $this->password = ''; // Kosongkan password pas edit
        } else {
            $this->reset(['name', 'username', 'email', 'password', 'role']);
            $this->role = 'user';
        }

        $this->showingModal = true;
    }

    public function save(SaveUserAction $action): void
    {
        // Validasi
        $this->validate([
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($this->editingId)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->editingId)],
            'password' => $this->editingId ? 'nullable|min:8' : 'required|min:8',
            'role' => 'required|in:admin,instructor,user',
        ]);

        // Eksekusi pake pull() biar sat-set - Tapi jangan tarik search & filterRole
        $action->execute($this->pull(['name', 'username', 'email', 'password', 'role']), $this->editingId);

        session()->flash('success', 'User berhasil diamankan.');
        $this->closeModal();
    }

    public function delete(int $id, UserService $service): void
    {
        try {
            $service->deleteUser($id);
            session()->flash('success', 'User dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render(UserService $service): View
    {
        return view('livewire.admin.user-manager', [
            'users' => $service->getPaginatedUsers($this->search, $this->filterRole),
        ]);
    }

    public function closeModal(): void
    {
        $this->showingModal = false;
        $this->reset('editingId');
    }
}
