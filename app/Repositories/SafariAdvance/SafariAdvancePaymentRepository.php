<?php

namespace App\Repositories\SafariAdvance;

use App\Models\SafariAdvance\SafariAdvancePayment;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class SafariAdvancePaymentRepository extends BaseRepository
{
    const MODEL = SafariAdvancePayment::class;
    public function __construct()
    {
        //
    }

    public function inputProcessSafariPayment($input){
        return [
            'safari_advance_id'=>$input['safari_advance_id'],
            'account_no'=>$input['phone'],
            'requisition_id'=>$input['requisition_id'],
            'disbursed_amount'=>$input['total_amount'],
            'requested_amount'=>$input['requested_amount'],


        ];
    }

    public function storeSafariPayment($input){
        return DB::transaction(function () use ($input){
            return $this->query()->create($this->inputProcessSafariPayment($input));
        });
    }
}
