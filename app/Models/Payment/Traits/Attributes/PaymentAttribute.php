<?php

namespace App\Models\Payment\Traits\Attributes;

trait PaymentAttribute
{
    public function getResourceNameAttribute()
    {
        return "<b>".$this->number."</b> <br>".
            $this->user->full_name_formatted."<br>".
            $this->user->designation_title;
    }

    public function setRequestedAmountAttribute($value)
    {
        return $this->attributes['requested_amount'] = (int)$value;
    }
}
