<?php

namespace App\Models\Facility;

use Illuminate\Database\Eloquent\Model;

class FacilityType extends Model
{
    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }
}
