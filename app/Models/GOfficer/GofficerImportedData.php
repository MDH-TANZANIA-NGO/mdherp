<?php

namespace App\Models\GOfficer;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class GofficerImportedData extends BaseModel
{
    //

    public function gOfficer()
    {
    return $this->belongsTo(GOfficer::class, 'phone', 'phone');
    }
}
