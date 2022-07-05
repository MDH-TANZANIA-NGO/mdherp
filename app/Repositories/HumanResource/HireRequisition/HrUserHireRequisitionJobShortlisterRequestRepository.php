<?php

namespace App\Repositories\HumanResource\HireRequisition;

use App\Exceptions\GeneralException;
use App\Models\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlisterRequest;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class HrUserHireRequisitionJobShortlisterRequestRepository extends BaseRepository
{
    const MODEL = HrUserHireRequisitionJobShortlisterRequest::class;

    public function store($input)
    {
        $this->checkIfHrHireRequisitionsJobSelected($input);
        return DB::transaction(function() use($input){
            $shortlister_request = $this->query()->create(['user_id' => access()->id()]);
            (new HrUserHireRequisitionJobShortlisterRepository())->attachRequestAndJob($shortlister_request, $input);
            return $shortlister_request;
        });
    }

    public function checkIfHrHireRequisitionsJobSelected($input)
    {
        if(!isset($input['hr_hire_requisitions_job_ids'])){
            throw new GeneralException('Please select atleast one job to proceed');
        }
    }
}