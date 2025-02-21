<?php

namespace App\Http\Controllers\DoctorCounseling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorCounselingController extends Controller
{
    public function index(){
        return view('doctor-counseling.index');
    }
}
