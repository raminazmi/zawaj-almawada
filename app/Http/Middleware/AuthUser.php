<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Session expired'], 401);
            }
            return redirect()->route('login')->with('error', 'Your session has expired');
        }

        if (!Auth::user()->email_verified_at) {
            return redirect()->route('verification.notice');
        }

        if (Auth::user()->is_admin) {
            abort(403);
        }

        return $next($request);
    }
}
