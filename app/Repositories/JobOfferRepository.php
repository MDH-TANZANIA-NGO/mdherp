<?php

namespace App\Repositories;

use App\Models\Auth\User;
use App\Models\JobOffer\JobOffer;
use App\Notifications\Workflow\WorkflowNotification;
use App\Services\Generator\Number;
use Illuminate\Support\Facades\DB;

class JobOfferRepository extends BaseRepository
{
    use Number;
    const MODEL = JobOffer::class;
    public function __construct()
    {
        //
    }
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('job_offers.id AS id'),
            DB::raw('job_offers.hr_interview_applicant_id AS hr_interview_applicant_id'),
            DB::raw('job_offers.parent_id AS parent_id'),
            DB::raw('job_offers.salary AS salary'),
            DB::raw('job_offers.status AS status'),
            DB::raw('job_offers.date_of_arrival AS date_of_arrival'),
            DB::raw('job_offers.user_id AS user_id'),
            DB::raw('designations.id AS designation_id'),
            DB::raw('job_offers.number AS number'),
            DB::raw('job_offers.details AS details'),
            DB::raw('job_offers.created_at AS created_at'),
            DB::raw('job_offers.uuid AS uuid'),
          ])
            ->leftjoin('hr_interview_applicants','hr_interview_applicants.id','job_offers.hr_interview_applicant_id')
            ->leftjoin('hr_interviews', 'hr_interviews.id', 'hr_interview_applicants.interview_id')
            ->leftjoin('hr_hire_requisitions_jobs', 'hr_hire_requisitions_jobs.id', 'hr_interviews.hr_requisition_job_id')
            ->leftjoin('designations', 'designations.id','hr_hire_requisitions_jobs.designation_id');
    }
    public function getAccessProcessing()
    {
        return $this->getQuery()
            ->where('job_offers.done', true)
            ->where('job_offers.rejected', false)
            ->where('job_offers.wf_done', null)
            ->where('job_offers.user_id', access()->user()->id);
    }
    public function getAccessApproved()
    {
        return $this->getQuery()
            ->where('job_offers.done', true)
            ->where('job_offers.rejected', false)
            ->where('job_offers.wf_done', 1)
            ->where('job_offers.user_id', access()->user()->id);
    }
    public function getAccessRejected()
    {
        return $this->getQuery()
            ->where('job_offers.done', true)
            ->where('job_offers.rejected', true)
            ->where('job_offers.wf_done', null)
            ->where('job_offers.user_id', access()->user()->id);
    }
    public function inputProcess($inputs)
    {
        $salary = currency_converter($inputs['salary'], 'USD');
        return[
            'salary'=> $salary,
            'details'=> $inputs['details'],
            'hr_interview_applicant_id'=>$inputs['hr_hire_requisitions_job_applicants_id'],
            'user_id'=>access()->user()->id,
            'date_of_arrival'=>$inputs['date_of_arrival'],
            'end_tenure'=>$inputs['end_tenure'],
            'done'=> true

        ];
    }
    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            $job_offer_id = $this->query()->create($this->inputProcess($inputs))->id;
            $job_offer =  $this->find($job_offer_id);
            $number =  $number = $this->generateNumber($job_offer);
            $job_offer->update(['number'=>$number]);
            $job_offer->projects()->sync($inputs['projects']);
            return $job_offer;
        });
    }
    public function update($inputs, $uuid)
    {
        return DB::transaction(function () use ($inputs, $uuid){
            $job_offer =  $this->findByUuid($uuid);
            $job_offer->projects()->sync($inputs['projects']);
            $job_offer->update($this->inputProcess($inputs));

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
        $level = null;
        switch ($wf_module_id) {
            case 3:
                $level = 1;
                break;
        }
        return $level;
    }

    /**
     * Get applicant level
     * @param $wf_module_id
     * @return int|null
     * Get fron desk level per module id
     */
    public function getHeadOfDeptLevel($wf_module_id)
    {
        $level = null;
        switch ($wf_module_id) {
            case 3:
                $level = 2;
                break;
        }
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
        $job_offer = $this->find($resource_id);
        $applicant_level = $this->getApplicantLevel($wf_module_id);
        $head_of_dept_level = $this->getHeadOfDeptLevel($wf_module_id);
//        $account_receivable_level = $this->getAccountReceivableLevel($wf_module_id);
//        if($requisition->rejected){}
        switch ($inputs['rejected_level'] ?? $current_level) {
            case $applicant_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('job_offer.show', $job_offer),
                    'subject' =>$job_offer->number. " Has been revised to your level",
                    'message' => $job_offer->number. ' need modification.. Please do the need and send it back for approval'
                ];
                User::query()->find($job_offer->user_id)->notify(new WorkflowNotification($email_resource));

                break;
            case $head_of_dept_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('safari.show', $job_offer),
                    'subject' =>$job_offer->number . " Has been revised to your level",
                    'message' => $job_offer->number .  ' need modification. Please do the need and send it back for approval'
                ];
//                  User::query()->find($this->nextUserSelector($wf_module_id, $resource_id, $current_level))->notify(new WorkflowNotification($email_resource));

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
        $job_offer = $this->query()->find($id);
        return DB::transaction(function () use ($job_offer, $sign) {
            $rejected = 0;
            if ($sign == -1) {
                $rejected = 1;
            }
            return $job_offer->update(['rejected' => $rejected]);
        });
    }

}
