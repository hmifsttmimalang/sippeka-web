<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'user'; // Default role, adjust if needed
        $user->status_register = 'tidak terdaftar'; // Default status, adjust if needed
        $user->save();

        Auth::login($user);

        return redirect()->route('home');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ]);

        // Cek apakah input login adalah email atau username
        $loginType = filter_var($request->identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Coba autentikasi berdasarkan username atau email
        $credentials = [
            $loginType => $request->identifier,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            // Cek role setelah berhasil login
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard'); // Arahkan ke halaman admin
            } else {
                return redirect()->route('home'); // Arahkan ke halaman user
            }
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }

    public function loginSimulasi(Request $request, $username)
    {
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ]);

        // Cek apakah input login adalah email atau username
        $loginType = filter_var($request->identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Coba autentikasi berdasarkan username atau email
        $credentials = [
            $loginType => $request->identifier,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('simulasi_peserta', $username);
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }

    public function loginSeleksi(Request $request, $username)
    {
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ]);

        // Cek apakah input login adalah email atau username
        $loginType = filter_var($request->identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Coba autentikasi berdasarkan username atau email
        $credentials = [
            $loginType => $request->identifier,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('seleksi_peserta', $username);
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
