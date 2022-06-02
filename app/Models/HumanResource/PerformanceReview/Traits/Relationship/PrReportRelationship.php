<?php

namespace App\Models\HumanResource\PerformanceReview\Traits\Relationship;

use App\Models\HumanResource\PerformanceReview\PrType;
use App\Models\Workflow\WfTrack;

trait PrReportRelationship
{
    /**
     * @return mixed
     */
    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }

    public function type()
    {
        return $this->belongsTo(PrType::class,'pr_type_id','id');
    }
}
