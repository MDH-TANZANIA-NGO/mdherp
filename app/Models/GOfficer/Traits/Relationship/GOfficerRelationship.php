<?php

namespace App\Models\GOfficer\Traits\Relationship;

use App\Models\Facility\Facility;
use App\Models\GOfficer\GScale;
use App\Models\ProgramActivity\ProgramActivityAttendance;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\System\District;
use App\Models\System\Region;

trait GOfficerRelationship
{
    public function scale()
    {
        return $this->belongsTo(GScale::class,'g_scale_id','id');
    }
    public function region()
    {
        return$this->belongsTo(Region::class, 'region_id','id');
    }
    public function Training()
    {
        return $this->belongsTo(requisition_training_cost::class, 'participant_uid', 'id');
    }
    public function programActivityAttendance()
    {
        return $this->belongsTo(ProgramActivityAttendance::class);
    }
    public function facilities()
    {
        return $this->belongsToMany(Facility::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }

}
