<?php

namespace App\Repositories\Requisition\Travelling;

use App\Models\Requisition\Travelling\travelling_cost;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class travellingRepository extends BaseRepository
{
    const MODEL = travelling_cost::class;
    public function __construct()
    {

    }

    public function travelling(){

        return $this->query()->select([
            DB::raw('travelling_costs.no_days AS no_days'),
            DB::raw('travelling_costs.transportation AS transportation'),
            DB::raw('travelling_costs.accomodation AS accomodation'),
            DB::raw('travelling_costs.perdiem_rate AS perdiem_rate'),
            DB::raw('travelling_costs.other_cost AS other_cost'),
            DB::raw('travelling_costs.total_amount AS total_amount'),
            DB::raw('travelling_costs.district_id AS district_id'),
            DB::raw('travelling_costs.user_id AS user_id'),

        ]);



    }
}
