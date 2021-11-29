<?php

namespace App\Models\Requisition\Traits\Attribute;

use App\Repositories\Requisition\RequisitionRepository;
use mysql_xdevapi\BaseResult;

trait RequisitionAttribute
{
    public function getResourceNameAttribute()
    {
        return "<b>".$this->number."</b> <br>".
            $this->type->title."<br>".
            $this->user->full_name_formatted."<br>".
            $this->user->designation_title;
    }

    public function updatingTotalAmount()
    {
        return (new RequisitionRepository())->updatingTotalAmount($this);
    }
}
