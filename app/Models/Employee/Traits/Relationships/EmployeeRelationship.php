<?php

namespace App\Models\Employee\Traits\Relationships;

use App\Models\Auth\User;

trait EmployeeRelationship
{
    public function user(){
        return $this->belongsTo(User::class);
    }
}
