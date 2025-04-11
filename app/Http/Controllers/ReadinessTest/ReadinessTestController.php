<?php


namespace App\Http\Controllers\ReadinessTest;

use App\Http\Controllers\Controller;

class ReadinessTestController extends Controller
{
    public function index()
    {
        return view('readiness-test.index');
    }
}
