<?php

namespace App\Http\Controllers\AddActivity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddActivityController extends Controller
{
    public function index(){
        return view('add-activity.index');
    }
}
