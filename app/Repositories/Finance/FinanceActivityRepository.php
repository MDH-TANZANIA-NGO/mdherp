<?php

namespace App\Repositories\Finance;

use App\Models\Payment\Payment;
use App\Models\ProgramActivity\ProgramActivity;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\SafariAdvance\SafariAdvance;
use App\Repositories\BaseRepository;
use App\Services\Generator\Number;
use Illuminate\Support\Facades\DB;

class FinanceActivityRepository extends BaseRepository
{
    use Number;
    const MODEL= Payment::class;

    public function __construct()
    {
        //
    }


    public function inputProcess($inputs)
    {
//        $number = $this->generateNumber();
        if ($inputs['pay_to'] == 1)
        {
            $payed_amount =  $inputs['participant_total'];
        }elseif ($inputs['pay_to'] == 2)
        {
            $payed_amount =  $inputs['vendor_total'];
        }elseif ($inputs['pay_to'] == 3)
        {
            $payed_amount =  $inputs['both_total'];
        }else{
            $payed_amount = $inputs['total_amount'];
        }
        return[
//            'number'=>$number,
            'region_id'=> $inputs['region_id'],
            'requisition_id' => $inputs['requisition_id'],
            'requested_amount'=> $inputs['requested_amount'],
            'payment_method'=>$inputs['payment_method'],
//            'account_number'=>$inputs['phone'],
            'user_id'=>access()->user()->id,
            'remarks'=>$inputs['remarks'],

            'payed_amount'=>$payed_amount,

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
            $pay = $this->findByUuid($uuid);
            $number = $this->generateNumber($pay);
             $is_safari =  requisition_travelling_cost::where('requisition_id', $pay->requisition_id)->first();
             $is_programactivity =  ProgramActivity::where('requisition_id', $pay->requisition_id)->first();

             DB::update('update payments set done =?, number = ? where uuid= ?',[1, $number, $uuid]);


             if ($is_programactivity)
             {
                 DB::update('update program_activities set paid = ?, amount_paid = ? where uuid = ?', [true, $pay->payed_amount, $is_programactivity->uuid]);
             }elseif ($is_safari)
             {
                 $safari_uuid = SafariAdvance::where('requisition_travelling_cost_id', $is_safari->id)->first()->uuid;
                 DB::update('update safari_advances set paid = ?, amount_paid = ? where uuid = ?',[true, $pay->payed_amount, $safari_uuid] );
             }

        });
    }



}
