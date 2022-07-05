<?php

namespace App\Repositories\HumanResource\HireRequisition;

use App\Models\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlister;
use App\Models\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlisterRequest;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class HrUserHireRequisitionJobShortlisterRepository extends BaseRepository
{
    const MODEL = HrUserHireRequisitionJobShortlister::class;

    public function attachRequestAndJob(HrUserHireRequisitionJobShortlisterRequest $hr_user_hire_requisition_job_shortlister_request, $inputs)
    {
        return DB::transaction(function() use($hr_user_hire_requisition_job_shortlister_request, $inputs){
            foreach($inputs['hr_hire_requisitions_job_ids'] as $hr_hire_requisitions_job_id )
            {
                $this->query()->create([
                    'hr_user_hire_requisition_job_shortlister_request_id' => $hr_user_hire_requisition_job_shortlister_request->id,
                    'hr_hire_requisitions_job_id' => $hr_hire_requisitions_job_id
                ]);
            }
        });
    }
}