<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403);
        }

        return $next($request);
    }
}
