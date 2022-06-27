<?php

namespace App\Repositories\HumanResource\HireRequisition;

use App\Models\Auth\User;
use App\Models\HumanResource\HireRequisition\HireRequisition;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Services\Generator\Number;

class HireRequisitionRepository extends BaseRepository
{
    const MODEL = HireRequisition::class;
    use Number;

    public function getQuery(){
        return $this->query()->select([
            DB::raw("hr_hire_requisitions.id AS id"),
            DB::raw("MAX(hr_hire_requisitions.number) AS number"),
            DB::raw("string_agg(DISTINCT designations.name, ',') as title"),
            DB::raw("0 as total"),
            // DB::raw("hr_hire_requisitions.empoyees_required as total"),
            DB::raw("string_agg(DISTINCT regions.name, ',') as region"),
            DB::raw("MAX(hr_hire_requisitions.created_at) AS created_at"),
            DB::raw("hr_hire_requisitions.uuid AS uuid")
        ])
        ->leftjoin('hr_hire_requisitions_jobs','hr_hire_requisitions_jobs.hire_requisition_id', 'hr_hire_requisitions.id')
        ->leftjoin('designations','designations.id', 'hr_hire_requisitions_jobs.designation_id')
        ->leftjoin('hr_hire_requisition_locations','hr_hire_requisition_locations.hr_requisition_job_id', 'hr_hire_requisitions_jobs.id')
        ->leftjoin('regions','regions.id', 'hr_hire_requisition_locations.region_id')
        ->groupby(['hr_hire_requisitions.id','hr_hire_requisitions.uuid']);
    }

    public function getAccessProcessingDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_hire_requisitions.wf_done', 0)
            ->where('hr_hire_requisitions.done', 1)
            ->where('hr_hire_requisitions.rejected', 0)
            ->where('hr_hire_requisitions.user_id', access()->id());
    }

    public function getAccessDeniedDatatable(){
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_hire_requisitions.rejected', 1)
            ->where('hr_hire_requisitions.user_id', access()->id());
    }
    
    
    public function getAccessRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_hire_requisitions.wf_done', 5)
            ->where('hr_hire_requisitions.user_id', access()->id());
    }

    public function getAccessProvedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_hire_requisitions.wf_done', 1)
            ->where('hr_hire_requisitions.done', 1)
            ->where('hr_hire_requisitions.user_id', access()->id());
    }

    public function getAccessSavedDatatable()
    {
        return $this->getQuery()
            ->whereDoesntHave('wfTracks')
            ->where('hr_hire_requisitions.wf_done', 0)
            ->where('hr_hire_requisitions.done', 0)
            ->where('hr_hire_requisitions.rejected', 0)
            ->where('hr_hire_requisitions.user_id', access()->id());
    }

    public function inputsProcessor($inputs): array
    {
        $md = new \ParsedownExtra();
        return [
            'user_id' => access()->id(),
            'department_id' => $inputs['department_id']
        ];
    }

    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            $listing = $this->query()->create($this->inputsProcessor($inputs));
            return $listing;
        });
    }

    public function submit($uuid)
    {
        return DB::transaction(function () use ($uuid){
                $hireRequisition = $this->findByUuid($uuid);
                $number = $this->generateNumber($hireRequisition);
                DB::update('update hr_hire_requisitions set number = ?, done = ? where uuid= ?',[$number,true, $uuid]);
            });       
    }

    public function update($data)
    {
        return $this->query()->update($data,$data['hr_hire_requisition_id']);    
    }

  

    /**
     * Store new Project
     * @param $inputs
     * @param Listing $listing
     * @return mixed
     */
  

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
        $listing = $this->find($resource_id);
        
        $applicant_level = $this->getApplicantLevel($wf_module_id);
        $head_of_dept_level = $this->getHeadOfDeptLevel($wf_module_id);
        switch ($inputs['rejected_level'] ?? $current_level) {
            case $applicant_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('listing.show', $listing),
                    'subject' =>$listing->id. " Has been revised to your level",
                    'message' => $listing->id. ' need modification.. Please do the need and send it back for approval'
                ];
                User::query()->find($listing->user_id)->notify(new WorkflowNotification($email_resource));

                break;
            case $head_of_dept_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('listing.show', $listing),
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
        $listing = $this->query()->find($id);
        return DB::transaction(function () use ($listing, $sign) {
            $rejected = 0;
            if ($sign == -1) {
                $rejected = 1;
            }
            return $listing->update(['rejected' => $rejected]);
        });
    }


}
