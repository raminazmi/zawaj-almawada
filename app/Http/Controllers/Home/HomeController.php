<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Exam\InitExamAction;
use App\Models\MarriageRequest;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $marriageRequest = null;

        if (Auth::check()) {
            $user = Auth::user();
            $marriageRequest = $user->activeMarriageRequest ?? $user->targetMarriageRequest;
        }

        return view('home.index', compact('marriageRequest'));
    }

    public function personalInfoStart(InitExamAction $action)
    {
        if (!request('token') && !auth()->user()->gender) {
            session(['previous_url' => url()->previous()]);
            return to_route('personal-info');
        }

        $token = request('token') ?? request()->route('token');

        return view('exam-start', ['token' => $token]);
    }
}
