<?php

namespace App\Http\Controllers\Web\Time;

use Illuminate\Http\Request;
use App\Models\Time\Time;
use Carbon\Carbon;
use App\Models\Auth\User;
use App\Repositories\Access\UserRepository;
use App\Http\Controllers\Controller;
use Auth;

class TimeController extends Controller
{

    public function __construct()
    {

        $this->users = (new UserRepository());
    }

    public function time()
    {
        $times = Time::all();
        $user = User::all();
        $current = Carbon::now();

        return view('time.time', ['current' => $current, 'times' => $times, 'user' => $user]);
    }


    public function store(Request $request)
    {
        $time = date('Y-m-d H:i:s');
        $data = ['time_start' => $time, 'lat_in' => $request->input('lat_in'), 'long_in' => $request->input('long_in'), 'user_id' => Auth::user()->id, 'name' => Auth::user()->first_name];
        Time::create($data);


        return redirect()->back();
    }

    public function update(Request $request)
    {
        $time = date('Y-m-d H:i:s');
        $end = Time::where('user_id', Auth::user()->id)->whereNull('time_end')->first();
        //    {{ access()->user()->full_name_formatted }}
        $end->time_end = $time;
        $end->lat_out = $request->input('lat_out');
        $end->long_out = $request->input('long_out');
        $end->save();

        return redirect()->back();
    }

    public function show()
    {
        $times = Time::all();
        $current = Carbon::now();
        $check = Time::query()->where('user_id', Auth::user()->id)->whereNull('time_end')->get();
        return view('time.show', ['current' => $current, 'times' => $times, 'check' => $check]);
    }

    public function view($id)
    {
        $time = Time::find($id);



        return view('time.view', ['time' => $time]);
    }

    public function view2($id)
    {
        $time = Time::find($id);

        return view('time.view2', ['time' => $time]);
    }


    public function viewall()
    {

        $time = Time::all();
        return view('time.viewall', ['time' => $time]);
    }

    
}




// echo $hour = $interval->format('%h hour');
// echo $min = $interval->format('%i min');
// echo $sec = $interval->format('%s second');
