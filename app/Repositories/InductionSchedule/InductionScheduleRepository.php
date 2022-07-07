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
            DB::raw('induction_schedules.created_at AS created_at'),
            DB::raw('induction_schedules.updated_at AS updated_at'),
            DB::raw('induction_schedules.number AS number'),
            DB::raw('induction_schedules.status AS status'),
            DB::raw('designations.id AS id'),
            DB::raw('')
        ]);
    }
}
