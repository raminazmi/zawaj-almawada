<?php

namespace App\Http\Controllers\MarriageRequests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarriageRequestsController extends Controller
{
    public function index()
    {
        return view('marriage-requests.index');
    }
}
