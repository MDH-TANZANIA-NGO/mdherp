<?php

namespace App\Http\Controllers\Web\Location;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Location;
use App\Models\Location\Map;

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
    public function store(Request $request)
    {


        $map = new Map;
        $map->lat = $request->input('latitute');
        $map->long = $request->input('longitude');
        $map->save();

        return $map;
    }
}
