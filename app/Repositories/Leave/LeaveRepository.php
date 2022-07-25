<?php

namespace App\Repositories\Leave;

use App\Models\Auth\User;
use App\Models\Leave\Leave;
use App\Models\Leave\LeaveBalance;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class LeaveRepository extends BaseRepository
{
    const MODEL = Leave::class;

    public function __construct(){

    }

    public function getQuery(){
        return $this->query()->select([
            DB::raw('leaves.id AS id'),
            DB::raw('leaves.start_date AS start_date'),
            DB::raw('leaves.end_date AS end_date'),
            DB::raw('leaves.comment AS comment'),
            DB::raw('leaves.uuid AS uuid'),
            DB::raw('leaves.created_at AS created_at'),
            DB::raw('leaves.leave_type_id AS leave_type_id'),
            DB::raw('leave_types.id AS type_id'),
            DB::raw('leaves.employee_id AS employee_id' ),
            DB::raw('leave_types.name AS type_name'),
            DB::raw('leaves.user_id AS user_id'),
            DB::raw("concat_ws(' ', users.first_name, users.last_name) as fullName"),
            DB::raw('leaves.region_id AS region_id'),
        ])
            ->join('leave_types', 'leave_types.id', 'leaves.leave_type_id')
            ->join('regions', 'regions.id', 'leaves.region_id')
            ->join('users','users.id', 'leaves.user_id');
    }

    public function getQueryAll()
    {
        return $this->query()->select([
            DB::raw('leaves.id AS id'),
            DB::raw('leaves.user_id AS user_id'),
            DB::raw('leaves.start_date AS start_date'),
            DB::raw('leaves.end_date AS end_date'),
            DB::raw('leave_balance AS leave_balance'),
            DB::raw('leaves.comment AS comment'),
            DB::raw('leaves.leave_type_id AS leave_type_id')
                ])
            ->join('users','users.id', 'leaves.user_id');
    }

    public function getAccessDelegetedLeaves( $start_date, $end_date)
    {
       return $this->getQueryAll()
            ->where('leaves.employee_id', access()->user()->id)
            ->where('leaves.end_date', '>=',$end_date)
            ->orWhere('leaves.start_date', '>=',$start_date);
    }

    public function inputProcess($inputs){
        $leave_balance = LeaveBalance::where('user_id', access()->user()->id)->where('leave_type_id', $inputs['leave_type_id'])->first();
        return [
            'user_id' => access()->id(),
            'region_id' => access()->user()->region_id,
            'department_id'=>access()->user()->designation->department->id,
            'employee_id' => $inputs['employee_id'],
            'comment' => $inputs['comment'],
            'start_date' => $inputs['start_date'],
            'end_date' => $inputs['end_date'],
            'leave_type_id' => $inputs['leave_type_id'],
            'leave_balance' =>$leave_balance->id,
            'done'=> true
        ];
    }


    public function store($inputs)
    {
       $get_delegeted_leaves =  $this->getAccessDelegetedLeaves($inputs['start_date'], $inputs['end_date'])->get();

       if ($get_delegeted_leaves->count() > 0)
       {
           alert()->error($get_delegeted_leaves->first()->user->first_name.' '.$get_delegeted_leaves->first()->user->last_name. ' delegated responsibilities to you', 'Failed');
       }

       else{

           return DB::transaction(function () use ($inputs){
               $this->query()->create($this->inputProcess($inputs));

           });
       }
        return redirect()->back();
    }

    public function getAllApprovedLeaves()
    {
        return$this->getQueryAll()
            ->where('leaves.wf_done', 1);
    }

    public function getAccessProcessingDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('leaves.wf_done', 0)
            ->where('leaves.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('leaves.wf_done', 0)
            ->where('leaves.rejected', true)
            ->where('users.id', access()->id());
    }

    public function getAccessProvedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('leaves.wf_done', 1)
            ->where('leaves.done', true)
            ->where('leaves.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessSavedDatatable()
    {
        return $this->getQuery()
            ->whereDoesntHave('wfTracks')
            ->where('leaves.wf_done', 0)
           // ->where('leaves.done', false)
            ->where('leaves.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getSubmittedLeaves(){
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('leaves.wf_done', 0)
            ->where('leaves.rejected', false);
    }

    public function getApprovedLeaves(){
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('leaves.wf_done', 1)
            ->where('leaves.done', true)
            ->where('leaves.rejected', false);
    }

    public function getRejectedLeaves(){
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('leaves.wf_done', 0)
            ->where('leaves.rejected', true);
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
            case 6:
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
            case 6:
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
        $leave = $this->find($resource_id);
        $applicant_level = $this->getApplicantLevel($wf_module_id);
        $head_of_dept_level = $this->getHeadOfDeptLevel($wf_module_id);

        switch ($inputs['rejected_level'] ?? $current_level) {
            case $applicant_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('leave.show', $leave),
                    'subject' =>$leave->id. " Has been revised to your level",
                    'message' => $leave->id. ' need modification.. Please do the need and send it back for approval'
                ];
                User::query()->find($leave->user_id)->notify(new WorkflowNotification($email_resource));

                break;
            case $head_of_dept_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('timesheet.show', $leave),
                    'subject' =>$leave->number . " Has been revised to your level",
                    'message' => $leave->number .  ' need modification. Please do the need and send it back for approval'
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
        $leave = $this->query()->find($id);
        return DB::transaction(function () use ($leave, $sign) {
            $rejected = 0;
            if ($sign == -1) {
                $rejected = 1;
            }
            return $leave->update(['rejected' => $rejected]);
        });
    }




}
