<?php

namespace App\Models\Hotel;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class HotelOwner extends BaseModel
{
    //
    public function vendor()
    {
        return $this->hasOne(Vendor::class);
    }
    public function hotel()
    {
        return $this->hasOne(Hotel::class);
    }
}
