<?php

namespace App\Repositories\Access;

use App\Models\Auth\SupervisorUser;
use App\Models\Auth\User;
use App\Notifications\Auth\UserRegistrationNotification;
use App\Repositories\BaseRepository;
use App\Repositories\Project\SubProgramRepository;
use App\Services\Reset\ResetPasswordTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserRepository extends BaseRepository
{
    use ResetPasswordTrait;

    const MODEL = User::class;

    protected $user_account_cv_id = 9;

//    /**
//     * @return mixed
//     */
//    public function getQuery()
//    {
//        return $this->query()
//            ->select([
//                DB::raw("users.id AS user_id"),
//                DB::raw("concat_ws(' ', users.first_name, users.last_name) as name"),
//                DB::raw("code_values.name as gender"),
//                DB::raw('users.phone as phone'),
//                DB::raw("concat_ws(' ', units.name, designations.name) as designation"),
//                DB::raw('regions.name as region'),
//                DB::raw("users.isactive as isactive"),
//                DB::raw("users.uuid as uuid"),
//                DB::raw("users.email as email"),
////                DB::raw("users.fingerprint_length as fingerprint_length"),
////                DB::raw("users.fingerprint_data as fingerprint_data"),
//            ])
//            ->leftjoin('regions', 'regions.id', 'users.region_id')
//            ->leftjoin('code_values', 'code_values.id', 'users.gender_cv_id')
//            ->leftjoin('designations', 'designations.id', 'users.designation_id')
//            ->leftjoin('units', 'units.id', 'designations.unit_id');
////            ->where('users.user_account_cv_id', '!=', $this->user_account_cv_id);
//    }

    public function getUserByEmail($email)
    {
        return $this->query()
            ->select([
                DB::raw("users.id as user_id"),
                DB::raw("users.first_name as first_name"),
                DB::raw("users.last_name as last_name"),
                DB::raw("users.middle_name as middle_name"),
                DB::raw("users.employed_date as employed_date"),
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
                DB::raw("users.middle_name as middle_name"),
                DB::raw("users.employed_date as employed_date"),
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
   /* public function resetPassword(User $user)
    {
        $reset_link = $this->resetLink($user);
        $user->notify(new ResetPasswordNotification($reset_link));
    }*/

    public function resetPassword(User $user)
    {
        $reset_link = $this->resetLink($user);
        Log::info($reset_link);
        $user->notify(new UserRegistrationNotification($reset_link));
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
    private function processInputs($inputs)
    {
        return [
            'first_name' => $inputs['first_name'],
            'middle_name' => $inputs['middle_name'],
            'last_name' => $inputs['last_name'],
            'gender_cv_id' => $inputs['gender'],
            'phone' => $inputs['phone'],
            'email' => $inputs['email'],
            'dob' => $inputs['dob'],
            'designation_id' => $inputs['designation'],
            'region_id' => $inputs['region'],
            'marital_status_cv_id' => $inputs['marital'],
            'password' => config('app.key'),
            'supervisor' => isset($inputs['supervisor'])??false
        ];
    }

    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            $user = $this->query()->create($this->processInputs($inputs));
            $user->projects()->sync($inputs['projects']);
            $reset_link = $this->resetLink($user);
            Log::info($reset_link);
            $user->notify(new UserRegistrationNotification($reset_link));
            return $user;
        });
    }



    /**
     * Update User
     * @param User $user
     * @param $inputs
     * @return mixed
     */
    public function update(User $user, $inputs)
    {
        return DB::transaction(function () use ($user, $inputs){
            $user->update([
                'first_name' => $inputs['first_name'],
                'middle_name' => $inputs['middle_name'],
                'last_name' => $inputs['last_name'],
                'gender_cv_id' => $inputs['gender'],
                'phone' => $inputs['phone'],
                'email' => $inputs['email'],
                'dob' => $inputs['dob'],
                'designation_id' => $inputs['designation'],
                'region_id' => $inputs['region'],
                'employed_date' => $inputs['employed_date'],
                'marital_status_cv_id' => $inputs['marital'],
                'supervisor' => isset($inputs['supervisor'])??false,
//                'active' => $inputs['active']
            ]);
            if (isset($inputs['projects']))
                $user->projects()->sync($inputs['projects']);
            return $user;
        });
    }

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('users.id AS user_id'),
            DB::raw("CONCAT_WS(' ', users.first_name,users.last_name) AS name"),
            DB::raw('users.first_name AS first_name'),
            DB::raw('users.last_name AS last_name'),
            DB::raw('users.email AS email'),
            DB::raw('users.phone AS phone'),
            DB::raw('users.uuid AS uuid'),
            DB::raw('users.country_organisation_id as country_organisation_id'),
            DB::raw('regions.name AS region'),
            DB::raw("CONCAT_WS(' ', units.name, designations.name) AS designation"),
            DB::raw("string_agg(DISTINCT projects.title, ',') as project_list"),
        ])
            ->join('regions','regions.id', 'users.region_id')
            ->join('designations','designations.id','users.designation_id')
            ->join('units','units.id','designations.unit_id')
            ->leftjoin('project_user','project_user.user_id','users.id')
            ->leftjoin('projects','projects.id','project_user.project_id')
            ->groupBy('users.id','users.first_name','users.last_name','units.name','designations.name','users.phone','users.uuid','regions.name');
    }

    public function getActive()
    {
        return $this->getQuery()
            ->where('active', true);
    }
    public function getInactive()
    {
        return $this->getQuery()
            ->where('active', false);
    }

    /**
     *
     * @return mixed
     */
    public function getApiAuth()
    {
        return $this->getUserQuery()->where('users.id',access()->id())->first();
    }

    public function getUserQuery()
    {
        return $this->query()->select([
            DB::raw('users.id AS user_id'),
            DB::raw('users.identity_number As identity_number'),
            DB::raw("CONCAT_WS(' ', users.first_name,users.last_name) AS full_name"),
            DB::raw('users.first_name AS first_name'),
            DB::raw('users.last_name AS last_name'),
            DB::raw('users.gender_cv_id as gender_cv_id'),
            DB::raw('code_values.name as marital_status'),
            DB::raw('users.user_account_cv_id'),
            DB::raw('users.email AS email'),
            DB::raw('users.phone AS phone'),
            DB::raw('users.uuid AS uuid'),
            DB::raw('users.dob as dob'),
            DB::raw('users.employed_date as employed_date'),
            DB::raw('users.country_organisation_id as country_organisation_id'),
            DB::raw('regions.name AS region'),
            DB::raw("CONCAT_WS(' ', units.name, designations.name) AS designation"),
            DB::raw("string_agg(DISTINCT projects.title, ',') as project_list"),
        ])
            ->leftJoin('code_values', 'code_values.id', 'users.marital_status_cv_id')
            ->leftJoin('regions','regions.id', 'users.region_id')
            ->leftJoin('designations','designations.id','users.designation_id')
            ->leftJoin('units','units.id','designations.unit_id')
            ->leftJoin('project_user','project_user.user_id','users.id')
            ->leftJoin('projects','projects.id','project_user.project_id')
            ->groupBy('users.id','users.first_name','users.last_name','units.name','designations.name','users.phone','users.uuid','regions.name', 'code_values.id');
    }

    public function forSelect()
    {
        return $this->getQuery()->pluck('name', 'user_id');
    }

    public function assignSubProgramArea($uuid, $inputs)
    {
        return DB::transaction(function () use ($uuid, $inputs){
            //TODO detach
            $sub_program = (new SubProgramRepository())->findByUuid($uuid);
            return $sub_program->users()->attach($inputs['user']);
        });
    }

    public function getAllUsersWithSupervisor()
    {
        return $this->query()
            ->select([
                DB::raw('users.id AS user_id'),
                DB::raw("CONCAT_WS(' ', users.last_name, users.first_name) AS names"),
                DB::raw('supervisor_users.user_id AS s_user_id')
            ])
            ->leftjoin('supervisor_users','supervisor_users.user_id','users.id')
            ->orderBy('users.last_name');
    }

    public function getAllUsersWithNoSupervisorPluck($user_id)
    {
        return $this->getAllUsersWithSupervisor()->whereNull('supervisor_users.user_id')->where('users.id', '!=', $user_id)->pluck('names','user_id');
    }

    public function getAllUsersWithThisSupervisorPluck($user_id)
    {
        return $this->getAllUsersWithSupervisor()->where('supervisor_users.supervisor_id', $user_id)->get()->pluck('names', 'user_id')->toArray();
    }
    public function getAllUsersWithThisSupervisorGet($user_id)
    {
        return $this->getAllUsersWithSupervisor()->where('supervisor_users.supervisor_id', $user_id)->get();
    }

    public function assignSupervisor($user_id, $inputs)
    {
        return DB::transaction(function () use ($user_id, $inputs){
            if(isset($inputs['users'])){
                SupervisorUser::query()->where('supervisor_id', $user_id)->delete();
                foreach($inputs['users'] as $user_selected_id){
                    SupervisorUser::query()->create([
                        'supervisor_id' => $user_id,
                        'user_id' => $user_selected_id
                    ]);
                }
            }
        });
    }

    public function getDirectorOfDepartment($department_id)
    {
        return $this->query()
            ->select([
                'users.id AS user_id',
            ])
            ->join('designations','designations.id', 'users.id')
            ->join('departments','departments.id','designations.department_id')
            ->where('departments.id',$department_id)
            ->where('designations.unit_id', 1);
    }

    public function getCeo()
    {
        return $this->query()
            ->select([
                'users.id AS user_id',
            ])
            ->join('designations','designations.id', 'users.id')
            ->join('units','units.id','designations.unit_id')
            ->where('units.id', 5);
    }


}
