<?php

namespace App\Models\HumanResource\HireRequisition\Traits\Attribute;

trait HrHireRequisitionJobApplicantRequestAttribute
{
    public function getResourceNameAttribute()
    {
        return "<b>".$this->number."</b> <br>".
            "Shortlisters List<br>".
            $this->user->full_name_formatted."<br>".
            $this->user->designation_title;
    }
}