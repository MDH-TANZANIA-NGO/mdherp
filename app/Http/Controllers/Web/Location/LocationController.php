<?php

namespace App\Http\Controllers\Web\Location;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Location;

class LocationController extends Controller
{
    public function location()
    {
        // Put your IP address
        $ip = '41.188.137.36';

        $data = Location::get($ip);

        return view('location.location', compact('data'));
    }

    public function map()
    {
        return view('location.map');
    }
}
