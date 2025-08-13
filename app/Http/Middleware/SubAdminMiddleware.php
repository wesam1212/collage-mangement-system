<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SubAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'subadmin') {
            return $next($request);
        }
        abort(403, 'غير مسموح لك بالدخول لهذه الصفحة.');
    }
}
