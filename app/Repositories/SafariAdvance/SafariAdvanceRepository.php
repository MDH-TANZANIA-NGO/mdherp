<?php

namespace App\Repositories\SafariAdvance;

use App\Events\NewWorkflow;
use App\Http\Controllers\Web\Safari\Datatables\SafariDatatables;
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
        return DB::transaction(function () use ($inputs, $uuid){
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
        });
    }

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('safari_advances.id AS id'),
            DB::raw('safari_advances.user_id AS user_id'),
            DB::raw('safari_advances.number AS number'),
            DB::raw('safari_advances.amount_requested AS amount_requested'),
            DB::raw('safari_advances.amount_paid AS amount_paid'),
            DB::raw('safari_advances.created_at AS created_at'),
            DB::raw('safari_advances.uuid AS uuid'),
        ])
            ->join('users','users.id', 'safari_advances.user_id');
    }

    public function getAccessProcessingDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('safari_advances.wf_done_date', null)
//            ->where('safari_advances.done', true)
            ->where('safari_advances.rejected', false)
            ->where('users.id', access()->id());
    }
    public function getAccessRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('safari_advances.wf_done', 0)
//            ->where('safari_advances.done', true)
            ->where('safari_advances.rejected', true)
            ->where('users.id', access()->id());
    }
    public function getAccessProvedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('safari_advances.wf_done', true)
//            ->where('safari_advances.done', true)
            ->where('safari_advances.rejected', false)
            ->where('users.id', access()->id());
    }
    public function getAccessSavedDatatable()
    {
        return $this->getQuery()
            ->whereDoesntHave('wfTracks')
            ->where('safari_advances.wf_done', false)
            ->where('safari_advances.done', false)
            ->where('safari_advances.rejected', false)
            ->where('safari_advances.number', null)
            ->where('users.id', access()->id());
    }
    public function getAccessPaidDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('safari_advances.wf_done', true)
//            ->where('safari_advances.done', false)
            ->where('safari_advances.rejected', false)
            ->where('safari_advances.amount_paid', '!=', 0 )
            ->where('users.id', access()->id());
    }
    public function getSafariDetails()
    {
        return $this->getQuery()->select([
            DB::raw('safari_advance_details.from AS from'),
            DB::raw('safari_advance_details.to AS to'),
            DB::raw('safari_advance_details.district_id AS district_id'),
            DB::raw('safari_advance_details.perdiem AS perdiem'),
            DB::raw('safari_advance_details.ontransit AS ontransit'),
            DB::raw('safari_advance_details.transportation AS transportation'),
            DB::raw('safari_advance_details.other_costs AS other_costs'),
            DB::raw('safari_advances.id AS safari_id'),
        ])
            ->join('safari_advance_details', 'safari_advance_details.safari_advance_id', 'safari_advances.id');
    }
    public function payment($inputs, $uuid)
    {
        return DB::transaction(function () use ($inputs, $uuid){
            $amount_paid = $inputs['payed_amount'];

            DB::update('update safari_advances set amount_paid =? where uuid= ?',[$amount_paid,  $uuid]);
            //create
            DB::table('payments')->insert(
                [
                    'payment_method'=>$inputs['payment_method'],
                    'reference'=>$inputs['reference'],
                    'payed_amount'=>$inputs['payed_amount'],
                    'requested_amount'=>$inputs['requested_amount'],
                    'account_number'=>$inputs['number'],
                    'remarks'=>$inputs['remarks'],

                ]
            );
        });

    }

    public function getCompletedWithoutRetirement()
    {
        return $this->getQuery()
            ->where('safari_advances.wf_done', true)
            ->whereDoesntHave('retirement');
    }

    public function getCompletedAccessWithoutRetirement()
    {
        return $this->getCompletedAccessWithoutRetirement()
            ->where('users.id', access()->id());
    }

    public function getCompletedAccessWithoutRetirementForPluck()
    {
        return $this->getCompletedAccessWithoutRetirement()
            ->get()->pluck('safari_advances.number','safari_advances.id');
    }

}
