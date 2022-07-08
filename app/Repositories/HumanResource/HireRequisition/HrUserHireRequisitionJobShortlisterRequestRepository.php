<?php

namespace App\Repositories\HumanResource\HireRequisition;

use App\Services\Generator\Number;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Models\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlister;
use App\Jobs\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlisterJob;
use App\Models\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlisterUser;
use App\Models\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlisterRequest;

class HrUserHireRequisitionJobShortlisterRequestRepository extends BaseRepository
{
    use Number;
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

    /**
     * Update is done column and generate number
     * @param Requisition $requisition
     * @return mixed
     */
    public function updateDoneGenerateNumber($job_shortlister_request)
    {
        $this->checkIfHasWorkflow($job_shortlister_request);
        return DB::transaction(function () use ($job_shortlister_request) {
            return $job_shortlister_request->update(['done' => true,'number' => $this->generateNumber($job_shortlister_request)]);
        });
    }

    public function checkIfHasWorkflow($job_shortlister_request)
    {
        if($job_shortlister_request->wfTracks()->count()){
            throw new GeneralException('You can not submit twice');
        }
    }

    public function completedAndSendEmails($job_shortlister_request)
    {
        $job_shortlister_request->id;
        foreach($job_shortlister_request->jobs as $job){
            foreach($job->listUsers as $list){
                HrUserHireRequisitionJobShortlisterJob::dispatch($list->user, $list->job);
            }
        }
    }

}