<?php

namespace App\Models\Auth\Relationship;

use App\Models\Auth\UserContractProjectDesignation;

trait UserContractProjectRelationship
{
    public function designations()
    {
        return $this->hasMany(UserContractProjectDesignation::class,'user_contract_project_id', 'id');
    }
}
