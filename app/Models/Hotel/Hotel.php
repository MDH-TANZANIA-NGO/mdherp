<?php

namespace App\Models\Hotel;

use App\Models\BaseModel;
use App\Models\System\District;
use Illuminate\Database\Eloquent\Model;

class Hotel extends BaseModel
{
    //
   public function district()
   {
       return $this->belongsTo(District::class);
   }
}
