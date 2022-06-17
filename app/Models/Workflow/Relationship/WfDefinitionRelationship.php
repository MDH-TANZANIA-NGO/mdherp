<?php

namespace App\Models\Workflow\Relationship;


use App\Models\Member\Company\Company;
use App\Models\Port\Port;
use App\Models\Unit\Designation;
use App\Models\Unit\Unit;
use App\Models\Workflow\WfModule;
use App\Models\Auth\User;
use App\Repositories\Staff\DesignationRepository;

/**
 * Class WfDefinitionRelationship
 * @package App\Models\Workflow\Relationship
 */
trait WfDefinitionRelationship
{
    /**
     * @return mixed
     */
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    /**
     * @return mixed
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * @return mixed
     */
    public function wfModule()
    {
        return $this->belongsTo(WfModule::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class/*,'user_wf_definition','user_id','id'*/)->withTimestamps();
    }

    public function wfDefinitionPort()
    {
        return $this->belongsToMany(Port::class,'wf_definition_port')->withPivot('current_position_pointer');
    }


}
