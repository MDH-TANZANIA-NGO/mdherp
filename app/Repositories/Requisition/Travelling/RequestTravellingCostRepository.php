<?php

namespace App\Repositories\Requisition\Travelling;

use App\Models\Auth\User;
use App\Models\MdhRates\mdh_rate;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\Requisition\Travelling\requisition_travelling_cost_district;
use App\Models\Requisition\Travelling\Traits\Relationship\RequisitionTravellingCostRelationship;
use App\Models\System\District;
use App\Models\System\Region;
use App\Repositories\BaseRepository;
use App\Repositories\MdhRates\mdhRatesRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Services\Calculator\GetNoDays\GetNoDays;
use App\Services\Calculator\Requisition\InitiatorBudgetChecker;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\DB;

class RequestTravellingCostRepository extends BaseRepository
{
        use InitiatorBudgetChecker, GetNoDays;
    const MODEL = requisition_travelling_cost::class;

    protected $mdh_rates;
//    protected $requisition;
//    protected $requisition_travelling_cost_district_repository;
    public function __construct()
    {
        $this->mdh_rates = (new mdhRatesRepository());
//        $this->requisition = (new  RequisitionRepository());
//        $this->requisition_travelling_cost_district_repository =  (new RequisitionTravellingCostDistrictsRepository());
        //
    }
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('requisition_travelling_costs.id AS id'),
            DB::raw('requisition_travelling_costs.requisition_id AS requisition_id'),
            DB::raw('requisition_travelling_costs.traveller_uid AS traveller_uid'),
            DB::raw('requisition_travelling_costs.no_days AS no_days'),
            DB::raw('requisition_travelling_costs.from AS from'),
            DB::raw('requisition_travelling_costs.to AS to'),
            DB::raw('requisition_travelling_costs.perdiem_total_amount AS perdiem_total_amount'),
            DB::raw('requisition_travelling_costs.accommodation AS accommodation'),
            DB::raw('requisition_travelling_costs.transportation AS transportation'),
            DB::raw('requisition_travelling_costs.other_cost AS other_cost'),
            DB::raw('requisition_travelling_costs.total_amount AS total_amount'),
        ]);
    }

    public function updateAmounts($uuid,$accomodation = null, $transportation = null, $other_cost = null, $perdiem_total_amount = null, $ticket_fair = null, $ontransit = null, $total_amount)
    {
        $traveller = $this->findByUuid($uuid);

        return DB::transaction(function () use ($traveller, $accomodation, $transportation, $ontransit,$total_amount, $other_cost, $perdiem_total_amount, $ticket_fair){
            $traveller->update([
                'accommodation'=>$accomodation,
                'transportation'=>$transportation,
                    'other_cost'=>$other_cost,
                 'perdiem_total_amount'=>$perdiem_total_amount,
            'ticket_fair'=>$ticket_fair,
            'on_transit'=>$ontransit,
            'total_amount'=>$total_amount
            ]);

        });
    }
    public function getAccessTravellingCosts()
    {
        return $this->getQuery()
            ->join('users', 'users.id', 'requisition_travelling_costs.traveller_uid')
            ->where('requisition_travelling_costs.traveller_uid', access()->user()->id);
    }
    public function inputProcess($inputs)
    {

        $traveller_region_id = User::query()->find($inputs['traveller_uid'])->region_id;
        $days = getNoDays($inputs['from'], $inputs['to']);
        $perdiem_total_amount = 0;
        $ontransit =  0;
        $total_amount =  $perdiem_total_amount + $ontransit ;





        return [
            'perdiem_total_amount'=> $perdiem_total_amount,
            'traveller_uid' => $inputs['traveller_uid'],
            'no_days' => $days,
            'ontransit'=> $ontransit,
            'from' => $inputs['from'],
            'to' => $inputs['to'],
            'total_amount' =>  $total_amount,

        ];



    }


    /**
     * @param Requisition $requisition
     * @param $inputs
     * @return mixed
     */
    public function store(Requisition $requisition, $inputs)
    {
        $input_process =  $this->inputProcess($inputs);
        if ($input_process['from'] > $input_process['to'])
        {
            alert()->error('Check and reselect your from and to dates','Dates Error');
            return redirect()->back();
        }
//        check_available_budget_individual($requisition,$this->inputProcess($inputs)['total_amount'], $requisition->amount, $this->inputProcess($inputs)['total_amount']);
        return DB::transaction(function () use ($requisition, $inputs){
            return $requisition->travellingCost()->create($this->inputProcess($inputs))->id;

        });
    }




    public function getRequisition()
    {
        return $this->getQuery()
            ->join('requisitions', 'requisitions.id', 'requisition_travelling_costs.requisition_id')
            ->join('districts', 'districts.id', 'requisition_travelling_costs.district_id');
    }
    public function getRequisitionFilter()
    {
        return $this->getRequisition()
            ->select([
                'requisitions.number',
                'requisition_travelling_costs.id',
                DB::raw("CONCAT_WS(' ', requisitions.number, districts.name, requisition_travelling_costs.from, requisition_travelling_costs.to ) AS travelling")
            ])
            ->where('requisitions.wf_done', 1)
            ->where('requisition_travelling_costs.traveller_uid', access()->id())
            ->whereDoesntHave('safariAdvance');
    }
    public function getPluckRequisitionNo()
    {
        return $this->getRequisitionFilter()->pluck('travelling','requisition_travelling_costs.id');

    }
    public function update($uuid, $inputs)
    {

        $traveller = $this->findByUuid($uuid);
        $traveller_trips =  requisition_travelling_cost_district::query()->where('requisition_travelling_cost_id', $traveller->id)->first();

        return DB::transaction(function () use ($traveller, $inputs){
            $traveller->update(
                [
                    'district_id'   =>$inputs['district_id'],
                    'transportation'=>$inputs['transportation'],
                    'ticket_fair'=>$inputs['ticket_fair'],
                    'other_cost'=>$inputs['other_cost'],
                    'others_description'=>$inputs['other_cost_description'],
                    'total_amount'=>$inputs['transportation']+$inputs['ticket_fair']+ $inputs['other_cost'],
                ]
            );

        });
    }
    public function getAllTravellingCostOfSameRequisition($requisition_id)
    {
        return $this->getQuery()
            ->where('requisition_id', $requisition_id)
            ->get();
    }

}
