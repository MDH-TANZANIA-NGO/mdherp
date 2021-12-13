<?php

namespace App\Models\Requisition\Traits\Attribute;

use App\Repositories\Requisition\RequisitionRepository;
use mysql_xdevapi\BaseResult;

trait RequisitionAttribute
{
    public function getResourceNameAttribute()
    {
        return "<b>".$this->number."</b> <br>".
            $this->typeCategory->title."<br>".
            $this->user->full_name_formatted."<br>".
            $this->user->designation_title;
    }

    public function updatingTotalAmount()
    {
        return (new RequisitionRepository())->updatingTotalAmount($this);
    }

    public function getNumericOutputUnitAttribute()
    {
        return $this->activity->budgets()->where('region_id',$this->region_id)->where('active',true)->first()->numeric_output;
    }

    public function getProgramAreaTitleAttribute()
    {
        return $this->activity->subprogram->programArea->title;
    }

    public function getProjectTitleAttribute()
    {
        return $this->project->title;
    }

    public function getOutputUnitTitleAttribute()
    {
        return $this->activity->outputUnit->title;
    }

}
