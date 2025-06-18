<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user->hasRoles('mahasiswa')) {
            return redirect()->route('mahasiswa.dashboard');
        } elseif ($user->hasRole('dosen')) {
            return redirect()->route('dosen.dashboard');
        }

        // Tambahkan role lain jika diperlukan
        return $next($request);
    }
}
