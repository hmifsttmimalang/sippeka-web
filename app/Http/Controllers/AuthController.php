<?php

namespace App\Http\Controllers;

use App\Actions\AuthenticateUserAction;
use App\Actions\RegisterUserAction;
use App\Actions\StartSkillTestSelectionAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(
        private RegisterUserAction $registerAction,
        private AuthenticateUserAction $authenticateAction,
        private StartSkillTestSelectionAction $startSelectionAction,
    ) {}

    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = $this->registerAction->execute($request->only('username', 'email', 'password'));

        Auth::login($user);

        return redirect()->route('home');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ]);

        if ($this->authenticateAction->execute([
            'identifier' => $request->identifier,
            'password' => $request->password,
            'remember' => $request->has('remember'),
        ])) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'instructor') {
                return redirect()->route('instructor.dashboard');
            } else {
                return redirect()->route('home');
            }
        }

        return back()->withErrors([
            'login' => 'Username atau password yang Anda masukkan salah atau belum terdaftar!',
        ]);
    }

    public function loginSimulation(Request $request, string $username): RedirectResponse
    {
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ]);

        if ($this->authenticateAction->execute($request->only('identifier', 'password'))) {
            return redirect()->route('student.simulation', $username);
        }

        return back()->withErrors([
            'login' => 'Username atau password yang Anda masukkan salah!',
        ]);
    }

    public function loginSelection(Request $request, string $username): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ]);

        // Jika autentikasi berhasil
        if ($this->authenticateAction->execute($request->only('identifier', 'password'))) {
            $user = Auth::user();

            $result = $this->startSelectionAction->execute($user);

            if ($result['status'] === 'error') {
                return redirect()->route('user.dashboard', ['username' => $username])
                    ->with('error', $result['message']);
            }

            // Redirect ke halaman seleksi jika berhasil
            return redirect()->route('student.selection', $username);
        }

        // Kembalikan error jika login gagal
        return back()->withErrors([
            'login' => 'Username atau password yang Anda masukkan salah!',
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('auth.login');
    }
}
