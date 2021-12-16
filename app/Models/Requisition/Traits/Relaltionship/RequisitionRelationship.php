<?php

namespace App\Models\Requisition\Traits\Relaltionship;

use App\Models\Auth\User;
use App\Models\Budget\Budget;
use App\Models\GOfficer\GOfficer;
use App\Models\Project\Activity;
use App\Models\Project\Project;
use App\Models\Requisition\Item\RequisitionItem;
use App\Models\Requisition\RequisitionType\RequisitionType;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Training\requisition_training_item;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
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
        return $this->hasMany(requisition_training_cost::class,'requisition_id','id')->orderBy('id');
    }
    public function training()
    {
    return $this->hasMany(requisition_training::class);
    }
    public function trainingItems()
    {
        return $this->hasMany(requisition_training_item::class, 'requisition_id', 'id')->orderBy('id');
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

}
