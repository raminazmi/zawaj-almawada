<?php

namespace App\Http\Controllers\PrintedBook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrintedBookController extends Controller
{
    public function index(){
        return view('printed-books.index');
    }
}
