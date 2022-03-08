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
            DB::raw('count(program_activity_attendances.id ) AS total'),
            DB::raw('program_activity_attendances.date AS date'),
            DB::raw('program_activity_attendances.checkin_time AS checkin_time'),
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
    public function getAggregateAttendanceForEachParticipant()
    {
        return $this->getQuery()
            ->groupBy('program_activity_attendances.created_at')
            ->where('requisition_trainings.end_date', '<=', date("Y-m-d",strtotime(Carbon::now())));
    }

    public function getAttendanceGroupedByParticipants()
    {
        return $this->getQuery()
            ->groupBy('program_activity_attendances.program_activity_id')
            ->where('requisition_trainings.end_date', '<=', date("Y-m-d",strtotime(Carbon::now())));
    }


}
