<?php

namespace App\Repositories\Listing;

use App\Models\Auth\User;
use App\Models\Listing\Listing;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ListingRepository extends BaseRepository
{
    const MODEL = Listing::class;

    public function getQuery(){
        return $this->query()->select([
            DB::raw('listings.id AS id' ),
            DB::raw('listings.number AS number' ),
            DB::raw('listings.uuid AS uuid' ),
            DB::raw('listings.title AS title' ),
            DB::raw('listings.content AS content' ),
            DB::raw('listings.budget AS budget' ),
            DB::raw('code_values.name AS establishment'),
            DB::raw('regions.name AS region'),
            DB::raw('departments.title AS department'),
            DB::raw('listings.education_and_qualification AS education'),
            DB::raw('listings.practical_experience AS experience'),
            DB::raw('listings.other_qualities AS qualities'),
            DB::raw('listings.special_employment_condition AS special'),
            DB::raw('listings.employee_id AS employee'),
            DB::raw('listings.created_at AS created_at' ),
            DB::raw('listings.date_required AS date_required' ),
            DB::raw('listings.updated_at AS updated_at' ),
            //DB::raw('working_tools AS working_tools')
        ])
            ->join('users','users.id', 'listings.user_id')
            ->join('departments', 'departments.id', 'listings.department_id')
            ->join('regions', 'regions.id', 'listings.region_id')
            ->join('code_values', 'code_values.id', 'listings.employment_condition_cv_id');
        // ->join('listing_working_tool', 'listing_working_tool.listing_id', 'listings.id')
        //->join('working_tools', 'listing_working_tool.working_tool_id', 'working_tools.id');

    }

    public function getAccessProcessingDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('listings.wf_done', 0)
            ->where('listings.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessDeniedDatatable(){
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('listings.rejected', true)
            ->where('users.id', access()->id());
    }
    public function getAccessRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('listings.wf_done', 5)
            ->where('users.id', access()->id());
    }

    public function getAccessProvedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('listings.wf_done', true)
            ->where('users.id', access()->id());
    }

    public function inputsProcessor($inputs): array
    {
        $md = new \ParsedownExtra();
        return [
            'user_id' => access()->id(),
            'region_id' => $inputs['region_id'],
            'department_id' => $inputs['department_id'],
            'title' => $inputs['title'],
            'number' => $inputs['number'],
            'date_required' => $inputs['date_required'],
            'employment_condition_cv_id' =>  $inputs['employment_condition_cv_id'],
            'special_employment_condition' => $md->text($inputs['special_employment_condition']),
            'other_qualities' => $md->text($inputs['other_qualities']),
            'education_and_qualification' => $md->text($inputs['education_and_qualification']),
            'practical_experience' => $md->text($inputs['practical_experience']),
            'establishment_cv_id' => $inputs['establishment_cv_id'],
            'budget' => $inputs['budget'] ?? NULL,
            'employee_id' => $inputs['employee_id'] ?? NULL,
            'prospect_for_appointment_cv_id' => $inputs['prospect_for_appointment_cv_id'],
            'content' => $md->text($inputs['content']),
        ];
    }

    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            $listing = $this->query()->create($this->inputsProcessor($inputs));
            if(isset($inputs['tools']))
                $listing->workingTools()->sync($inputs['tools']);
            return $listing;
        });
    }

    /**
     * Store new Project
     * @param $inputs
     * @param Listing $listing
     * @return mixed
     */
    public function update($inputs, Listing $listing)
    {
        return DB::transaction(function () use($inputs, $listing){
            $listing->update($this->inputsProcessor($inputs));
            if(isset($inputs['tools']))
                $listing->workingTools()->sync($inputs['tools']);
            return $listing;
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
        $listing = $this->find($resource_id);
        $applicant_level = $this->getApplicantLevel($wf_module_id);
        $head_of_dept_level = $this->getHeadOfDeptLevel($wf_module_id);
//        $account_receivable_level = $this->getAccountReceivableLevel($wf_module_id);
//        if($requisition->rejected){}
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
