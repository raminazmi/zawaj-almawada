<?php

namespace App\Http\Controllers\Ebooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EbooksController extends Controller
{
    public function index(){
        return view('e-books.index');
    }
}
