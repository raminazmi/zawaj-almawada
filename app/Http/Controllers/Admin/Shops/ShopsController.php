<?php

namespace App\Http\Controllers\Admin\Shops;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.shops.index');
    }
}
