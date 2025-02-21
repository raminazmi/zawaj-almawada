<?php

namespace App\Http\Controllers\FamilyCounseling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FamilyCounselingController extends Controller
{
    public function index(){
        return view('family-counseling.index');
    }
}
