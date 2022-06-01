<?php

namespace App\Models\HumanResource\PerformanceReview\Traits\Relationship;

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
}
