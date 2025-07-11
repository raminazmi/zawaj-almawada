<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $previousUrl = url()->previous();
        if (Str::contains($previousUrl, '/exam?token=')) {
            session(['previous_url' => $previousUrl]);
        }
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        $user = Auth::user();
        if ($user->status === 'pending') {
            return redirect()->route('marriage-requests.index');
        }

        $user = Auth::user();
        $previousUrl = session('previous_url');
        if ($previousUrl && Str::contains($previousUrl, '/exam?token=')) {
            session()->forget('previous_url');
            return redirect($previousUrl);
        }

        if ($user->is_admin && $user->isMainAdmin()) {
            return redirect()->route('admin.dashboard.index');
        }
        if ($user->is_admin && $user->isSubAdmin()) {
            return redirect()->route('admin.shops');
        }

        return redirect()->intended(route('index'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}