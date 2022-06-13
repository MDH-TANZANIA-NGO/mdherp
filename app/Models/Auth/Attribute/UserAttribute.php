<?php

namespace App\Models\Auth\Attribute;

use App\Models\Auth\SupervisorUser;
use App\Models\Auth\User;
use App\Repositories\Access\UserRepository;
use App\Repositories\Unit\DesignationRepository;
use App\Services\Phone\PhoneFormatter;
use Carbon\Carbon;

trait UserAttribute
{
    /**
     * Set the user's email.
     *
     * @param  string  $value
     * @return void
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower(trim(preg_replace('/\s+/', '', $value)));
    }

    /**
     * Set the user's name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(trim($value));
    }

    /**
     * Set the user's name.
     *
     * @param  string  $value
     * @return void
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucwords(trim($value));
    }

    /**
     * Set the user's name.
     *
     * @param  string  $value
     * @return void
     */
    public function setMiddleNameAttribute($value)
    {
        $this->attributes['middle_name'] = ucwords(trim($value));
    }

    /**
     * Set the user's name.
     *
     * @param  string  $value
     * @return void
     */
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucwords(trim($value));
    }

    public function setPhoneAttribute($value){
        $this->attributes['phone'] = (new PhoneFormatter($value))->phone;
    }

    public function getResourceNameModifiedAttribute()
    {
        return $this->full_name." | ".$this->uni;
    }

    public function getDesignationTitleAttribute()
    {
        return (new DesignationRepository())->getDesignationById($this->designation_id);
    }


    /**
     * Set the user's name.
     *
     * @param  string  $value
     * @return void
     */
    public function setOthernamesAttribute($value)
    {
        $this->attributes['othernames'] = ucwords(trim($value));
    }

    public function getFullNameAttribute() {
        return ucfirst($this->last_name) . ", " . ucfirst($this->first_name);
    }

    public function getFullNameFormattedAttribute()
    {
        return ucfirst($this->first_name) . " " . ucfirst($this->last_name);
    }

    // public function getHireDateAttribute(){
    //     return $this->hire_date;
    // }

    // public function getDobAttribute(){
    //     return $this->dob;
    // }

    // public function getRemainingDaysAttribute(){
    //     return $this->getRemainingDays;
    // }


    public function getCreatedAtFormattedAttribute()
    {
        return  Carbon::parse($this->created_at)->format('d-M-Y');
    }

    public function getLastLoginFormattedAttribute()
    {
        return  Carbon::parse($this->last_login)->format('d-M-Y');
    }


    public function getUserAccountsLabelAttribute()
    {
        $account_types = [];
        if ($this->userAccounts()->count() > 0) {
            foreach ($this->userAccounts as $account_type) {
                array_push($account_types, $account_type->name);
            }
            return implode(", ", $account_types);
        } else {
            return '';
        }
    }

    public function getRoleNameAttribute()
    {
        return ucwords($this->roles()->first()->name);
    }


    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->isactive == true;
    }

    public function getStatusBadgeAttribute()
    {
        return $this->isactive == 0 ? "<span class='badge badge-danger'>InActive</span>" : "<span class='badge badge-success'>Active</span>";
    }

    /**
     * has workflow definitions
     * @param $wf_definition_id
     * @return bool
     */
    public function hasWfDefinition($wf_definition_id)
    {
        foreach ($this->wfDefinitions()->get() as $wf_definition)
        {
            if ($wf_definition->id == $wf_definition_id) {
                return true;
            }
        }
    }

    public function checkPermission($permission_id)
    {
        foreach ($this->permissions()->get() as $permission)
        {
            if ($permission->id == $permission_id) {
                return true;
            }
        }
    }


    public function getUserAccountTypeAttribute(){
        return $this->userAccounts()->first()->pivot->user_account_cv_id;
    }




    /**
    * Hashing Password attributes Automatically..
    */
    /*public function setPasswordAttribute($value)
    {
        //$this->attributes['password'] = Hash::make($value);
    }*/


    public function userRoles()
    {
        foreach ($this->roles()->get() as $role) {
            return $role;
        }
    }

    public function getTitleAttribute()
    {
        return $this->designation->unit->name. " ".$this->designation->name;
    }


    public function getActionButtonAttribute()
    {
        return "<div class='btn-group-sm mt-0' style='margin-top: -5px'>
                            <a href='users/$this->uuid/profile' class='btn btn-default btn-sm'>View</a>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                              <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                              <a class='dropdown-item' href='users/$this->uuid/Update-active-status'>Activate / Deactivate</a>
                              <div class='dropdown-divider'></div>
                              <a class='dropdown-item' href=''/>Reset Password</a>
                            </div>
                        </div> ";
    }

    public function getAssignedSupervisorAttribute()
    {
        $assigned = "Not Assigned";
        if  ($this->assigned){
            $assigned = User::query()->findOrFail($this->assignedSupervisor()->supervisor_id)->full_name;
        }
        return $assigned;
    }

    public function getApiAuthAttribute()
    {
        $user_repo = (new UserRepository());
        return $user_repo->getApiAuth();
    }

    public function getSupervisorFullNameAttribute()
    {
        return User::query()->findOrFail($this->assignedSupervisor()->supervisor_id)->full_name_formatted;
    }

    public function getSupervisorRegionNameAttribute()
    {
        return User::query()->findOrFail($this->assignedSupervisor()->supervisor_id)->region->name;
    }

    public function getSupervisorDesignationAttribute()
    {
        $user = User::query()->findOrFail($this->assignedSupervisor()->supervisor_id);
        return $user->designation->unit->name. " " .$user->designation->name;
    }

    public function getHasSupervisorAttribute()
    {
        $return = false;
        $check = SupervisorUser::query()->where('user_id', $this->id);
        if($check->count()){
            $return = true;
        }
        return $return;
    }


    public function getVacationDaysBalanceAttribute()
    {
        $user_repo = (new UserRepository());
        return $user_repo->vocationDaysTotalAccess();
    }

    public function getPersonalDaysBalanceAttribute()
    {
        $user_repo = (new UserRepository());
        return $user_repo->personalDaysTotalBalanceAccess();
    }

}
