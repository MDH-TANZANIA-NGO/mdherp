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
        $current = Carbon::now();
       
        return view('time.time', ['current' => $current, 'times' => $times ]);

     }


    public function store(Request $request)
    {

        $time = date('Y-m-d H:i:s');
        $data = ['time_start' => $time, 'user_id' => Auth::user()->id];
        Time::create($data);
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $time = date('Y-m-d H:i:s');
        $data = ['time_start' => $time, 'user_id' => Auth::user()->id];
        $end= Time::where('user_id', Auth::user()->id)->whereNull('time_end')->first();
       
        $end->time_end= $time;
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

}






    
// echo $hour = $interval->format('%h hour');
// echo $min = $interval->format('%i min');
// echo $sec = $interval->format('%s second');


