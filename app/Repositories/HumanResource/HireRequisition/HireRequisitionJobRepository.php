<?php

namespace App\Repositories\HumanResource\HireRequisition;


use App\Models\Auth\User;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class HireRequisitionJobRepository extends BaseRepository
{
    const MODEL = HireRequisitionJob::class;

    public function getQuery(){
        return $this->query()->select([
            DB::raw('hr_hire_requisitions_jobs.id AS id' ),
            DB::raw('hr_hire_requisitions_jobs.uuid AS uuid' ),
            DB::raw('hr_hire_requisitions_jobs.empoyees_required AS empoyees_required'),
            DB::raw('hr_hire_requisitions_jobs.duties_and_responsibilities AS duties_and_responsibilities'),
            DB::raw('designations.name AS title' ),
            DB::raw('hr_hire_requisitions_jobs.date_required  AS date_required'),
            DB::raw('code_values.name AS establishment'),
            DB::raw('hr_hire_requisitions_jobs.education_and_qualification AS education'),
            DB::raw('hr_hire_requisitions_jobs.practical_experience AS experience'),
            DB::raw('hr_hire_requisitions_jobs.special_qualities_skills AS qualities'),
            DB::raw('hr_hire_requisitions_jobs.created_at AS created_at' ),
            DB::raw('hr_hire_requisitions_jobs.updated_at AS updated_at' ),
        ])
            ->join('designations','designations.id','hr_hire_requisitions_jobs.designation_id')
            ->join('code_values', 'code_values.id', 'hr_hire_requisitions_jobs.hr_contract_type_id');
    }

    public function getAccessProcessingDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_hire_requisitions.wf_done', 0)
            ->where('hr_hire_requisitions.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessDeniedDatatable(){
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_hire_requisitions.rejected', true)
            ->where('users.id', access()->id());
    }
    public function getAccessRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_hire_requisitions.wf_done', 5)
            ->where('users.id', access()->id());
    }

    public function getAccessProvedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_hire_requisitions.wf_done', true)
            ->where('users.id', access()->id());
    }

    public function inputsProcessor($inputs): array
    {

        $md = new \ParsedownExtra();
        return [
            'designation_id' => $inputs['job_title'],
            'hr_contract_type_id' =>  $inputs['contract_type'],
            'special_employment_condition' => $inputs['special_employment_condition'],
            'duties_and_responsibilities' => $inputs['duties_and_responsibilities'],
            'experience_years' =>$inputs['contract_type'],
            'date_required' =>$inputs['date_required'],
            'empoyees_required' => $inputs['empoyees_required'],
            'establishment' => $inputs['establishment'],
            'practical_experience' => $inputs['practical_experience'],
            'special_qualities_skills' => $inputs['special_qualities_skills'],
            'education_and_qualification' => $inputs['education_and_qualification'],
            'comment' => $inputs['contract_type'],
            'appointement_prospects_id' => $inputs['prospect_for_appointment_cv_id'],
            'hire_requisition_id' => $inputs['hire_requisition_id'],
        ];
    }

    public function store($data)
    {    
        $hireRequisitionJob = $this->query()->create($this->inputsProcessor($data));
        return $hireRequisitionJob;   
    }

    /**
     * Store new Project
     * @param $inputs
     * @param HireRequisitionJob $hireRequisitionJob
     * @return mixed
     */
    public function update($inputs, HireRequisitionJob $hireRequisitionJob)
    {
        return DB::transaction(function () use($inputs, $hireRequisitionJob){
            $hireRequisitionJob->update($this->inputsProcessor($inputs));
            if(isset($inputs['tools']))
                $hireRequisitionJob->workingTools()->sync($inputs['tools']);
            return $hireRequisitionJob;
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
            case 9:
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
            case 9:
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
        $hireRequisitionJob = $this->find($resource_id);
        $applicant_level = $this->getApplicantLevel($wf_module_id);
        $head_of_dept_level = $this->getHeadOfDeptLevel($wf_module_id);
//        $account_receivable_level = $this->getAccountReceivableLevel($wf_module_id);
//        if($requisition->rejected){}
        switch ($inputs['rejected_level'] ?? $current_level) {
            case $applicant_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('listing.show', $hireRequisitionJob),
                    'subject' =>$hireRequisitionJob->id. " Has been revised to your level",
                    'message' => $hireRequisitionJob->id. ' need modification.. Please do the need and send it back for approval'
                ];
                User::query()->find($hireRequisitionJob->user_id)->notify(new WorkflowNotification($email_resource));

                break;
            case $head_of_dept_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('listing.show', $hireRequisitionJob),
                    'subject' => " Has been revised to your level",
                    'message' =>  ' need modification. Please do the need and send it back for approval'
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
        $hireRequisitionJob = $this->query()->find($id);
        return DB::transaction(function () use ($hireRequisitionJob, $sign) {
            $rejected = 0;
            if ($sign == -1) {
                $rejected = 1;
            }
            return $hireRequisitionJob->update(['rejected' => $rejected]);
        });
    }


}
