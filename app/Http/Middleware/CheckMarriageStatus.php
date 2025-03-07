<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMarriageStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->activeMarriageRequest) {
            return redirect()->route('marriage-requests.status');
        }

        return $next($request);
    }
}
