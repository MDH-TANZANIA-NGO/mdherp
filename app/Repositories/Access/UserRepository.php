<?php

namespace App\Repositories\Access;

use App\Exceptions\GeneralException;
use App\Models\Auth\SupervisorUser;
use App\Models\Auth\User;
use App\Models\System\Region;
use App\Models\Workflow\UserWfDefinition;
use App\Notifications\Auth\EmailResetPasswordNotification;
use App\Notifications\Auth\ResetPasswordNotification;
use App\Notifications\Auth\SendConfirmationCode;
use App\Notifications\Auth\SendConfirmationCodeAndPassword;
use App\Notifications\Auth\UserNeedsConfirmation;
use App\Notifications\Staff\NewPasswordNotification;
use App\Repositories\BaseRepository;
use App\Services\Generator\Username;
use App\Services\Phone\PhoneNumberFormat;
use App\Services\Reset\ResetPasswordTrait;
use Carbon\Carbon;
use Closure;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Support\Facades\DB;
use App\Repositories\Access\SupervisorUserRepository;
use App\Repositories\Workflow\WfDefinitionRepository;

class UserRepository extends BaseRepository
{
    use ResetPasswordTrait, SendsPasswordResetEmails, Username;

    const MODEL = User::class;

    protected $user_account_cv_id = 9;

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query()
            ->select([
                DB::raw("users.id AS user_id"),
                DB::raw("concat_ws(' ', users.first_name, users.last_name) as name"),
                DB::raw("code_values.name as gender"),
                DB::raw('users.phone as phone'),
                DB::raw("concat_ws(' ', units.name, designations.name) as designation"),
                DB::raw('regions.name as region'),
                DB::raw("users.isactive as isactive"),
                DB::raw("users.uuid as uuid"),
                DB::raw("users.email as email"),
//                DB::raw("users.fingerprint_length as fingerprint_length"),
//                DB::raw("users.fingerprint_data as fingerprint_data"),
            ])
            ->leftjoin('regions', 'regions.id', 'users.region_id')
            ->leftjoin('code_values', 'code_values.id', 'users.gender_cv_id')
            ->leftjoin('designations', 'designations.id', 'users.designation_id')
            ->leftjoin('units', 'units.id', 'designations.unit_id');
//            ->where('users.user_account_cv_id', '!=', $this->user_account_cv_id);
    }

    public function getUserByEmail($email)
    {
        return $this->query()
            ->select([
                DB::raw("users.id as user_id"),
                DB::raw("users.first_name as first_name"),
                DB::raw("users.last_name as last_name"),
                DB::raw("code_values.name as gender"),
                DB::raw("users.phone as phone"),
                DB::raw("users.email as email"),
                DB::raw("users.password as password"),
                DB::raw("users.isactive as isactive"),
                DB::raw("concat_ws(' ', units.name, designations.name) as designation"),
                DB::raw("regions.name as region"),
                DB::raw("users.uuid as uuid"),
                DB::raw("users.created_at as created_at"),
                DB::raw("users.updated_at as updated_at"),
                DB::raw("users.assigned as assigned"),
                DB::raw("users.uni as uni"),
                DB::raw("users.deleted_at as deleted_at"),
            ])
            ->join('regions', 'regions.id', 'users.region_id')
            ->leftjoin('code_values', 'code_values.id', 'users.gender_cv_id')
            ->leftjoin('designations', 'designations.id', 'users.designation_id')
            ->leftjoin('units', 'units.id', 'designations.unit_id')
            ->where('users.email', $email);
    }

    public function getSubstituteUser($substitute_id)
    {
        return $this->query()
            ->select([
                DB::raw("users.id as user_id"),
                DB::raw("users.first_name as first_name"),
                DB::raw("users.last_name as last_name"),
                DB::raw("code_values.name as gender"),
                DB::raw("users.phone as phone"),
                DB::raw("users.email as email"),
                DB::raw("users.password as password"),
                DB::raw("users.isactive as isactive"),
                DB::raw("concat_ws(' ', units.name, designations.name) as designation"),
                DB::raw("regions.name as region"),
                DB::raw("users.uuid as uuid"),
                DB::raw("users.created_at as created_at"),
                DB::raw("users.updated_at as updated_at"),
                DB::raw("users.assigned as assigned"),
                DB::raw("users.uni as uni"),
                DB::raw("users.deleted_at as deleted_at"),
            ])
            ->join('regions', 'regions.id', 'users.region_id')
            ->leftjoin('code_values', 'code_values.id', 'users.user_gender_cv_id')
            ->leftjoin('designations', 'designations.id', 'users.designation_id')
            ->leftjoin('units', 'units.id', 'designations.unit_id')
            ->where('users.id', $substitute_id);
    }


    /**
     * create new user
     * @param $input
     * @return mixed
     */
    public function create($input)
    {
        return DB::transaction(function () use($input) {
            $user = $this->query()->create([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['uni'].config('icap.email'),
                'password' => Hash::make(Carbon::now()),
                'region_id' => $input['region'],
                'designation_id' => $input['designation'],
                'uni' => $input['uni'],
                'isactive' => true,
            ]);
            $this->assignRoleAndAttachPermissions($user, $input);
            $user->wfDefinitions()->attach(1);
            $reset_link = $this->resetLink($user);
            $user->notify(new ResetPasswordNotification($reset_link));
            return $user;
        });
    }

    public function assignRoleAndAttachPermissions(User $user, $input)
    {
        return DB::transaction(function () use ($user, $input){
            $role_id = isset($input['role']) ? $input['role'] : 2;
            /*Assign role*/
            $user->attachRole($role_id);
            /*Attach Permissions*/
            $permissions = \DB::table('permission_role')->where(['role_id' => $role_id])->pluck('permission_id');
            $user->permissions()->sync($permissions);
            if(isset($input['definitions'])){
                $user->wfDefinitions()->sync($input['definitions']);
            }
            return true;
        });
    }

    /**
     * update Staff permissions
     * @param User $user
     * @param $input
     * @return mixed
     */
    public function updatePermissions(User $user,$input)
    {
        return DB::transaction(function () use($user,$input) {
            $user->permissions()->sync($input['permissions']);
        });
    }

    /**
     * Reset Password and send email
     * @param User $user
     */
    public function resetPassword(User $user)
    {
        $reset_link = $this->resetLink($user);
        $user->notify(new ResetPasswordNotification($reset_link));
    }

    /**
     * Reset Password and send email
     * @param $email
     * @throws GeneralException
     */
    public function resetPasswordWithoutAuth($email)
    {
        $user = $this->query()->where('email', $email);
        if($user->count()){
            $reset_link = $this->resetLink($user->first());
            $user->first()->notify(new EmailResetPasswordNotification($reset_link));
        }else{
            throw new GeneralException('Email not Found');
        }
    }

    /**
     * @return mixed
     */
    public function getForDatatables()
    {
        return $this->getQuery()->whereNotNull('users.uni');
    }

    /**
     * update User isactive state
     * @param User $user
     * @return mixed
     */
    public function UpdateIsActivate(User $user)
    {
        return DB::transaction(function () use ($user){
            $status = $user->isactive == 1 ? 0 : 1;
            return $user->update([
                'isactive' => $status
            ]);
        });
    }

    public function update(User $user, $inputs)
    {
        return DB::transaction(function () use ($user, $inputs){
            $user->update([
                'first_name' => $inputs['first_name'],
                'last_name' => $inputs['last_name'],
                'email' => $inputs['email'],
                'region_id' => $inputs['region'],
                'designation_id' => $inputs['designation'],
                'user_account_cv_id' => $inputs['account_type'],
                'dob' => isset($inputs['dob']) ? $inputs['dob'] : NULL,
                'hire_date' => isset($inputs['hire_date']) ? $inputs['hire_date'] : NULL,
                'vacation_spent' => isset($inputs['vacation_spent']) ? $inputs['vacation_spent'] : NULL,
                'carry_over' => isset($inputs['carry_over']) ? $inputs['carry_over'] : NULL,
            ]);
//            $user->detachRole($inputs['role']);
//            $this->assignRoleAndAttachPermissions($user, $inputs);
            return $user;
        });
    }

    /**
     * Return all users which have not assigned a supervisor
     * @return mixed
     */
    public function allForDualist()
    {
        return $this->query()->select([
            DB::raw("DISTINCT(users.id) AS id"),
            DB::raw("concat_ws(' ', users.first_name, users.last_name) as name"),
            DB::raw("users.isactive as isactive"),
            DB::raw("users.uni as uni"),
            DB::raw("supervisor_users.supervisor_id as supervisor_id")
        ])
            ->leftjoin('supervisor_users','supervisor_users.user_id', 'users.id')
//            ->where('users.id',"!=",1)
            ->where('users.isactive',1)
//            ->orderBy('users.first_name', 'ASC')
            ->orderBy('users.id', 'ASC');
    }

    public function getCheckDualist($supervisor_id)
    {
        $return = $this->allForDualist();
        if($supervisor_id)
            $return = $return->where('users.id', '<>', $supervisor_id);
        return $return->get();
    }

    public function getCount()
    {
        return $this->query()->where('id',"<>",1)->count();
    }

    /**
     * Return all users which have not assigned a supervisor
     * @return mixed
     */
    public function allForDualistPermissions()
    {
        return $this->query()->select([
            DB::raw("DISTINCT(users.id) AS id"),
            DB::raw("concat_ws(' ', users.first_name, users.last_name) as name"),
            DB::raw("users.isactive as isactive"),
            DB::raw("users.uni as uni"),
            DB::raw("wf_definitions.id as wf_definition_id")
        ])
            ->leftjoin('user_wf_definition','user_wf_definition.user_id', 'users.id')
            ->leftjoin('wf_definitions','wf_definitions.id', 'user_wf_definition.wf_definition_id')
            ->where('users.isactive',1)
            ->orderBy('users.id', 'ASC');
    }

    public function getCheckWithWfDefinitionsForDualist($wf_definition_id)
    {
        return $this->allForDualistPermissions()
            ->groupBy([
//                'user_wf_definition.wf_definition_id',
                'users.id','users.first_name','users.last_name',
                'users.isactive','users.uni',
//                'supervisor_users.supervisor_id',
                'wf_definitions.id'
            ])
            ->get();
    }

    public function getAllActive(){
        return $this->getQuery()->where('users.id', "!=", access()->id())->where('users.isactive', 1)->whereNotNull('users.uni');
    }

    public function getAllPluck(){
        return $this->getAllActive()->pluck('name', 'user_id');
    }

    public function delegateSupervision($inputs){
        #update supervisor
        (new SupervisorUserRepository())->updateSupervisor($inputs);

        #give supervision to the current user
        $this->query()->find($inputs['user'])->update(['user_account_cv_id' => 8]);

        //update user work flow definition
        (new WfDefinitionRepository())->delegateUser($inputs);

    }

    public function getAllUserWithPermissionAndWorkflow()
    {
        return DB::table('permission_user_workflow_view');
    }

    /**
     *
     * @return mixed
     */
    public function getApiAuth()
    {
        return $this->getQuery()
            ->where('users.id',access()->id())->first();
    }

    /**
     * @return mixed
     */
    public function getOfficeForDatatables()
    {
        return $this->query()
            ->select([
                DB::raw("users.id AS office_id"),
                DB::raw("users.name as name"),
                DB::raw("regions.name as region"),
                DB::raw("regions.id as region_id"),
            ])
            ->join('regions', 'regions.id', 'users.region_id')
            ->where('users.user_account_cv_id', config('icap.office_cvid'));
    }

    public function getAllOffices()
    {
        return $this->getOfficeForDatatables()->pluck('region', 'office_id');
    }

    /**
     * Store Office
     * @param $input
     * @return mixed
     */
    public function storeOffice($input)
    {
        $region = Region::query()->find($input['region_id']);
        return DB::transaction(function () use ($region){
            $username = $this->generateUserName($region->name);
            return $this->query()->create([
                'name' => $username,
                'region_id' => $region->id,
                'password' => bcrypt($username),
                'user_account_cv_id' => config('icap.office_cvid'),
                'isactive' => 1
            ]);
        });
    }

    public function updateStaffFingerprint($input){

        $user = User::where('uuid', '=', $input['uuid'])->first();
        $user->fingerprint_data = $input['fingerprint_data'];
        $user->fingerprint_length = $input['fingerprint_length'];
        $user->save();
        return $user;
    }

    /**
     * @param $input
     * @return bool
     */
    public function passwordVerification($input)
    {
        $is_matching = false;
        //checking user availability
        $user = $this->findByUuid($input['uuid']);
        //compare password
        if(Hash::check($input['password'], $user->password))
            $is_matching = true;
        return $is_matching;
    }

    /**
     * assign Definition to each selected users on Duallist
     * @param $inputs
     * @param $wf_definition_id
     * @return mixed
     */
    public function assignDefinition($inputs, $wf_definition_id)
    {
        return DB::transaction(function () use ($inputs, $wf_definition_id){
            $user_wf = UserWfDefinition::query();
            $user_wf->where('wf_definition_id', $wf_definition_id)->delete();
            if($inputs){
                foreach ($inputs as $user_id){
                    $user_wf->create(['user_id' => $user_id,'wf_definition_id' => $wf_definition_id]);
                }
            }
        });
    }

    /***
     * retrieve total annual balance available for any user
     * @param $user
     *
     */
    public function vocationDaysTotalBalance(User $user){
        $hire_date = Carbon::parse($user->hire_date);
        $start_calendar_date = Carbon::parse('2020-10-01');
        $end_calendar_date = Carbon::parse('2021-09-30');
        $current_day = Carbon::today()->toDateString();
        $total_balance = 0.0;

        if($hire_date->between($start_calendar_date, $end_calendar_date)){
            $total_balance = $hire_date->diffInMonths($current_day) * 1.83;
        }else{
            $total_balance = $start_calendar_date->diffInMonths($current_day) * 1.83;
        }

        return $total_balance;
    }

    /***
     * retrieve total annual balance available for access user
     * @param $user
     *
     */
    public function vocationDaysTotalAccess(){
        $hire_date = Carbon::parse(access()->user()->hire_date);
        $start_calendar_date = Carbon::parse('2020-10-01');
        $end_calendar_date = Carbon::parse('2021-09-30');
        $current_day = Carbon::today()->toDateString();
        $total_balance = 0.0;

        if($hire_date->between($start_calendar_date, $end_calendar_date)){
            $total_balance = $hire_date->diffInMonths($current_day) * 1.83;
        }else{
            $total_balance = $start_calendar_date->diffInMonths($current_day) * 1.83;
        }

        return $total_balance;
    }

    public function totalAnnualDays($user_id){
        $from = date('2020-10-01');
        $to = date('2021-09-30');
        return DB::table('leaves')
            ->join('users', 'leaves.user_id', '=', 'users.id')
            ->where('leaves.user_id', '=', $leave->user_id)
            ->where('leaves.leave_type_id', '=', 1)
            ->where('leaves.wf_done', '=', 1)
            ->whereBetween('leaves.created_at', [$from, $to])
            ->sum('leaves.days');
    }

      /***
     * retrieve total annual balance available for any user
     * @param $user
     *
     */

    public function personalDaysTotalBalance(User $user){
        $hire_date = Carbon::parse($user->hire_date);
        $start_calendar_date = Carbon::parse('2020-10-01');
        $end_calendar_date = Carbon::parse('2021-09-30');
        $current_day = Carbon::today()->toDateString();
        $total_balance = 0.0;

        if($hire_date->between($start_calendar_date, $end_calendar_date)){
             if($hire_date->diffInMonths($current_day) >= 6 && $hire_date->diffInMonths($current_day) < 11)
             {
                 $total_balance = 1.0;
             }else if($hire_date->diffInMonths($current_day) == 11)
             {
                 $total_balance = 2.0;
             }
        }else{
            $total_balance = $start_calendar_date->diffInMonths($current_day);
            if($start_calendar_date->diffInMonths($current_day) >= 6 && $start_calendar_date->diffInMonths($current_day) < 11)
             {
                 $total_balance = 1.0;
             }else if($start_calendar_date->diffInMonths($current_day) == 11)
             {
                 $total_balance = 2.0;
             }
        }

        return $total_balance;
    }

    public function personalDaysTotalBalanceAccess(){
        $hire_date = Carbon::parse(access()->user()->hire_date);
        $start_calendar_date = Carbon::parse('2020-10-01');
        $end_calendar_date = Carbon::parse('2021-09-30');
        $current_day = Carbon::today()->toDateString();
        $total_balance = 0.0;

        if($hire_date->between($start_calendar_date, $end_calendar_date)){
             if($hire_date->diffInMonths($current_day) >= 6 && $hire_date->diffInMonths($current_day) < 11)
             {
                 $total_balance = 1.0;
             }else if($hire_date->diffInMonths($current_day) == 11)
             {
                 $total_balance = 2.0;
             }
        }else{
            $total_balance = $start_calendar_date->diffInMonths($current_day);
            if($start_calendar_date->diffInMonths($current_day) >= 6 && $start_calendar_date->diffInMonths($current_day) < 11)
             {
                 $total_balance = 1.0;
             }else if($start_calendar_date->diffInMonths($current_day) == 11)
             {
                 $total_balance = 2.0;
             }
        }

        return $total_balance;
    }

    /**
     * getCheckWithGroupForDualist
     * @param $group_id
     * @return mixed
     */
    public function getCheckWithGroupForDualist()
    {
        return $this->query()->select([
            DB::raw("users.id AS id"),
            DB::raw("concat_ws(' ', users.first_name, users.last_name) as name"),
            DB::raw("users.isactive as isactive"),
            DB::raw("users.uni as uni"),
            DB::raw("groups.id as group_id")
        ])
            ->leftjoin('groups','groups.id', 'users.group_id')
            ->where('users.isactive',1)
            ->whereNotNull('uni')
            ->orderBy('users.first_name', 'ASC');
    }

    /**
     * assign group to each selected users on Duallist
     * @param $inputs
     * @param $wf_definition_id
     * @return mixed
     */
    public function assignGroup($inputs, $group_id)
    {
        return DB::transaction(function () use ($inputs, $group_id){
            if($inputs){
                foreach ($inputs as $user_id){
//                    $user_wf->create(['user_id' => $user_id,'wf_definition_id' => $wf_definition_id]);
                    $this->query()->find($user_id)->update(['group_id'=>$group_id]);

                }
            }
        });
    }

}
