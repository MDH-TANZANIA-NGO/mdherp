<?php

namespace App\Models\JobOffer;

use App\Models\Auth\User;
use App\Models\BaseModel;
use App\Models\HumanResource\HireRequisition\HrHireApplicant;
use Illuminate\Database\Eloquent\Model;

class JobOfferRemark extends BaseModel
{
    //
    public function jobOffer()
    {
        return $this->hasMany(JobOffer::class);
    }
    public function jobOfferApplicant()
    {
        return $this->belongsTo(HrHireApplicant::class,'applicant_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
