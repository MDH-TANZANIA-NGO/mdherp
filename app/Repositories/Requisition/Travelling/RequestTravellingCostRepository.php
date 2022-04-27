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
use App\Services\Calculator\Requisition\InitiatorBudgetChecker;
use Illuminate\Support\Facades\DB;

class RequestTravellingCostRepository extends BaseRepository
{
        use InitiatorBudgetChecker;
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
            DB::raw('requisition_travelling_costs.perdiem_total_amount AS perdiem_total_amount'),
            DB::raw('requisition_travelling_costs.accommodation AS accommodation'),
            DB::raw('requisition_travelling_costs.transportation AS transportation'),
            DB::raw('requisition_travelling_costs.other_cost AS other_cost'),
            DB::raw('requisition_travelling_costs.total_amount AS total_amount'),
        ]);
    }

    public function inputProcess($inputs)
    {
        $destination_region = District::query()->find($inputs['district_id'])->region_id;
        $traveller_region_id = User::query()->find($inputs['traveller_uid'])->region_id;
        $region_status = Region::query()->find($destination_region)->is_city;
        $mdh_rates =  mdh_rate::query()->pluck('amount');

//       dd($mdh_rates[2]);
        $from = $inputs['from'];
        $to = $inputs['to'];
        $datetime1 = new \DateTime($from);
        $datetime2 = new  \DateTime($to);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');
        dd($days);
        $accommodation = $inputs['accommodation'];

        if ($destination_region == $traveller_region_id){
            $perdiem_rate = $mdh_rates[2];
            $ontransit = 0;
            $perdiem_total_amount = $perdiem_rate *$days;
            $accommodation = $accommodation * $days;
            $total_amount = $perdiem_total_amount + $inputs['transportation'] + $inputs['other_cost'] + $accommodation;

        }
        else{
                if ($region_status == 'TRUE'){
                    $perdiem_rate = $mdh_rates[0];
                    $perdiem_total_amount = $perdiem_rate *($days-2);
                    $ontransit = ($perdiem_rate * (0.75)) * 2;
                    $accommodation = $accommodation * ($days);
                    $total_amount = $perdiem_total_amount + $ontransit + $inputs['transportation'] + $inputs['other_cost'] + $accommodation;

                }
                else{

                    $perdiem_rate = $mdh_rates[1];
                    $perdiem_total_amount = $perdiem_rate *($days-2);
                    $accommodation = $accommodation * ($days);
                    $ontransit = ($perdiem_rate * (0.75)) * 2;
                    $total_amount = $perdiem_total_amount + $ontransit + $inputs['transportation'] + $inputs['other_cost'] + $accommodation;

                }

        }

        return [
            'perdiem_total_amount'=> $perdiem_total_amount,
            'traveller_uid' => $inputs['traveller_uid'],
            'district_id'=> $inputs['district_id'],
            'no_days' => $days,
            'ontransit'=> $ontransit,
            'transportation' => $inputs['transportation'],
            'accommodation' => $accommodation,
            'other_cost' => $inputs['other_cost'],
            'others_description' => $inputs['other_cost_description'],
            'ticket_fair' => $inputs['ticket_fair'],
            'from' => $from,
            'to' => $to,
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
        check_available_budget_individual($requisition,$this->inputProcess($inputs)['total_amount'], $requisition->amount, $this->inputProcess($inputs)['total_amount']);
        return DB::transaction(function () use ($requisition, $inputs){
            $requisition->travellingCost()->create($this->inputProcess($inputs));
            $requisition->updatingTotalAmount();
            return $requisition;
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
