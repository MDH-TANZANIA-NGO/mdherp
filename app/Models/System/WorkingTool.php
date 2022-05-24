<?php

namespace App\Models\System;

use App\Models\Listing\Listing;
use Illuminate\Database\Eloquent\Model;

class WorkingTool extends Model
{
    protected $guarded = ['id'];

    public function listings(){
        return $this->belongsToMany(Listing::class, 'listing_working_tool');
    }
}
