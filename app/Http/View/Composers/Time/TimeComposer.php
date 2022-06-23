<?php

namespace App\Http\View\Composers\Time;


use Illuminate\View\View;
use App\Models\Time\Time;
use Auth;
use Illuminate\Support\Carbon;

class TimeComposer
{
  

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $time = [];
        if(Auth::check())
        {
            $time = Time::query()->where('user_id', Auth::user()->id)->whereNull('time_end')->get();
        }
       
        $visibility2 = true;
        $lastcheckin = Time::where('user_id', access()->id())->whereDate('time_start', Carbon::now()->format('Y-m-d'))->whereNotNull('time_end');
        if ($lastcheckin->count() > 0 ){
            $visibility2 = false;
        }
        $view->with('check_time', $time)
        ->with('visibility2', $visibility2);
    }


}


