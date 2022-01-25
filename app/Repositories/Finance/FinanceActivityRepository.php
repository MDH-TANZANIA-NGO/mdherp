<?php

namespace App\Repositories\Finance;

use App\Models\Payment\Payment;
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
        }
        return[
//            'number'=>$number,
            'region_id'=> $inputs['region_id'],
            'requisition_id' => $inputs['requisition_id'],
            'requested_amount'=> $inputs['requested_amount'],
            'payment_method'=>$inputs['payment_method'],
            'account_number'=>$inputs['account_no'],
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

            DB::update('update payments set done =?, number = ? where uuid= ?',[1, $number, $uuid]);

        });
    }
}
