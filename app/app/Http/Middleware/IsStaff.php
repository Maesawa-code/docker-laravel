<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsStaff
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'staff') {
            return $next($request);
        }

        abort(403, '一般社員専用ページです。');
    }
}
