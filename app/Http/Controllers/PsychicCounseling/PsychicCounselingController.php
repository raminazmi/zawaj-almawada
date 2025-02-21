<?php

namespace App\Http\Controllers\PsychicCounseling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PsychicCounselingController extends Controller
{
    public function index(){
        return view('psychic-counseling.index');
    }
}
