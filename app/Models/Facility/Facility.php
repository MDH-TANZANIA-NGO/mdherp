<?php

namespace App\Models\Facility;

use App\Models\GOfficer\GOfficer;
use App\Models\System\Ward;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $guarded = [];

    protected $table = 'facilities';

    public function facility_type()
    {
        return $this->belongsTo(FacilityType::class);
    }

    public function ownership()
    {
        return $this->belongsTo(Ownership::class);
    }

    public function g_officers()
    {
        return $this->belongsToMany(GOfficer::class)->withPivot('id');
    }
    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }
}
