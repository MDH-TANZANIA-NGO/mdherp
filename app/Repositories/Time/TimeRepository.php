<?php

namespace App\Repositories\Time;

use App\Models\Auth\User;
use App\Jobs\Time\TimeJob;
use App\Models\Time\Time;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use App\Notifications\TimeNotification;
use Illuminate\Support\Facades\DB;

class TimeRepository extends BaseRepository
{
    const MODEL = Time::class;

    

    public function chekinReminder()
    {
     User::query()
     ->whereDoesntHave('times', function($query){
        $query->whereDate('times.time_start', '!=', Carbon::now());
     })->chunk('10', function($users){ 
        foreach($users as $user){
            $user->notify(new TimeNotification('check in the system'));  
            }  
     });
    }

    
   public function chekoutReminder()
   {
    User::query()
     ->whereHas('times', function($query){
        $query->whereDate('times.time_start', Carbon::now())
        ->whereNull('times.time_end');

     })->chunk('10', function($users){
        // CheckOutJob::dispatch($users);   
        foreach($users as $user){
            $user->notify(new TimeNotification('check out of the system'));  
            }
     });

   }


  

}
