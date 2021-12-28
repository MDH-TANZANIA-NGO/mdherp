<?php

namespace App\Repositories\SafariAdvance;

use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\SafariAdvance\SafariAdvance;
use App\Repositories\BaseRepository;
use App\Services\Generator\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SafariAdvanceRepository extends BaseRepository
{
    use Number;
    const MODEL = SafariAdvance::class;
    public function __construct()
    {
        //
    }


    public function inputProcess($inputs)
    {
        $requisition_travelling_cost = requisition_travelling_cost::query()->find($inputs['requisition_travelling_cost_id']);
        return[
            'requisition_travelling_cost_id' => $inputs['requisition_travelling_cost_id'],
            'user_id'=> $requisition_travelling_cost->traveller_uid,
            'amount_requested'=>$requisition_travelling_cost->total_amount,
            'amount_paid'=>0,
            'scope'=>'',
            'region_id'=>access()->user()->region_id

        ];
    }
    public function inputDetails($input)
    {
        return [
            'safari_advance_id'=>$input['safari_advance_id'],
            'from'=>$input['from'],
            'to'=>$input['to'],
            'district_id'=>$input['district_id'],
            'perdiem'=>$input['perdiem'],
            'ontrasit'=>$input['ontrasit'],
            'transportation'=>$input['transportation'],
            'other_costs'=>$input['other_costs'],
            'accommodation'=>$input['accommodation'],
            'transport_means'=>$input['transport_means']

        ];
    }
    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            return $this->query()->create($this->inputProcess($inputs));
        });
    }

    public function update($inputs, $uuid)
    {
        $safari = $this->findByUuid($uuid);
        $scope = $inputs['scope'];
        $number = $this->generateNumber($safari);
        DB::update('update safari_advances set scope =?, number = ? where uuid= ?',[$scope, $number, $uuid]);
        //create
        DB::table('safari_advance_details')->insert(
            [
                'safari_advance_id'=>$inputs['safari_advance_id'],
                'from'=>$inputs['from'],
                'to'=>$inputs['to'],
                'district_id'=>$inputs['district_id'],
                'perdiem'=>$inputs['perdiem'],
                'ontransit'=>$inputs['ontransit'],
                'transportation'=>$inputs['transportation'],
                'other_costs'=>$inputs['other_costs'],
                'accommodation'=>$inputs['accommodation'],
                'transport_means'=>$inputs['transport_means']
            ]
        );
    }


}
