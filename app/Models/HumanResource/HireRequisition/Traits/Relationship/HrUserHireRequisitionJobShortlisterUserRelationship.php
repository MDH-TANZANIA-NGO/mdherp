<?php

namespace App\Models\HumanResource\HireRequisition\Traits\Relationship;

use App\Models\Auth\User;

trait HrUserHireRequisitionJobShortlisterUserRelationship
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}