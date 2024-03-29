<?php

namespace App\Repositories\ProgramActivity;

use App\Models\ProgramActivity\ProgramActivityAttendance;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProgramActivityAttendanceRepository extends BaseRepository
{
    const MODEL = ProgramActivityAttendance::class;
    public function __construct()
    {
        //
    }

    public function getQuery(){

        return $this->query()->select([
            DB::raw('program_activity_attendances.id AS id'),
//            DB::raw('count(program_activity_attendances.id ) AS total'),
            DB::raw('program_activity_attendances.date AS date'),
            DB::raw('program_activity_attendances.requisition_training_cost_id AS requisition_training_cost_id'),
            DB::raw('program_activity_attendances.checkin_time AS checkin_time'),
            DB::raw('program_activity_attendances.checkout_time AS checkout_time'),
            DB::raw('program_activity_attendances.created_at AS created_at'),
            DB::raw('program_activity_attendances.checkin_longitude AS checkin_longitude'),
            DB::raw('program_activity_attendances.checkin_latitude AS checkin_latitude'),
            DB::raw('program_activity_attendances.checkin_location AS checkin_location'),
            DB::raw('program_activity_attendances.checkout_longitude AS checkout_longitude'),
            DB::raw('program_activity_attendances.checkout_latitude AS checkout_latitude'),
            DB::raw('program_activity_attendances.checkout_location AS checkout_location'),
            DB::raw('program_activity_attendances.program_activity_id AS program_activity_id')


        ])
            ->join('program_activities', 'program_activities.id','program_activity_attendances.program_activity_id')
            ->join('requisition_trainings', 'requisition_trainings.id', 'program_activities.requisition_training_id');
    }
    public function getAttendanceByDate($program_activity_id, $report_date)
    {
        return $this->query()->select([
            'requisition_training_costs.participant_uid AS participant_uid',
            'requisition_training_costs.transportation AS transportation',
            'requisition_training_costs.other_cost AS other_cost',
            'g_officers.first_name AS first_name',
            'g_officers.last_name AS last_name',
            'g_officers.phone AS phone',
            'requisition_training_costs.perdiem_total_amount AS perdiem_total_amount',
            'requisition_training_costs.total_amount AS total_amount',
            'requisition_training_costs.amount_paid AS amount_paid',
            'requisition_training_costs.is_substitute AS is_substitute',
            'program_activity_attendances.id AS id',
            'program_activity_attendances.requisition_training_cost_id AS requisition_training_cost_id',

        ])
            ->join('program_activities', 'program_activities.id','program_activity_attendances.program_activity_id')
            ->join('requisition_trainings', 'requisition_trainings.id', 'program_activities.requisition_training_id')
            ->join('requisition_training_costs','requisition_training_costs.id','program_activity_attendances.requisition_training_cost_id')
            ->join('g_officers','g_officers.id','requisition_training_costs.participant_uid')
            ->where('program_activity_attendances.program_activity_id', $program_activity_id)
            ->where('requisition_trainings.start_date','<=', $report_date);
    }

    public function getParticipantAttendanceofActivity($requisition_training_cost_id)
    {
        return $this->getQuery()
            ->join('requisition_training_costs', 'requisition_training_costs.id','program_activity_attendances.requisition_training_cost_id')
            ->where('program_activity_attendances.requisition_training_cost_id', $requisition_training_cost_id)
            ->get();
    }
    public function checkTodayAttendance($requisition_training_cost_id)
    {
        return $this->getQuery()
            ->whereIn('program_activity_attendances.requisition_training_cost_id', $requisition_training_cost_id)
            ->whereDate('program_activity_attendances.created_at', Carbon::today());
    }
    public function getIndividualTodayAttendance($requisition_training_cost_id)
    {
        return $this->getQuery()
            ->where('program_activity_attendances.requisition_training_cost_id', $requisition_training_cost_id)
            ->whereDate('program_activity_attendances.created_at', Carbon::today())
            ->first();
    }
    public function getAggregateAttendanceForEachParticipant()
    {
        return $this->getQuery()
            ->groupBy('program_activity_attendances.created_at')
            ->where('requisition_trainings.end_date', '<=', date("Y-m-d",strtotime(Carbon::now())));
    }
public function getDataForPaymentExport($program_activity_id)
{
    return $this->query()->select([
        'requisition_training_costs.participant_uid AS participant_uid',
        'requisition_training_costs.transportation AS transportation',
        'requisition_training_costs.other_cost AS other_cost',
        'g_officers.first_name AS first_name',
        'g_officers.last_name AS last_name',
        'g_officers.phone AS phone',
        'requisition_training_costs.perdiem_total_amount AS perdiem_total_amount',
        'requisition_training_costs.total_amount AS total_amount',
        'requisition_training_costs.amount_paid AS amount_paid',
        'requisition_training_costs.is_substitute AS is_substitute',
        'program_activity_attendances.id AS id',
        'program_activity_attendances.requisition_training_cost_id AS requisition_training_cost_id',

    ])
        ->join('program_activities', 'program_activities.id','program_activity_attendances.program_activity_id')
        ->join('requisition_trainings', 'requisition_trainings.id', 'program_activities.requisition_training_id')
        ->join('requisition_training_costs','requisition_training_costs.id','program_activity_attendances.requisition_training_cost_id')
        ->join('g_officers','g_officers.id','requisition_training_costs.participant_uid')
        ->where('program_activity_attendances.program_activity_id', $program_activity_id);
}
    public function getAttendanceGroupedByParticipants()
    {
        return $this->getQuery()
            ->groupBy('program_activity_attendances.program_activity_id')
            ->where('requisition_trainings.end_date', '<=', date("Y-m-d",strtotime(Carbon::now())));
    }


}
