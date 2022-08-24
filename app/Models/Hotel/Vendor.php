<?php

namespace App\Models\Hotel;

use App\Models\BaseModel;
use App\Models\System\Region;
use Illuminate\Database\Eloquent\Model;

class Vendor extends BaseModel
{
    //
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class)->withPivot('id');


    }
}
