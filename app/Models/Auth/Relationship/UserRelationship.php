<?php

namespace App\Models\Auth\Relationship;

use App\Models\Auth\Role;
use App\Models\Auth\Permission;
use App\Models\Auth\SupervisorUser;
use App\Models\Project\Project;
use App\Models\Project\SubProgram;
use App\Models\System\CodeValue;
use App\Models\System\Region;
use App\Models\Taf\Taf;
use App\Models\Time\Time;
use App\Models\Unit\Designation;
use App\Models\Workflow\WfDefinition;
use App\Models\Workflow\WfTrack;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserRelationship
{
    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    public function userAccounts()
    {
        return $this->belongsToMany(CodeValue::class, "user_accounts", "user_id", "user_account_cv_id");
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function logs()
    {
        return $this->hasMany('user_logs','user_id','id');
    }

    /**
     * @return mixed
     */
    public function wfTracks()
    {
        //return $this->hasMany(WfTrack::class);
        return $this->morphMany(WfTrack::class, 'user','id');
    }

    /**
     * @return mixed
     */
    public function wfTracksUser()
    {
        //return $this->hasMany(WfTrack::class);
        return $this->hasMany(WfTrack::class);
    }

    public function wfDefinitions()
    {
        return $this->belongsToMany(WfDefinition::class, 'user_wf_definition');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function assignedSupervisor()
    {
        return $this->hasOne(SupervisorUser::class,'user_id','id')->first();
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class)->withTimestamps();
    }

    public function subProgram()
    {
        return $this->belongsToMany(SubProgram::class, 'sub_program_user');
    }

    public function times()
    {
        return $this->hasMany(Time::class);
    }
}
