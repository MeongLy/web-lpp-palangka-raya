<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Sederhana: cek jika user login dan email admin
        if (Auth::check() && Auth::user()->email == 'admin@lapas.com') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Akses ditolak!');
    }
}
