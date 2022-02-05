<?php

namespace App\Models\Facility;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $guarded = [];

    public function facility_type()
    {
        return $this->belongsTo(FacilityType::class);
    }

    public function ownership()
    {
        return $this->belongsTo(Ownership::class);
    }
}
