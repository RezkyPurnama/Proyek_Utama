<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
             // Cek jika pengguna belum login
        if (auth()->guest()) {
            abort(403, 'Unauthorized action.');
        }

        // Jika bukan admin dan owner, maka akses diblokir
        if (auth()->user()->isAdmin !== 1 && auth()->user()->isAdmin !== 2) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);

    }

}
