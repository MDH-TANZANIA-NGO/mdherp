<?php

namespace App\Models\Education\Traits;

use App\Models\Auth\User;

trait EducationRelationship
{
    public function user(){
        return $this->belongsTo(User::class);
    }

}
