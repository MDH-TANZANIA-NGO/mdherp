<?php

namespace App\Repositories\Requisition\Travelling;

use App\Models\Auth\User;
use App\Models\MdhRates\mdh_rate;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
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
    protected $requisition;

    public function __construct()
    {
        $this->mdh_rates = (new mdhRatesRepository());
        $this->requisition = (new  RequisitionRepository());
        //
    }
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('requisition_travelling_costs.id AS id'),
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

    public function getAccessTravellingCosts()
    {
        return $this->getQuery()
            ->join('users', 'users.id', 'requisition_travelling_costs.traveller_uid')
            ->where('requisition_travelling_costs.traveller_uid', access()->user()->id);
    }
    public function inputProcess($inputs)
    {

        $destination_region = District::query()->find($inputs['district_id'])->region_id;
        $traveller_region_id = User::query()->find($inputs['traveller_uid'])->region_id;
        $days = getNoDays($inputs['from'], $inputs['to']);
        $perdiem_total_amount = $this->getTravellerTotalMealsAndIncidentials($traveller_region_id,$destination_region,$days);
        $ontransit =  $this->getTravellerOntransitTotalAmount($traveller_region_id, $destination_region, $days);
        $total_amount =  $perdiem_total_amount + $ontransit ;





        return [
            'perdiem_total_amount'=> $perdiem_total_amount,
            'traveller_uid' => $inputs['traveller_uid'],
            'district_id'=> $inputs['district_id'],
            'no_days' => $days,
            'ontransit'=> $ontransit,
            'from' => $inputs['from'],
            'to' => $inputs['to'],
            'total_amount' =>  $total_amount,

        ];



    }

    public function getTravellerTotalMealsAndIncidentials($traveller_region,$destination_region, $days)
    {
        if ($traveller_region == $destination_region){
            if ($days > 1)
            {
                $meals_and_incidential_rate =  $this->mdh_rates->getNotAssignedRegionRate()->get();
                $meals_and_incident = $meals_and_incidential_rate->amount;
                $meals_and_incident_total_amount = $meals_and_incident *($days-1);


            }
            if ($days == 1)
            {
                $meals_and_incident_total_amount = 0;
            }
        }
        if ($traveller_region != $destination_region){
            if ($days > 2)
            {
                $meals_and_incidential_rate =  $this->mdh_rates->getRateByRegion($destination_region);
                $meals_and_incident = $meals_and_incidential_rate[0];
                $meals_and_incident_total_amount = $meals_and_incident *($days-2);


            }
            if ($days <= 2)
            {
                $meals_and_incident_total_amount = 0;
            }
        }

        return $meals_and_incident_total_amount;
    }

    public function getTravellerTotalAccommodation($accommodation, $days)
    {
            if ($days >1){
                $accomodation_total_amount =  $accommodation * ($days-1);
            }

            return $accomodation_total_amount;
    }
    public function getTravellerOntransitTotalAmount($traveller_region,$destination_region, $days)
    {
        if ($traveller_region == $destination_region){

            $ontransit_total_amount = 0;
        }
        if ($traveller_region != $destination_region){
            if ($days >= 2)
            {
                $meals_and_incidential_rate =  $this->mdh_rates->getRateByRegion($destination_region);
                $meals_and_incident = $meals_and_incidential_rate[0];
                $ontransit_amount =  $meals_and_incident *(0.75);
                $ontransit_total_amount = $ontransit_amount * 2;


            }
            if ($days < 2)
            {
                $ontransit_total_amount = 0;
            }
        }

        return $ontransit_total_amount;
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
        check_available_budget_individual($requisition,$this->inputProcess($inputs)['total_amount'], $requisition->amount, $this->inputProcess($inputs)['total_amount']);
        return DB::transaction(function () use ($requisition, $inputs){

            $id = $requisition->travellingCost()->create($this->inputProcess($inputs))->id;
            return $id;

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

        check_available_budget_individual($traveller->requisition, $this->inputProcess($inputs)['total_amount'], $traveller->total_amount, $this->inputProcess($inputs)['total_amount']);

        return DB::transaction(function () use ($traveller, $inputs){
            $traveller->update($this->inputProcess($inputs));

        });
    }

}
