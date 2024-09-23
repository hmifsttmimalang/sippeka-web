<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Registration;

class CekPendaftaran
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!Registration::where('user_id', $user->id)->exists()) {
            return redirect()->route('pendaftaran.form')->with('warning', 'Anda belum terdaftar. Silakan daftar terlebih dahulu.');
        }
        
        return $next($request);
    }
}
