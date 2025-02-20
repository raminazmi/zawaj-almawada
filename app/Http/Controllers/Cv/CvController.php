<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CvController extends Controller
{
    public function index(){
        return view('cv.index');
    }
}
