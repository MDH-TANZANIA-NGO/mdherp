<?php

namespace App\Models\SafariAdvance;

use App\Models\BaseModel;
use App\Models\Hotel\Hotel;
use Illuminate\Database\Eloquent\Model;

class SafariAdvanceHotelSelection extends BaseModel
{
    //
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
    public function safari()
    {
        return $this->belongsTo(SafariAdvance::class);
    }
}
