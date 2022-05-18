<?php

namespace App\Repositories\ProgramActivity;

use App\Models\ProgramActivity\ProgramActivity;
use App\Models\ProgramActivity\ProgramActivityAttendance;
use App\Models\ProgramActivity\Traits\ProgramActivityRelationship;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\Training\RequestTrainingCostRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Services\Generator\Number;
use Illuminate\Support\Facades\DB;

class
ProgramActivityRepository extends BaseRepository
{
    use Number, ProgramActivityRelationship;
    const MODEL = ProgramActivity::class;
    protected $requisition;


    public function __construct()
    {
        //
        $this->requisition =  (new  RequisitionRepository());

    }
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('program_activities.id AS id'),
            DB::raw('program_activities.user_id AS user_id'),
            DB::raw('program_activities.number AS number'),
            DB::raw('program_activities.amount_requested AS amount_requested'),
            DB::raw('program_activities.amount_paid AS amount_paid'),
            DB::raw('program_activities.created_at AS created_at'),
            DB::raw('program_activities.uuid AS uuid'),
//            DB::raw('program_activities.requisition_training_id AS requisition_training_id'),
            DB::raw('program_activities.region_id AS region_id'),
        ])
            ->join('users','users.id', 'program_activities.user_id');
    }
public function getActivityAttendance($program_activity_id)
{
    $this->getQuery()
        ->join('program_activity_attendances', 'program_activity_attendances.program_activity_id','program_activities.id')
        ->where('program_activity_attendances.program_activity_id', $program_activity_id);
}

public function storeActivityAttendance($inputs, $uuid)
{

    foreach ($inputs as $id)
    {
        $attendance =  ProgramActivityAttendance::query()->where('requisition_training_cost_id',$id)->whereDate('created_at', Carbon::today())->first();
        $attendance == null ? $this->checkInParticipants($id,$uuid) : false;
        $attendance != null and $attendance->checkout_time != null ? alert()->error('Today attendance was captured') : false;
        $attendance != null and $attendance->checkout_time == null ? $this->checkOutParticipant($attendance) : false;
    }
    return redirect()->back();
}
public function checkInParticipants($id, $uuid)
{
    $program_activity = $this->findByUuid($uuid);
    return DB::transaction(function () use ($id, $program_activity){

        ProgramActivityAttendance::query()->create([
            'program_activity_id'=>$program_activity->id,
            'requisition_training_cost_id'=>$id,
            'checkin_time'=>Carbon::now()
        ]);
        alert()->success('Check in successfully','Success');
    });



}

public function checkOutParticipant($attendance)
{

    return DB::transaction(function () use ($attendance){

        $attendance->update([
            'checkout_time'=>Carbon::now()
        ]);
        alert()->success('Check out successfully','Success');
    });

}

    public function getActivitiesWithoutReports(){
        return $this->getQuery()

            ->join('requisition_trainings', 'program_activities.requisition_training_id', 'requisition_trainings.id')
            ->join('districts', 'requisition_trainings.district_id', 'districts.id')
            ->where('program_activities.wf_done', 1)
            ->where('program_activities.user_id', access()->user()->id)
            ->where('report_submitted', false)
            ->whereDate('requisition_trainings.start_date', '<=', Carbon::today());

    }
    public function getActivitiesWithoutReportsFilter(){

        return $this->getActivitiesWithoutReports()
            ->select([
                'program_activities.number',
                'program_activities.id',
                DB::raw("CONCAT_WS(' ', program_activities.number, districts.name, requisition_trainings.start_date, requisition_trainings.end_date ) AS activity")

            ])
            ->join('requisitions','requisitions.id', 'requisition_trainings.requisition_id')
            ->where('requisitions.is_closed',false);
    }
    public function getParticipants()
    {
        return $this->query()->select([
            DB::raw('program_activities.requisition_id AS requisition_id'),
            DB::raw('program_activities.id AS program_activity_id'),
            DB::raw('requisition_training_costs.participant_uid AS user_id'),
            DB::raw('requisition_training_costs.perdiem_total_amount AS perdiem'),
            DB::raw('requisition_training_costs.no_days AS no_days'),
            DB::raw('requisition_training_costs.transportation AS transportation'),
            DB::raw('requisition_training_costs.other_cost AS other_cost'),
            DB::raw('g_officers.id AS g_officer_id'),
        ])
            ->join('requisition_training_costs', 'requisition_training_costs.requisition_id', 'program_activities.requisition_id')
            ->join('g_officers','g_officers.id', 'requisition_training_costs.participant_uid');
    }

    public function getAllApprovedProgramActivities()
    {
        return $this->getQuery()
            ->where('program_activities.wf_done', 1)
            ->where('program_activities.paid', false);
    }



    public function inputProcess( $inputs)
    {
        $requisition_training = requisition_training::query()->find($inputs['requisition_training_id']);
        $requisition = Requisition::findOrFail($requisition_training['requisition_id']);
//dd($requisition_training->district->region->id);
        return[
            'region_id'=>$requisition_training->district->region->id,
            'requisition_training_id' => $inputs['requisition_training_id'],
            'user_id'=>  access()->user()->id,
            'requisition_id' => $requisition->id,
            'amount_requested'=>$requisition->amount,
            'amount_paid'=>0,
            'scope'=>''

        ];
    }
    public function store($inputs)
    {

        return DB::transaction(function () use ($inputs){
            return $this->query()->create($this->inputProcess($inputs));
        });
    }

    public function update($inputs, $uuid)
    {

        return DB::transaction(function () use ($inputs, $uuid){

            $programActivity = $this->findByUuid($uuid);
            $number = $this->generateNumber($programActivity);
            DB::update('update program_activities set number = ?, done = ? where uuid=?', [$number, 1, $uuid]);
        });

    }
//        public function getProgramActivityParticipants()
//        {
//            return $this->query()->select([
//               DB::raw('program_activity_participants.id AS id' ),
//                DB::raw('program_activity_participants.g_officer_id AS g_officer_id'),
//                DB::raw('program_activity_participants.program_activity_id AS program_activity_id'),
//                DB::raw('program_activity_participants.attended AS attended'),
//                DB::raw('program_activity_participants.is_substitute AS is_substitute'),
//                DB::raw('program_activity_participants.substituted AS substituted'),
//                DB::raw('program_activity_participants.substituted_with AS substituted_with'),
//            ])
//                ->join('program_activities','program_activities.id', 'program_activity_participants.program_activity_id');
//        }
//        public function getExistingParticipant()
//        {
//            return $this->getProgramActivityParticipants()
//                ->whereHas('programActivity');
//
//        }

        public function inputProcessParticipant($inputs)
        {
            if (isset($inputs['attended'])){
            $attendance = "TRUE";
            }
            elseif (isset($inputs['not_attended'])){
                $attendance = "FALSE";
            }
                return[
                    'g_officer_id'=>$inputs['g_officer_id'],
                    'program_activity_id' => $inputs['program_activity_id'],
                   'attended'=>$attendance

                ];
        }

        public function updateParticipant($inputs, $uuid)
        {
            $participant_uid = $inputs['new_participant_id'];
            $substituted_user_id = $inputs['old_participant_id'];
            $requisition_training_cost_id = $inputs['requisition_training_cost_id'];


            return DB::transaction(function () use ($inputs, $uuid, $participant_uid, $substituted_user_id, $requisition_training_cost_id){

                $activity_uuid = $inputs['activity_uuid'];
                DB::update('update requisition_training_costs set participant_uid = ?, is_substitute = ?, substituted_user_id = ? where id=?', [$participant_uid, "TRUE", $substituted_user_id, $requisition_training_cost_id]);


            });
        }
    public function updateProgramActivity($inputs, $uuid)
    {
        $program_activity =  ProgramActivity::query()->where('uuid', $uuid);
        $report = $inputs['report'];
        $next_user = access()->user()->assignedSupervisor()->supervisor_id;

        return DB::transaction(function () use ($inputs, $uuid, $report, $next_user){

            DB::update('update program_activities set report = ?, supervised_by = ?  where uuid=?', [$report,$next_user,  $uuid]);


        });
    }
        public function attended($inputs, $uuid)
        {

            return DB::transaction(function () use ($inputs, $uuid){



                DB::update('update requisition_training_costs set attend = ? where uuid=?', [true,  $uuid]);


            });

        }
    public function undo($inputs, $uuid)
    {


        return DB::transaction(function () use ($inputs, $uuid){

            $attendance  = requisition_training_cost::all()->where('uuid', $uuid)->pluck('attend');
            $substitute =   requisition_training_cost::all()->where('uuid', $uuid)->pluck('is_substitute');
            $training_cost = requisition_training_cost::all()->where('uuid', $uuid)->first();
            if ($substitute == true || $attendance ==  true)

            {

                DB::update('update requisition_training_costs set participant_uid = ?, attend = ?, is_substitute = ?, substituted_user_id = ?  where uuid=?', [$training_cost->substituted_user_id, false, false, null, $uuid]);
            }




        });

    }


    public function getCompletedWithoutRetirement()
    {
        return $this->getQuery()
            ->where('program_activities.wf_done', 1)
            ->whereDoesntHave('retirement');
    }





    public function getAccessProcessingDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', 0)
            ->where('program_activities.done', 1)
            ->where('program_activities.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', 0)
            ->where('program_activities.done', 1)
            ->where('program_activities.rejected', true)
            ->where('users.id', access()->id());
    }

    public function getAccessProvedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', 1)
            ->where('program_activities.done', 1)
            ->where('program_activities.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessSavedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', 0)
            ->where('program_activities.done', 0)
            ->where('program_activities.rejected', false)
            ->where('users.id', access()->id());
    }
    public function getAccessPaidDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', 0)
//            ->where('safari_advances.done', false)
            ->where('program_activities.rejected', false)
            ->where('program_activities.done', 1)
            ->where('program_activities.paid', true )
            ->where('users.id', access()->id());
    }
    public function getReportNewDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', 1)
            ->where('program_activities.report_approved', false)
            ->where('program_activities.report_rejected', false)
            ->where('program_activities.done', 1)
            ->where('program_activities.supervised_by', access()->id());
    }
    public function getReportApprovedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', 1)
            ->where('program_activities.report_approved', true)
            ->where('program_activities.done', 1)
            ->where('program_activities.supervised_by', access()->id());
    }
    public function getReportRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', 1)
            ->where('program_activities.report_approved', false)
            ->where('program_activities.report_rejected', true)
            ->where('program_activities.done', 1)
            ->where('program_activities.supervised_by', access()->id());
    }

    public function submitPayment($amount_paid, $remarks, $id)
    {
        return DB::transaction(function () use ($amount_paid,$remarks, $id){

            DB::update('update requisition_training_costs set amount_paid= ?, remarks=? where id= ?', [$amount_paid,$remarks, $id]);
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
            case 4:
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
            case 4:
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
        $program_activity = $this->find($resource_id);
        $applicant_level = $this->getApplicantLevel($wf_module_id);
        $head_of_dept_level = $this->getHeadOfDeptLevel($wf_module_id);
//        $account_receivable_level = $this->getAccountReceivableLevel($wf_module_id);
//        if($requisition->rejected){}
        switch ($inputs['rejected_level'] ?? $current_level) {
            case $applicant_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('programactivity.show', $program_activity),
                    'subject' =>$program_activity->number. " Has been revised to your level",
                    'message' => $program_activity->number. ' need modification.. Please do the need and send it back for approval'
                ];
//                User::query()->find($program_activity->user_id)->notify(new WorkflowNotification($email_resource));

                break;
            case $head_of_dept_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('programactivity.show', $program_activity),
                    'subject' =>$program_activity->number . " Has been revised to your level",
                    'message' => $program_activity->number .  ' need modification. Please do the need and send it back for approval'
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
        $program_activity = $this->query()->find($id);
        return DB::transaction(function () use ($program_activity, $sign) {
            $rejected = 0;
            if ($sign == -1) {
                $rejected = 1;
            }
            return $program_activity->update(['rejected' => $rejected]);
        });
    }


}
