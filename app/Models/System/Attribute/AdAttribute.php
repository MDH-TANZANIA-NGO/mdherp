<?php

namespace App\Models\System\Attribute;

trait AdAttribute
{


    public function getCreatedAtFormattedAttribute()
    {
        return short_date_format($this->created_at);
    }


    public function getChargeAmountFormattedAttribute()
    {
        return number_2_format($this->charge_amount);
    }

}