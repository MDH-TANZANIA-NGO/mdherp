<?php

use App\Models\Auth\User;
use Carbon\Carbon;
use App\Notifications\TimeNotification;

User::query()
     ->whereDoesntHave('times', function($query){
        $query->whereDate('times.time_start', '!=', Carbon::now());
     })->chunk('10', function($users){
        foreach($users as $user){
        $user->notify(new TimeNotification());  
        }

     });
