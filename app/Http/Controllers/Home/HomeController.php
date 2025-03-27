<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Exam\InitExamAction;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
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
