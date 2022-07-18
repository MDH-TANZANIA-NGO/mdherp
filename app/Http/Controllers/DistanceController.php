<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interval\Interval;
use Auth;
use App\Models\Auth\User;

class DistanceController extends Controller
{
    public function index()
    {


        return view('fleet.route');
    }


    public function store(Request $request)
    {

        $data = ['from' => $request->input('origin'), 'to' => $request->input('destination'), 'driving_distance' => $request->input('driving_distance'), 'duration' => $request->input('duration'), 'user_id' => Auth::user()->id];
        $interval = Interval::create($data);
        return $interval;
    }

    public function show()
    {
        $intervals = Interval::all();


        return view('fleet.routeshow', ['intervals' => $intervals]);
    }
}
