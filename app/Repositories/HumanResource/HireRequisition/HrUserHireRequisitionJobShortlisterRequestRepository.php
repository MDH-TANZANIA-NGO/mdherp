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
use Ramsey\Uuid\Guid\Guid;

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

    public function update($uuid, $input)
    {
        return DB::transaction(function() use($input, $uuid){
            $shortlister_request = $this->findByUuid($uuid);
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

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('hr_user_hire_requisition_job_shortlister_requests.id as id'),
            DB::raw('hr_user_hire_requisition_job_shortlister_requests.number as number'),
            DB::raw('hr_user_hire_requisition_job_shortlister_requests.uuid as uuid'),
            DB::raw("CONCAT_WS(' ',users.last_name, users.first_name) as user_name"),
            DB::raw("COUNT(hr_user_hire_requisition_job_shortlisters.id) as number_of_jobs"),
        ])
        ->join('hr_user_hire_requisition_job_shortlisters','hr_user_hire_requisition_job_shortlisters.hr_user_hire_requisition_job_shortlister_request_id','hr_user_hire_requisition_job_shortlister_requests.id')
        ->join('users','users.id', 'hr_user_hire_requisition_job_shortlister_requests.user_id')
        ->groupBy('hr_user_hire_requisition_job_shortlister_requests.id','users.last_name', 'users.first_name');
    }


    /** 
     * get Access Processing
     * 
    */
    public function getProcessing()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_user_hire_requisition_job_shortlister_requests.wf_done', 0)
            ->where('hr_user_hire_requisition_job_shortlister_requests.done', true)
            ->where('hr_user_hire_requisition_job_shortlister_requests.rejected', false);
    }


    /** 
     * get Access Returned For Modification
     * 
    */
    public function getReturnedForModification()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_user_hire_requisition_job_shortlister_requests.wf_done', 0)
            ->where('hr_user_hire_requisition_job_shortlister_requests.done', true)
            ->where('hr_user_hire_requisition_job_shortlister_requests.rejected', true);
    }

    /** 
     * get Access Approved
     * @return mixed
    */
    public function getApproved()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_user_hire_requisition_job_shortlister_requests.wf_done', 1)
            ->where('hr_user_hire_requisition_job_shortlister_requests.done', true)
            ->where('hr_user_hire_requisition_job_shortlister_requests.rejected', false);
    }

    /** 
     * get Access Saved
     * @return mixed
    */
    public function getSaved()
    {
        return $this->getQuery()
            ->whereDoesntHave('wfTracks')
            ->where('hr_user_hire_requisition_job_shortlister_requests.wf_done', 0)
            ->where('hr_user_hire_requisition_job_shortlister_requests.done', false)
            ->where('hr_user_hire_requisition_job_shortlister_requests.rejected', false);
    }

}