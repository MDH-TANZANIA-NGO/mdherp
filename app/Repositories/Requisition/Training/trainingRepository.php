<?php

namespace App\Repositories\Requisition\Training;

use App\Models\Requisition\Training\training_cost;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class trainingRepository extends BaseRepository
{
    const MODEL = training_cost::class;
    public function __construct()
    {
        //
    }

    public function training()
    {

        return $this->query()->select([
            DB::raw('training_costs.no_days AS no_days'),
            DB::raw('training_costs.transportation AS transportation'),
            DB::raw('training_costs.perdiem_rate AS perdiem_rate'),
            DB::raw('training_costs.other_cost AS other_cost'),
            DB::raw('training_costs.total_amount AS total_amount'),
            DB::raw('training_costs.district_id AS district_id'),
            DB::raw('training_costs.user_id AS user_id'),

        ]);
    }
}
