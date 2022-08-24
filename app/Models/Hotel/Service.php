<?php

namespace App\Models\Hotel;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Service extends BaseModel
{
    //
    public function vendor()
    {
        return $this->belongsToMany(Vendor::class);
    }
}
