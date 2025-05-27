<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->hasRole('superadmin')) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
