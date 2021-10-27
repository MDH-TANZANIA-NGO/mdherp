<?php

namespace App\Repositories\Access;

use App\Models\Auth\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository
{
    const MODEL = User::class;

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
        ];
    }

    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            $user = $this->query()->create($this->processInputs($inputs));
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
            DB::raw('regions.name AS region'),
            DB::raw("CONCAT_WS(' ', units.name, designations.name) AS designation"),
            DB::raw("string_agg(DISTINCT projects.title, ',') as project_list"),
        ])
            ->join('regions','regions.id', 'users.region_id')
            ->join('designations','designations.id','users.designation_id')
            ->join('units','units.id','designations.unit_id')
            ->join('project_user','project_user.user_id','users.id')
            ->join('projects','projects.id','project_user.project_id')
            ->groupBy('users.id','users.first_name','users.last_name','units.name','designations.name','users.phone','users.uuid','regions.name');
    }

    public function getActive()
    {
        return $this->getQuery()
            ->where('active', false);
    }

}
