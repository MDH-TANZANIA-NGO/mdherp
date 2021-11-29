<?php

namespace App\Http\Controllers\web\Safari;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SafariController extends Controller
{
    public function index()
    {
        return view('safari.index');
    }
}
