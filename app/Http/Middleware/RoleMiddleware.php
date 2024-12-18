<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /** php artisan make:middleware NamaMiddleware
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Lihat https://laravel.com/docs/11.x/middleware#middleware-aliases utk penggunaan ini (`kernel.php` terlalu tua)
        if (!(Auth::user()->level == 'admin')) {
            abort(403); 
        }
        return $next($request);
    }
}
