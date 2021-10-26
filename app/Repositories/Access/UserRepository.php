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
        ];
    }

    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            $user = $this->query()->create($this->processInputs($inputs));
        });
    }
}
