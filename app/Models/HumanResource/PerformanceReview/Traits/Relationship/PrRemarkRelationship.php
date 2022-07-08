<?php

namespace App\Models\HumanResource\PerformanceReview\Traits\Relationship;

use App\Models\Auth\User;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Models\System\CodeValue;

trait PrRemarkRelationship
{
    public function prReport()
    {
        return $this->belongsTo(PrReport::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function remarkTitle()
    {
        return $this->belongsTo(CodeValue::class,'pr_remark_cv_id','id');
    }
}