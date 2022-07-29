<?php

namespace App\Repositories\InductionSchedule;

use App\Models\InductionSchedule\InductionSchedule;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class InductionScheduleRepository extends BaseRepository {

    const MODEL = InductionSchedule::class;

    public function __construct(){

    }

    public function getQuery(){
        return $this->query()->select([
            DB::raw('induction_schedules.id AS id'),
            DB::raw('induction_schedules.start_date AS start_date'),
            DB::raw('induction_schedules.end_date AS end_date'),
            DB::raw('induction_schedules.designation_id AS designation_id'),
            DB::raw('induction_schedules.created_at AS created_at'),
            DB::raw('induction_schedules.updated_at AS updated_at'),
            DB::raw('induction_schedules.number AS number'),
            DB::raw('induction_schedules.status AS status'),
            DB::raw('designations.id AS id'),
            DB::raw("concat_ws(' ', units.name, designations.name) as name"),
            DB::raw("units.id AS unit_id"),
            DB::raw('induction_schedule_items.induction_schedule_id AS induction_schedule_id'),
            DB::raw('induction_schedule_items.completed_at AS completed_at')
        ])
            ->join('designations', 'designations.id', 'induction_schedules.designation_id')
            ->join('units', 'units.id', 'designations.unit_id')
            ->join('induction_schedule_items', 'induction_schedule_items.induction_schedule_id', 'induction_schedules.id');
    }

    public function getProcessing(){
        return $this->query()
            ->where('status', 0)
            ->whereHas('induction_schedule_items', function($query){
                return $query->where('completed_at', NULL);
            });
    }

    public function getCompleted(){
        return $this->getQuery()
            ->where('status', 1);
    }
}
