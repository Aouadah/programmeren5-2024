<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
    // Only admins can view this page
    public function handle($request, Closure $next)
    {
        if (auth()->user()?->name!== 'test'){
            abort(403);
        }

        return $next($request);
    }
}
