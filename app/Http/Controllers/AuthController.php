<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Registration;
use App\Models\SkillTestSession;
use App\Models\TestAttempt;
use App\Models\User;

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
            'login' => 'Username atau password yang Anda masukkan salah atau belum terdaftar!',
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
            return redirect()->route('user.simulasi', $username);
        }

        return back()->withErrors([
            'login' => 'Username atau password yang Anda masukkan salah!',
        ]);
    }

    public function loginSeleksi(Request $request, $username)
    {
        // Validasi input
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ]);

        // Tentukan apakah input adalah email atau username
        $loginType = filter_var($request->identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Siapkan kredensial untuk autentikasi
        $credentials = [
            $loginType => $request->identifier,
            'password' => $request->password,
        ];

        // Jika autentikasi berhasil
        if (Auth::attempt($credentials)) {
            // Ambil user yang berhasil login
            $user = Auth::user();

            // Temukan pendaftaran (registration) user
            $registration = Registration::where('user_id', $user->id)->first();

            // Temukan sesi tes keahlian yang aktif berdasarkan waktu saat ini
            $sesiTesKeahlian = SkillTestSession::where('waktu_mulai', '<=', now())
                ->where('waktu_selesai', '>=', now())
                ->first();

            if (!$sesiTesKeahlian) {
                // Jika tidak ada sesi aktif, tampilkan error tanpa redirect
                return redirect()->route('user.seleksi_login', ['username' => $username])->with('error', 'Tidak ada sesi yang aktif saat ini');
            }

            // Periksa apakah user sudah memulai tes attempt sebelumnya
            $testAttempt = TestAttempt::firstOrCreate(
                [
                    'registration_id' => $registration->id,
                    'skill_test_session_id' => $sesiTesKeahlian->id,
                ],
                [
                    'status' => 'in_progress',
                    'waktu_mulai' => Carbon::now(),
                ]
            );

            // Redirect ke halaman seleksi jika berhasil
            return redirect()->route('user.seleksi', $username);
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
