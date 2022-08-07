<?php

namespace App\Models\Activities\Reports;


use App\Models\Activities\Traits\ActivityReportAttribute;
use App\Models\Auth\User;
use App\Models\BaseModel;
use App\Models\Requisition\Requisition;
use App\Models\System\Region;
use App\Models\Workflow\WfTrack;
use Illuminate\Database\Eloquent\Model;

class ActivityReport extends BaseModel
{
    use ActivityReportAttribute;
    //

    /**
     * @return mixed
     */
    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
