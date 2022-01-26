<?php

namespace App\Repositories\ProgramActivity;

use App\Models\ProgramActivity\ProgramActivity;
use App\Models\ProgramActivity\Traits\ProgramActivityRelationship;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Repositories\BaseRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\Training\RequestTrainingCostRepository;
use App\Services\Generator\Number;
use Illuminate\Support\Facades\DB;

class ProgramActivityRepository extends BaseRepository
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
            DB::raw('program_activities.region_id AS region_id'),
        ])
            ->join('users','users.id', 'program_activities.user_id');
    }
    public function getParticipants()
    {
        return $this->query()->select([
            DB::raw('program_activities.requisition_id AS requisition_id'),
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
            ->where('program_activities.wf_done', true);
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

            DB::update('update program_activities set report = ?, supervised_by = ?  where uuid=?', [$report,$next_user, $uuid]);


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

            if ($substitute == true || $attendance ==  true)

            {
                DB::update('update requisition_training_costs set attend = ?, is_substitute = ?, substituted_user_id = ?  where uuid=?', [false, false, null, $uuid]);
            }




        });

    }





    public function getAccessProcessingDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', false)
            ->where('program_activities.done', 1)
            ->where('program_activities.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', false)
            ->where('program_activities.done', 1)
            ->where('program_activities.rejected', true)
            ->where('users.id', access()->id());
    }

    public function getAccessProvedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', true)
            ->where('program_activities.done', 1)
            ->where('program_activities.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessSavedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', false)
            ->where('program_activities.done', 0)
            ->where('program_activities.rejected', false)
            ->where('users.id', access()->id());
    }
    public function getAccessPaidDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', true)
//            ->where('safari_advances.done', false)
            ->where('program_activities.rejected', false)
            ->where('program_activities.done', 1)
            ->where('program_activities.amount_paid', '>', 0 )
            ->where('users.id', access()->id());
    }
    public function getReportNewDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', true)
            ->where('program_activities.report_approved', false)
            ->where('program_activities.report_rejected', false)
            ->where('program_activities.done', 1)
            ->where('program_activities.supervised_by', access()->id());
    }
    public function getReportApprovedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', true)
            ->where('program_activities.report_approved', true)
            ->where('program_activities.done', 1)
            ->where('program_activities.supervised_by', access()->id());
    }
    public function getReportRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', true)
            ->where('program_activities.report_approved', false)
            ->where('program_activities.report_rejected', true)
            ->where('program_activities.done', 1)
            ->where('program_activities.supervised_by', access()->id());
    }

    public function submitPayment($inputs, $uuid)
    {
        return DB::transaction(function () use ($inputs, $uuid){
            $amount_paid = $inputs['payed_amount'];
            DB::update('update requisition_training_costs set amount_paid= ? where uuid= ?', [$amount_paid, $uuid]);
        });
    }

}
