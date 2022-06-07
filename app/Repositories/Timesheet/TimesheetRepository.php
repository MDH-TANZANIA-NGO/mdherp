<?php

namespace App\Repositories\Timesheet;

use App\Models\Attendance\Attendance;
use App\Models\Auth\User;
use App\Models\Timesheet\Timesheet;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TimesheetRepository extends BaseRepository
{
    const MODEL = Timesheet::class;
    
    public function __contruct(){

    }


    public function getQuery(){
        return $this->query()->select([
            DB::raw('timesheets.id AS id'),
            DB::raw('timesheets.uuid AS uuid'),
            DB::raw('timesheets.user_id AS user_id'),
            DB::raw('timesheets.hrs AS hours'),
            DB::raw('timesheets.wf_done_date AS wf_done_date'),
            DB::raw('users.identity_number AS identity_number'),
            DB::raw("concat_ws(' ', users.first_name, users.last_name) as fullName"),
            DB::raw('timesheets.created_at AS created_at'),
        ])
            ->join('users','users.id', 'timesheets.user_id');
    }

    public function getAllApprovedTimesheets()
    {
        return $this->getQuery()
            ->where('timesheets.wf_done', true);
    }

    public function getAccessProcessingDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('timesheets.wf_done_date', null)
            ->where('timesheets.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('timesheets.wf_done', 0)
            ->where('timesheets.rejected', true)
            ->where('users.id', access()->id());
    }

    public function getAccessApprovedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('timesheets.wf_done', true)
            ->where('timesheets.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getSubmittedTimesheets(){
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('timesheets.wf_done_date', null)
            ->where('timesheets.rejected', false);
    }

    public function getApprovedTimesheets(){
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('timesheets.wf_done', true)
            ->where('timesheets.rejected', false);
    }

    public function getRejectedTimesheets(){
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('timesheets.wf_done', 0)
            ->where('timesheets.rejected', true);
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
            case 8:
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
            case 8:
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
        $timesheet = $this->find($resource_id);
        $applicant_level = $this->getApplicantLevel($wf_module_id);
        $head_of_dept_level = $this->getHeadOfDeptLevel($wf_module_id);
//        $account_receivable_level = $this->getAccountReceivableLevel($wf_module_id);
//        if($requisition->rejected){}
        switch ($inputs['rejected_level'] ?? $current_level) {
            case $applicant_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('timesheet.show', $timesheet),
                    'subject' =>$timesheet->id. " Has been revised to your level",
                    'message' => $timesheet->id. ' need modification.. Please do the need and send it back for approval'
                ];
                User::query()->find($timesheet->user_id)->notify(new WorkflowNotification($email_resource));

                break;
            case $head_of_dept_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('timesheet.show', $timesheet),
                    'subject' =>$timesheet->number . " Has been revised to your level",
                    'message' => $timesheet->number .  ' need modification. Please do the need and send it back for approval'
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
        $timesheet = $this->query()->find($id);
        return DB::transaction(function () use ($timesheet, $sign) {
            $rejected = 0;
            if ($sign == -1) {
                $rejected = 1;
            }
            return $timesheet->update(['rejected' => $rejected]);
        });
    }


}
