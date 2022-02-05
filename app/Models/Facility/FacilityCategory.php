<?php

namespace App\Models\Facility;

use App\Models\Facility\FacilityType;
use Illuminate\Database\Eloquent\Model;

class FacilityCategory extends Model
{
    //

    public function facility_types()
    {
        return $this->hasMany(FacilityType::class);
    }
}
