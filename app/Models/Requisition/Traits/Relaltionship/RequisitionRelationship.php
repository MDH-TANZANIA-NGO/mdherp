<?php

namespace App\Models\Requisition\Traits\Relaltionship;

use App\Models\Requisition\Item\RequisitionItem;
use App\Models\Requisition\RequisitionType\RequisitionType;
use App\Models\Workflow\WfTrack;

trait RequisitionRelationship
{
    public function type()
    {
        return $this->belongsTo(RequisitionType::class,'requisition_type_id','id');
    }

    public function items()
    {
        return $this->hasMany(RequisitionItem::class,'requisition_id','id')->orderBy('id');
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

}
