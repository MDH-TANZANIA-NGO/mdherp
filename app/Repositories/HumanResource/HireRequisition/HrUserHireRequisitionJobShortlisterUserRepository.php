<?php

namespace App\Repositories\HumanResource\HireRequisition;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Models\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlisterUser;

class HrUserHireRequisitionJobShortlisterUserRepository extends BaseRepository
{
    const MODEL = HrUserHireRequisitionJobShortlisterUser::class;

    public function store($input, $hr_user_shortlister_id)
    {
        return DB::transaction(function() use($input, $hr_user_shortlister_id){
            if(isset($input['users'])){
                $this->query()->where('hr_user_hire_requisition_job_shortlister_id', $hr_user_shortlister_id)->delete();
                foreach($input['users'] as $user_id){
                    $this->query()->create([
                        'hr_user_hire_requisition_job_shortlister_id' => $hr_user_shortlister_id,
                        'user_id' => $user_id
                    ]);
                }
            }
        });
    }
}