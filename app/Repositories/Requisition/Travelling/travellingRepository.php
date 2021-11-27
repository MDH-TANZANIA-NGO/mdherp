<?php

namespace App\Repositories\Requisition\Travelling;

use App\Models\Requisition\Requisition;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\Requisition\Travelling\travelling_cost;
use App\Repositories\BaseRepository;
use App\Repositories\MdhRates\mdhRatesRepository;
use Illuminate\Support\Facades\DB;

class travellingRepository extends BaseRepository
{
    const MODEL = requisition_travelling_cost::class;
    protected $mdh_rates;
    public function __construct()
    {
        $this->mdh_rates= (new mdhRatesRepository());
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
    public function inputProcess($inputs)
    {
        return [
            'traveller_id' => $inputs['user_id'],
            'district_id' => $inputs['district_id'],
            'no_days' => $inputs['no_days'],
            'amount' => $inputs['requested_amount'],
            'total_amount' => $inputs['quantity'] * $inputs['requested_amount']
        ];
    }

    public function store(Requisition $requisition, $inputs)
    {
        return DB::transaction(function () use ($requisition, $inputs){
            $travelling_costs = $requisition->trainingCost()->create($this->inputProcess($inputs));

        });
    }
}
