<?php

namespace App\Repositories\Fleet;

use App\Models\Fleet\Fleet;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class FleetRepository extends BaseRepository
{
    const MODEL = Fleet::class;

    public function getAllFleets()
    {
        return $this->query()->select([
            DB::raw('fleets.vehicle_type AS vehicle_type'),
            DB::raw('fleets.maker AS maker'),
            DB::raw('fleets.model AS model'),
            DB::raw('fleets.body_type AS body_type'),
            DB::raw('fleets.fuel_type AS fuel_type'),
            DB::raw('fleets.engine_size AS engine_size'),
            DB::raw('fleets.vehicle_reg_no as vehicle_reg_no'),
            DB::raw('fleets.driver as driver'),
        ]);
        //->join('activities','activities.id','budgets.activity_id')
    }

}
