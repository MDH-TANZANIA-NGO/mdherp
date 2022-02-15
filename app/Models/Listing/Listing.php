<?php

namespace App\Models\Listing;

use App\Models\Auth\User;
use App\Models\BaseModel;

class Listing extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workingTools(){
        return $this->belongsToMany(WorkingTool::class, 'listing_working_tool');
    }
}
