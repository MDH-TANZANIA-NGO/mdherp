<?php

namespace App\Models\Experience\Traits;

use App\Models\Auth\User;

trait ExperienceRelationship
{
    public function user(){
        return $this->belongsTo(User::class);
    }
}
