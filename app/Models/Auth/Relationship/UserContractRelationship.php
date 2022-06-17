<?php

namespace App\Models\Auth\Relationship;

use App\Models\Auth\User;
use App\Models\Auth\UserContractProject;

trait UserContractRelationship
{
    public function user()
    {
        return  $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->hasMany(UserContractProject::class,'user_contract_id','id');
    }
}
