<?php

namespace App\Http\Controllers\LegalCounseling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LegalCounselingController extends Controller
{
    public function index(){
        return view('legal-counseling.index');
    }
}
