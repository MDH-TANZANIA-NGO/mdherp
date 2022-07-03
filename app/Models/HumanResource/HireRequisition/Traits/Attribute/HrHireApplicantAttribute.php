<?php

namespace App\Models\HumanResource\HireRequisition\Traits\Attribute;
trait HrHireApplicantAttribute
{
    public function getFullNameAttribute()
    {
        return $this->first_name." ".$this->last_name;
    }
}
