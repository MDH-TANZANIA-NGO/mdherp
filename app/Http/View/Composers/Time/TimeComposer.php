<?php

namespace App\Http\View\Composers\Time;


use Illuminate\View\View;
use App\Models\Time\Time;
use Auth;

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
        $view->with('check_time',Time::query()->where('user_id', Auth::user()->id)->whereNull('time_end')->get());
    }
}
