<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMainAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->isMainAdmin()) {
            abort(403);
        }
        return $next($request);
    }
}
