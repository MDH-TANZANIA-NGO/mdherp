<?php

namespace App\Models\System;

use App\Models\System\Attribute\CountryAttribute;
use App\Models\System\Relationship\CountryRelationship;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use  CountryAttribute, CountryRelationship;


/*---------Attribute -------------*/

    /*Get Country flag*/
    public function getFlagAttribute()
    {
      //return "<span title='" . $this->name . "'>".@include('includes.country_flag' .',' . '[' . 'country_flag' . '=>' . $this->code . ']') . "</span>";
        return view('system.includes.country_flag')->with(['country_code' => $this->code, 'country_name' => $this->name]);
    }

}
