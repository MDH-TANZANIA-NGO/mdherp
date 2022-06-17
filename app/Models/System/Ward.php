<?php

namespace App\Models\System;

use App\Models\Facility\Facility;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $guarded = [];

    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
