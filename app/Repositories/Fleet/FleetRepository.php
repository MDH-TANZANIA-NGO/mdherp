<?php

namespace App\Repositories\Fleet;

use App\Models\Fleet\FleetRequest;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Notifications\Workflow\WorkflowNotification;
use App\Models\Auth\User;
use App\Services\Workflow\Traits\WorkflowUserSelector;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class FleetRepository extends BaseRepository
{
    use  WorkflowUserSelector;
    const MODEL = FleetRequest::class;





    public function __construct()
    {
    }
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('fleet_requests.date AS date'),
            DB::raw('fleet_requests.program AS program'),
            DB::raw('fleet_requests.activity_description AS activity_description'),
            DB::raw('fleet_requests.location AS location'),
            DB::raw('fleet_requests.starting_time AS starting_time'),
            DB::raw('fleet_requests.ending_time AS ending_time'),
            DB::raw('fleet_requests.uuid AS uuid'),

        ])
            ->join('users', 'users.id', 'fleet_requests.user_id');
    }



    public function getAllApproved()
    {
        return $this->getQuery()
            ->where('fleet_requests.wf_done', true);
    }

    public function getAccessProcessingDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('fleet_requests.wf_done_date', null)
            ->where('fleet_requests.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('fleet_requests.wf_done', 0)
            ->where('fleet_requests.rejected', true)
            ->where('users.id', access()->id());
    }

    public function getAccessApprovedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('fleet_requests.wf_done', true)
            ->where('fleet_requests.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessSavedDatatable()
    {
        return $this->getQuery()
            ->whereDoesntHave('wfTracks')
            // ->where('fleet_requests.wf_done', false)
            // ->where('fleet_requests.done',0)
            // ->where('fleet_requests.rejected', false)
            //->where('fleet_requests.location', null)
            ->where('users.id', access()->id());
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
            case 10:
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
            case 10:
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
        $fleet = $this->find($resource_id);
        $applicant_level = $this->getApplicantLevel($wf_module_id);
        $head_of_dept_level = $this->getHeadOfDeptLevel($wf_module_id);

        switch ($inputs['rejected_level'] ?? $current_level) {
            case $applicant_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('fleet.show', $fleet),
                    'subject' => $fleet->number . " Has been revised to your level",
                    'message' =>  $fleet->number . ' need modification.. Please do the need and send it back for approval'
                ];


                break;
            case $head_of_dept_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('requisition.show', $fleet),
                    'subject' => $fleet->number . " Has been revised to your level",
                    'message' => $fleet->number . ' need modification.. Please do the need and send it back for approval'
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
        $fleet = $this->query()->find($id);

        return DB::transaction(function () use ($fleet, $sign) {
            $rejected = 0;
            if ($sign == -1) {
                $rejected = 1;
            }

            return $fleet->update(['rejected' => $rejected]);
        });
    }
}
