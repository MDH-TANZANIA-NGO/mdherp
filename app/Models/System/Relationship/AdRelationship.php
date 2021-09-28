<?php

namespace App\Models\System\Relationship;

use App\Models\Auth\User;
use App\Models\Stakeholder\Company;
use App\Models\System\CodeValue;

trait AdRelationship
{

    /*Relation to user*/
    public function user()
    {
        return $this->belongsTo(User::class);

    }
        /*Relation to company*/
        public function company()
    {
        return $this->belongsTo(Company::class);
    }


    /*Relation to Ad location on portal page*/
    public function adLocation()
    {
        return $this->belongsTo(CodeValue::class);
    }

}