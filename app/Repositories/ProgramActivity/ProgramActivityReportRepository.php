<?php

namespace App\Repositories\ProgramActivity;


use App\Models\ProgramActivity\ProgramActivity;
use App\Models\ProgramActivity\ProgramActivityReport;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use App\Services\Generator\Number;
use Illuminate\Support\Facades\DB;

class ProgramActivityReportRepository extends BaseRepository
{
    const MODEL =  ProgramActivityReport::class;
use Number;
    public function __construct()
    {
        //
    }

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('program_activity_reports.id AS id'),
            DB::raw('program_activity_reports.user_id AS user_id'),
            DB::raw('program_activity_reports.number AS number'),
            DB::raw('program_activity_reports.created_at AS created_at'),
            DB::raw('program_activity_reports.uuid AS uuid'),
            DB::raw('program_activity_reports.status AS status'),
            DB::raw('program_activity_reports.region_id AS region_id'),
             DB::raw('program_activities.number AS activity_number'),
            DB::raw('program_activities.id AS activity_id'),
            DB::raw("CONCAT_WS(' ', users.first_name,users.last_name) AS name"),
        ])
            ->join('users','users.id', 'program_activity_reports.user_id')
            ->join('program_activities','program_activities.id','program_activity_reports.program_activity_id');
    }

    public function getOnprogressActivityReports(){
        return $this->getQuery()
            ->where('program_activity_reports.wf_done', 0)
            ->where('program_activity_reports.done', true)
            ->where('program_activity_reports.rejected', false)
            ->where('program_activity_reports.user_id', access()->user()->id);
    }
    public function getSavedActivityReports(){
        return $this->getQuery()
            ->where('program_activity_reports.wf_done', 0)
            ->where('program_activity_reports.done', false)
            ->where('program_activity_reports.user_id', access()->user()->id);
    }
    public function getReturnedActivityReports(){
        return $this->getQuery()
            ->where('program_activity_reports.wf_done', false)
            ->where('program_activity_reports.done', true)
            ->where('program_activity_reports.rejected', true)
            ->where('program_activity_reports.user_id', access()->user()->id);
    }
    public function getApprovedActivityReports(){
        return $this->getQuery()
            ->where('program_activity_reports.wf_done', 1)
            ->where('program_activity_reports.done', true)
            ->where('program_activity_reports.rejected', false)
            ->where('program_activity_reports.user_id', access()->user()->id);
    }

    public function getAllApprovedActivityReports(){
        return $this->getQuery()
            ->where('program_activity_reports.wf_done', 1)
            ->where('program_activity_reports.done', true)
            ->where('program_activity_reports.rejected', false)
            ->where('program_activity_reports.paid', false);
    }

    public function inputProcess($inputs){

        return [

            'program_activity_id'=>$inputs['program_activity_id'],
            'region_id'=> access()->user()->region_id,
            'user_id'=>access()->user()->id,

        ];
    }

    public function processInputs($inputs){

        return [
            'venue_name'=>$inputs['venue'],
            'background_info'=>$inputs['background_info'],
            'what_was_planned'=>$inputs['plan'],
            'objectives'=>$inputs['objectives'],
            'methodology'=>$inputs['methodology'],
            'achievement'=>$inputs['achievement'],
            'challenges'=>$inputs['challenges'],
            'recommendations'=>$inputs['recommendations'],
            'status'=>$inputs['status']

        ];

    }

    public function store($inputs){
        return DB::transaction(function () use ($inputs){

            return $this->query()->create($this->inputProcess($inputs));
        });
    }

    public function update($inputs, $uuid){


        return DB::transaction(function () use ($inputs, $uuid){
            $program_activity_report =  $this->findByUuid($uuid);
            $number = $this->generateNumber($program_activity_report);
            if ($program_activity_report->done == true){

                if ($inputs['status'] == 'final'){
                    $this->findByUuid($uuid)->update($this->processInputs($inputs));
                    $program_activity = ProgramActivity::query()->where('id', $program_activity_report->program_activity_id)->first();
                    DB::update('update program_activities set report_submitted = ? where uuid=?', [true,  $program_activity->uuid]);
                }
                else{
                    $this->findByUuid($uuid)->update($this->processInputs($inputs));
                }

            }



            else{
                if ($inputs['status'] == 'final')
                {
                    $this->findByUuid($uuid)->update($this->processInputs($inputs));
                    $program_activity = ProgramActivity::query()->where('id', $program_activity_report->program_activity_id)->first();
                    DB::update('update program_activities set report_submitted = ? where uuid=?', [true,  $program_activity->uuid]);
                    DB::update('update program_activity_reports set number = ?, done = ? where uuid=?', [$number, true, $uuid]);

                }
                else{
                    $this->findByUuid($uuid)->update($this->processInputs($inputs));
                    $program_activity = ProgramActivity::query()->where('id', $program_activity_report->program_activity_id)->first();
                      DB::update('update program_activity_reports set number = ?, done = ? where uuid=?', [$number, true, $uuid]);

                }

            }

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
            case 1:
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
            case 1:
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
                    'link' => route('programactivity.show', $activity_report),
                    'subject' =>$activity_report->number. " Has been revised to your level",
                    'message' => $activity_report->number. ' need modification.. Please do the need and send it back for approval'
                ];
                User::query()->find($activity_report->user_id)->notify(new WorkflowNotification($email_resource));

                break;
            case $head_of_dept_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('programactivity.show', $activity_report),
                    'subject' =>$activity_report->number . " Has been revised to your level",
                    'message' => $activity_report->number .  ' need modification. Please do the need and send it back for approval'
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
