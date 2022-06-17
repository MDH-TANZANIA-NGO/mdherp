<?php

namespace App\Models\HumanResource\PerformanceReview\Traits\Attribute;

trait PrReportAttribute
{
    public function getResourceNameAttribute()
    {
        return "<b>".$this->number."</b> <br>".
            $this->type->title."<br>".
            $this->user->full_name_formatted."<br>".
            $this->user->designation_title;
    }
}
