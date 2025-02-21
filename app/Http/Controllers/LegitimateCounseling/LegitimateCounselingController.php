<?php

namespace App\Http\Controllers\LegitimateCounseling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LegitimateCounselingController extends Controller
{
    public function index(){
        return view('legitimate-counseling.index');
    }
}
