<?php

namespace App\Http\Controllers\web\fleet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    public function index()
    {
        return view('fleet.index');
    }
}
