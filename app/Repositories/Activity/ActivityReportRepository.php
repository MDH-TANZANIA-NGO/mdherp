<?php

namespace App\Repositories\Activity;

//use App\Activities\Reports\ActivityReport;
use App\Models\Activities\Reports\ActivityReport;
use App\Models\Attendance\Hotspot;
use App\Models\Auth\User;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use App\Services\Generator\Number;
use App\Services\Workflow\Traits\WorkflowUserSelector;
use Illuminate\Support\Facades\DB;

class ActivityReportRepository extends BaseRepository
{
    const MODEL = ActivityReport::class;
    use Number, WorkflowUserSelector;
    public function __construct()
    {
        //
    }

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('activity_reports.id AS id'),
            DB::raw('activity_reports.requisition_id AS requisition_id'),
            DB::raw('activity_reports.user_id AS user_id'),
            DB::raw("concat_ws(' ', users.first_name, users.last_name) as full_name"),
            DB::raw('users.email AS email'),
            DB::raw('users.phone AS phone'),
            DB::raw('activity_reports.number AS number'),
            DB::raw('activity_reports.start_date AS start_date'),
            DB::raw('activity_reports.end_date AS end_date'),
            DB::raw('requisitions.number AS requisition_number'),
            DB::raw('activity_reports.created_at AS created_at'),
            DB::raw('activity_reports.report_type AS report_type'),
            DB::raw('activity_reports.uuid AS uuid'),
            DB::raw('regions.name AS region_name'),
            DB::raw('program_activities.number AS activity_number'),
            DB::raw('projects.title AS title'),
        ])
            ->join('users','users.id', 'activity_reports.user_id')
            ->join('requisitions','requisitions.id','activity_reports.requisition_id')
            ->leftjoin('projects', 'projects.id','requisitions.project_id')
            ->leftjoin('program_activities', 'program_activities.requisition_id','requisitions.id')
            ->join('regions','regions.id','activity_reports.region_id');
    }

    public function getAccessProcessing()
    {
        return $this->getQuery()
            ->where('activity_reports.done', true)
            ->where('activity_reports.user_id', access()->user()->id)
            ->where('activity_reports.rejected', false)
            ->where('activity_reports.wf_done', 0);
    }
    public function getAccessSaved()
    {
        return $this->getQuery()
            ->where('activity_reports.done', false)
            ->where('activity_reports.user_id', access()->user()->id)
            ->where('activity_reports.rejected', false)
            ->where('activity_reports.wf_done', 0);
    }
    public function getAccessRejected()
    {
        return $this->getQuery()
            ->where('activity_reports.done', true)
            ->where('activity_reports.user_id', access()->user()->id)
            ->where('activity_reports.rejected', true)
            ->where('activity_reports.wf_done', 0);
    }
    public function getAccessApproved()
    {
        return $this->getQuery()
            ->where('activity_reports.done', true)
            ->where('activity_reports.user_id', access()->user()->id)
            ->where('activity_reports.rejected', false)
            ->where('activity_reports.wf_done', 1);
    }
    public function getAllApproved()
    {
        return $this->getQuery()
            ->where('activity_reports.wf_done' , 1);
    }
    public function getAllApprovedForPayment()
    {
        return $this->getAllApproved()
            ->whereDoesntHave('payment');
    }

    public function getAllApprovedForPaymentByRegion($region_id)
    {
        return $this->getAllApprovedForPayment()
            ->where('activity_reports.region_id', $region_id);
    }

    public function getSumOfPaidAmountToParticipantsForRequisition($requisition_id)
    {
        return $this->getQuery()
            ->join('requisition_training_costs','requisition_training_costs.requisition_id','requisition_id')
            ->where('requisition_training_costs.requisition_id', $requisition_id)
            ->sum('requisition_training_costs.amount_paid');
    }
    public function getCountForParticipantsForRequisition($requisition_id)
    {
        return $this->getQuery()
            ->join('requisition_training_costs','requisition_training_costs.requisition_id','requisition_id')
            ->where('requisition_training_costs.requisition_id', $requisition_id)
            ->where('requisition_training_costs.amount_paid','!=', 0)
            ->orWhere('requisition_training_costs.amount_paid','!=', null)
            ->get()
            ->count();
    }




    public function inputsProcess($inputs)
    {
        return [
            'start_date'=>$inputs['start_date'],
            'end_date'=>$inputs['end_date'],
            'status'=>$inputs['status'],
            'venue'=>$inputs['venue'],
            'content'=>$inputs['content'],
            'done'=>true,
            'user_id'=> access()->user()->id,
            'region_id'=> access()->user()->region_id,
            'requisition_id'=>$inputs['requisition_id'],

        ];
    }
    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
           $activity_report_id =  $this->query()->create($this->inputsProcess($inputs))->id;
           $activity_report = $this->find($activity_report_id);
           $number =  $this->generateNumber($activity_report);
           $activity_report->update(['number'=>$number]);
           $hotspots =  Hotspot::query()->where('requisition_id', $activity_report->requisition_id)->whereDate('checkin_time','>=',$activity_report->start_date)->whereDate('checkin_time', '<=', $activity_report->end_date)->get();

            foreach ($hotspots as  $hotspot) {
                Hotspot::query()->find($hotspot->id)->update(['report_id'=>$activity_report_id]);
           }
            return $activity_report;
        });
    }
    public function getAccessSavedByRequisitionId($requisition_id)
    {
        return $this->getAccessSaved()
            ->where('activity_reports.requisition_id', $requisition_id);
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
        $activity_report = $this->find($resource_id);
        $applicant_level = $this->getApplicantLevel($wf_module_id);
        $head_of_dept_level = $this->getHeadOfDeptLevel($wf_module_id);
//        $account_receivable_level = $this->getAccountReceivableLevel($wf_module_id);
//        if($requisition->rejected){}
        switch ($inputs['rejected_level'] ?? $current_level) {
            case $applicant_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('activity_report.show', $activity_report),
                    'subject' =>$activity_report->number. " Has been revised to your level",
                    'message' => $activity_report->number. ' need modification.. Please do the need and send it back for approval'
                ];
                User::query()->find($activity_report->user_id)->notify(new WorkflowNotification($email_resource));

                break;
            case $head_of_dept_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('activity_report.show', $activity_report),
                    'subject' =>$activity_report->number . " Has been revised to your level",
                    'message' => $activity_report->number .  ' modifications has been done and reversed to your level for your actions. Please do the need.'
                ];
                  User::query()->find($this->nextUserSelector($wf_module_id, $resource_id, $current_level))->notify(new WorkflowNotification($email_resource));

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
        $activity_report = $this->query()->find($id);
        return DB::transaction(function () use ($activity_report, $sign) {
            $rejected = 0;
            if ($sign == -1) {
                $rejected = 1;
            }
            return $activity_report->update(['rejected' => $rejected]);
        });
    }

}

