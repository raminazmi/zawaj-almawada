<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'انتهت جلستك. يرجى تسجيل الدخول مرة أخرى',
                    'session_expired' => true
                ], 401);
            }

            return redirect()->route('login')
                ->with('error', 'انتهت جلستك. يرجى تسجيل الدخول مرة أخرى');
        }

        $user = Auth::user();
        if (!$user->is_admin) {
            abort(403, 'غير مصرح لك بالوصول إلى هذه الصفحة');
        }

        return $next($request);
    }
}
