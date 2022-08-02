<?php

namespace App\Models\Requisition\Traits\Relaltionship;

use App\Models\Attendance\Hotspot;
use App\Models\Auth\User;
use App\Models\Budget\Budget;
use App\Models\GOfficer\GOfficer;
use App\Models\Payment\Payment;
use App\Models\ProgramActivity\ProgramActivity;
use App\Models\Project\Activity;
use App\Models\Project\Project;
use App\Models\Requisition\Item\RequisitionItem;
use App\Models\Requisition\RequisitionFundChecker;
use App\Models\Requisition\RequisitionType\RequisitionType;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Training\requisition_training_item;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\SafariAdvance\SafariAdvance;
use App\Models\System\Region;
use App\Models\Workflow\WfTrack;


trait RequisitionRelationship
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function typeCategory()
    {
        return $this->belongsTo(RequisitionType::class,'requisition_type_id','id');
    }
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(RequisitionItem::class,'requisition_id','id')->orderBy('id');
    }
    public function travellingCost()
    {
        return $this->hasMany(requisition_travelling_cost::class,'requisition_id','id')->orderBy('id');
    }
    public function trainingCost()
    {
        return $this->hasMany(requisition_training_cost::class,'requisition_id','id');
    }
    public function training()
    {
    return $this->hasMany(requisition_training::class);
    }
    public function trainingItems()
    {
        return $this->hasMany(requisition_training_item::class, 'requisition_id', 'id')->orderBy('id');
    }

    public function safariAdvance()
    {
        return $this->hasMany(SafariAdvance::class);
    }

    public function programActivity()
    {
        return$this->hasMany(ProgramActivity::class);
    }
    public function  payments()
    {
        return $this->hasOne(Payment::class);
    }
    public function fundChecker()
    {
        return $this->hasOne(RequisitionFundChecker::class);
    }


    /**
     * @return mixed
     */
    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }

    /**
     * @return mixed
     */
    public function documents()
    {
//        return $this->morphToMany(Document::class, 'resource', 'document_resource')->withPivot('id', 'name', 'description', 'ext', 'size', 'mime','is_active','parent','created_at')->orderBy('document_id', "ASC");
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);

    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }
    public function hotspots()
    {
        return $this->hasMany(Hotspot::class);
    }

}
