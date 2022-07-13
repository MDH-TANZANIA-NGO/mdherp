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
            DB::raw("CONCAT_WS(' ',units.title, designations.name) AS job_title"),
            DB::raw('hr_hire_requisitions_jobs.uuid AS uuid' ),
            DB::raw('hr_hire_requisitions_jobs.designation_id AS designation_id'),
            DB::raw('hr_hire_requisitions_jobs.department_id AS department_id'),
            DB::raw('departments.title AS department'),
            DB::raw('hr_hire_requisitions_jobs.empoyees_required AS empoyees_required'),
            DB::raw('hr_hire_requisitions_jobs.experience_years AS experience_years'),
            DB::raw('hr_hire_requisitions_jobs.establishment AS establishment'),
            DB::raw('hr_hire_requisitions_jobs.education_level AS education_level'),
            DB::raw('hr_hire_requisitions_jobs.start_age AS start_age'),
            DB::raw('hr_hire_requisitions_jobs.end_age AS end_age'),
            DB::raw('hr_hire_requisitions_jobs.duties_and_responsibilities AS duties_and_responsibilities'),
            DB::raw('hr_hire_requisitions_jobs.duties_and_responsibilities AS duties_and_responsibilities'),
            DB::raw('designations.name AS title'),
            DB::raw('hr_hire_requisitions_jobs.date_required  AS date_required'),
            DB::raw('code_values.name AS contract_type'),
            DB::raw('hr_hire_requisitions_jobs.education_and_qualification AS education_and_qualification'),
            DB::raw('hr_hire_requisitions_jobs.hire_requisition_id AS hire_requisition_id'),
            DB::raw('hr_hire_requisitions_jobs.practical_experience AS practical_experience'),
            DB::raw('hr_hire_requisitions_jobs.special_qualities_skills AS special_qualities_skills'),
            DB::raw('hr_hire_requisitions_jobs.special_employment_condition AS special_employment_condition'),
            DB::raw('hr_hire_requisitions_jobs.created_at AS created_at'),
            DB::raw('hr_hire_requisitions_jobs.budget AS budget'),
            DB::raw('hr_hire_requisitions_jobs.updated_at AS updated_at'),
        ])
            ->leftjoin('departments','departments.id','hr_hire_requisitions_jobs.department_id')
            ->leftjoin('designations','designations.id','hr_hire_requisitions_jobs.designation_id')
            ->leftjoin('units','units.id','designations.unit_id')
            ->join('code_values', 'code_values.id', 'hr_hire_requisitions_jobs.hr_contract_type_id');
    }

    public function getQueryWithInterview(){
        return $this->query()->select([
            DB::raw('hr_hire_requisitions_jobs.id AS id' ),
            DB::raw("CONCAT_WS(' ',units.title, designations.name) AS job_title"),
            DB::raw('hr_hire_requisitions_jobs.uuid AS uuid' ),
            DB::raw('hr_hire_requisitions_jobs.date_required  AS date_required'),
            DB::raw('hr_hire_requisitions_jobs.hire_requisition_id AS hire_requisition_id'),
            DB::raw('hr_hire_requisitions_jobs.created_at AS created_at'),
            DB::raw('hr_interviews.uuid AS interview_uuid'),
            DB::raw('hr_interview_panelists.technical_staff AS technical_staff'),

        ])
            ->join('units','units.id','designations.unit_id')
            ->join('hr_interviews','hr_interviews.hr_requisition_job_id','hr_hire_requisitions_jobs.id');
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

    public function inputsProcessor($inputs){
     
        return [
            'designation_id' => $inputs['job_title'],
            'department_id' => $inputs['department_id'],
            'hr_contract_type_id' =>  $inputs['contract_type'],
            'start_age' =>  $inputs['start_age'],
            'end_age' =>  $inputs['end_age'],
            'special_employment_condition' => $inputs['special_employment_condition'],
            'duties_and_responsibilities' => $inputs['duties_and_responsibilities'],
            'experience_years' =>$inputs['experience_years'],
            'date_required' =>$inputs['date_required'],
            'empoyees_required' => $inputs['empoyees_required'],
            'establishment' => $inputs['establishment'],
            'practical_experience' => $inputs['practical_experience'],
            'special_qualities_skills' => $inputs['special_qualities_skills'],
            'education_and_qualification' => $inputs['education_and_qualification'],
            'appointement_prospects_id' => $inputs['prospect_for_appointment_cv_id'],
            'education_level' => $inputs['education_level'],
            'hire_requisition_id' => $inputs['hire_requisition_id'],
            'budget' => $inputs['budget']
        ];
      
    }

    


    public function getAprovedJobs()
    {
        return $this->getQuery()
                ->join('hr_hire_requisitions','hr_hire_requisitions.id','hr_hire_requisitions_jobs.hire_requisition_id')
                ->where('hr_hire_requisitions.wf_done', 1)
                ->where('hr_hire_requisitions.done', true);
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
    public function update($inputs)
    {

        $hire_requisition_job_id = $inputs['hire_requisition_job_id'];
        return  $this->query()->where('id',$hire_requisition_job_id)->update($this->inputsProcessor($inputs));
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

    /** 
     * 
     * List of Jobs which does not have shortlisters
     * @return mixed
    */
    public function getJobApplicationsWhichDoesNotHaveShortlisterReport()
    {
        return $this->getQuery()
        ->whereDoesntHave('shortlisted');
    }

    /**
     * List of jobs which has shortlisted applicants and does not have a request to be approved
     * @return mixed
     */
    public function getJobApplicationWhichHaveShortlistedApplicants()
    {
        return $this->getQuery()->select([
            DB::raw('hr_hire_requisitions_jobs.id AS id' ),
            DB::raw("CONCAT_WS(' ',units.title, designations.name) AS job_title"),
            DB::raw('hr_hire_requisitions_jobs.uuid AS uuid' ),
            DB::raw('departments.title AS department'),
            DB::raw('hr_hire_requisitions_jobs.empoyees_required AS empoyees_required'),
            DB::raw('code_values.name AS contract_type'),
            DB::raw('hr_hire_requisitions_jobs.education_and_qualification AS education_and_qualification'),
            DB::raw('hr_hire_requisitions_jobs.created_at AS created_at'),
            DB::raw("COUNT(hr_hire_requisition_job_applicants.hr_hire_requisitions_job_id) AS total_applicants")
        ])
        ->leftjoin('hr_hire_requisition_job_applicants','hr_hire_requisition_job_applicants.hr_hire_requisitions_job_id','hr_hire_requisitions_jobs.id')
        ->whereHas('shortlists', function($query){
            $query->whereDoesntHave('request');
        })
        ->groupBy(
            'hr_hire_requisitions_jobs.id',
            'units.title', 
            'designations.name',
            'departments.title',
            'hr_hire_requisitions_jobs.empoyees_required',
            'code_values.name',
            'hr_hire_requisitions_jobs.education_and_qualification',
        );
    }

    /**
     * List of jobs which has shortlisted applicants and does not have a request to be approved
     * @return mixed
     */
    public function getJobApplicationWhichHaveRequestForApproval($hr_hire_job_app_request_id)
    {
        return $this->getQuery()->select([
            DB::raw('hr_hire_requisitions_jobs.id AS id' ),
            DB::raw("CONCAT_WS(' ',units.title, designations.name) AS job_title"),
            DB::raw('hr_hire_requisitions_jobs.uuid AS uuid' ),
            DB::raw('departments.title AS department'),
            DB::raw('hr_hire_requisitions_jobs.empoyees_required AS empoyees_required'),
            DB::raw('code_values.name AS contract_type'),
            DB::raw('hr_hire_requisitions_jobs.education_and_qualification AS education_and_qualification'),
            DB::raw('hr_hire_requisitions_jobs.created_at AS created_at'),
            DB::raw("COUNT(hr_hire_requisition_job_applicants.hr_hire_requisitions_job_id) AS total_applicants")
        ])
        ->join('hr_hire_requisition_job_applicants','hr_hire_requisition_job_applicants.hr_hire_requisition_job_applicant_request_id','hr_hire_requisitions_jobs.id')
        ->where('hr_hire_requisition_job_applicants.hr_hire_requisition_job_applicant_request_id', $hr_hire_job_app_request_id)
        ->groupBy(
            'hr_hire_requisitions_jobs.id',
            'units.title', 
            'designations.name',
            'departments.title',
            'hr_hire_requisitions_jobs.empoyees_required',
            'code_values.name',
            'hr_hire_requisitions_jobs.education_and_qualification',
        );
    }

}
