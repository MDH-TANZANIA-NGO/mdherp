<?php

namespace App\Models\JobOffer;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class JobOfferRemark extends BaseModel
{
    //
    public function jobOffer()
    {
        return $this->hasMany(JobOffer::class);
    }
}
