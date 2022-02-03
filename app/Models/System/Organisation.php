<?php

namespace App;

use App\Models\BaseModel;
use App\Models\System\Country;
use Illuminate\Database\Eloquent\Model;

class Organisation extends BaseModel
{
    public function countries()
    {
        return $this->belongsToMany(Country::class);
    }
}
