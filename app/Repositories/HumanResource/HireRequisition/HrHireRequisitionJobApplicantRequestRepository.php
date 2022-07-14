<?php

namespace App\Repositories\HumanResource\HireRequisition;

use App\Models\Auth\User;
use App\Services\Generator\Number;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Notifications\Workflow\WorkflowNotification;
use App\Models\HumanResource\HireRequisition\HrHireRequisitionJobApplicant;
use App\Models\HumanResource\HireRequisition\HrHireRequisitionJobApplicantRequest;
use App\Repositories\Access\UserRepository;

class HrHireRequisitionJobApplicantRequestRepository extends BaseRepository
{
    use Number;
    const MODEL = HrHireRequisitionJobApplicantRequest::class;

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('hr_hire_requisition_job_applicant_requests.id as id'),
            DB::raw('hr_hire_requisition_job_applicant_requests.number as number'),
            DB::raw('hr_hire_requisition_job_applicant_requests.uuid as uuid'),
            DB::raw("CONCAT_WS(' ',users.last_name, users.first_name) as user_name"),
            DB::raw("COUNT(hr_hire_requisition_job_applicants.id) as number_of_jobs"),
        ])
            ->join('hr_hire_requisition_job_applicants', 'hr_hire_requisition_job_applicants.hr_hire_requisition_job_applicant_request_id', 'hr_hire_requisition_job_applicant_requests.id')
            ->join('users', 'users.id', 'hr_hire_requisition_job_applicant_requests.user_id')
            ->groupBy('hr_hire_requisition_job_applicant_requests.id', 'users.last_name', 'users.first_name');
    }



    /** 
     * get Access Processing
     * 
     */
    public function getProcessing()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_hire_requisition_job_applicant_requests.wf_done', 0)
            ->where('hr_hire_requisition_job_applicant_requests.done', true)
            ->where('hr_hire_requisition_job_applicant_requests.rejected', false);
    }


    /** 
     * get Access Returned For Modification
     * 
     */
    public function getReturnedForModification()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_hire_requisition_job_applicant_requests.wf_done', 0)
            ->where('hr_hire_requisition_job_applicant_requests.done', true)
            ->where('hr_hire_requisition_job_applicant_requests.rejected', true);
    }

    /** 
     * get Access Approved
     * @return mixed
     */
    public function getApproved()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_hire_requisition_job_applicant_requests.wf_done', 1)
            ->where('hr_hire_requisition_job_applicant_requests.done', true)
            ->where('hr_hire_requisition_job_applicant_requests.rejected', false);
    }

    public function store($input)
    {
        $this->checkIfHrHireRequisitionsJobSelected($input);
        return DB::transaction(function () use ($input) {
            $job_applicant_request = $this->query()->create(['user_id' => access()->id()]);
            foreach ($input['hr_hire_requisitions_job_ids'] as $hr_hire_requisitions_job_id) {
                HrHireRequisitionJobApplicant::where('hr_hire_requisitions_job_id', $hr_hire_requisitions_job_id)
                    ->update(['hr_hire_requisition_job_applicant_request_id' => $job_applicant_request->id]);
            }
            return $job_applicant_request;
        });
    }

    public function checkIfHrHireRequisitionsJobSelected($input)
    {
        if (!isset($input['hr_hire_requisitions_job_ids'])) {
            throw new GeneralException('Please select atleast one job to proceed');
        }
    }

    /**
     * Update is done column and generate number
     * @param Requisition $requisition
     * @return mixed
     */
    public function updateDoneGenerateNumber($job_applicant_request)
    {
        return DB::transaction(function () use ($job_applicant_request) {
            return $job_applicant_request->update(['done' => true, 'number' => $this->generateNumber($job_applicant_request)]);
        });
    }

    /**
     * Get applicant level
     * @param $wf_module_id
     * @return int|null
     * Get fron desk level per module id
     */
    public function getApplicantLevel($wf_module_id)
    {
        $level = 1;
        return $level;
    }

    /**
     * Get applicant level
     * @param $wf_module_id
     * @return int|null
     * Get fron desk level per module id
     */
    public function getCeoLevel($wf_module_id)
    {
        $level = 2;
        return $level;
    }

    /**
     * @param $resource_id
     * @param $wf_module_id
     * @param $current_level
     * @param int $sign
     * @param array $inputs
     * @throws \App\Exceptions\GeneralException
     */
    public function processWorkflowLevelsAction($resource_id, $wf_module_id, $current_level, $sign = 0, array $inputs = [])
    {
        $requisition = $this->find($resource_id);
        switch ($current_level) {
            case 1:
                $this->updateRejected($resource_id, $sign);

                // $email_resource = (object)[
                //     'link' => route('requisition.show', $requisition),
                //     'subject' => $requisition->typeCategory->title . " Has been revised to your level",
                //     'message' => $requisition->typeCategory->title . " " . $requisition->number . ' need modification.. Please do the need and send it back for approval'
                // ];
                // User::query()->find($requisition->user_id)->notify(new WorkflowNotification($email_resource));

                break;
        }
    }

    /**
     * Update rejected column
     * @param $id
     * @param $sign
     * @return mixed
     */
    public function updateRejected($id, $sign)
    {
        $requisition = $this->query()->find($id);

        return DB::transaction(function () use ($requisition, $sign) {
            $rejected = 0;
            if ($sign == -1) {
                $rejected = 1;
            }
            return $requisition->update(['rejected' => $rejected]);
        });
    }
}
