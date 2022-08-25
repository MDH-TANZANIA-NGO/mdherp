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
            'accommodation'=>$input['accommodation'],
            'transportation'=>$input['transportation'],
            'ontransit'=>$input['ontransit'],
            'other_cost'=>$input['other_cost'],
            'perdiem_total_amount'=>$input['perdiem_total_amount'],
            'requisition_travelling_cost_id'=>$input['requisition_travelling_cost_id'],
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

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('safari_advance_payments.id AS id'),
            DB::raw('safari_advance_id AS safari_advance_id'),
            DB::raw('safari_advance_payments.payment_id AS payment_id'),
            DB::raw('safari_advance_payments.requisition_id AS requisition_id'),
            DB::raw('safari_advance_payments.requested_amount AS requested_amount'),
            DB::raw('safari_advance_payments.disbursed_amount AS disbursed_amount'),
            DB::raw('safari_advance_payments.account_no AS account_no'),
            DB::raw('safari_advance_payments.perdiem_total_amount AS perdiem_total_amount'),
            DB::raw('safari_advance_payments.accommodation AS accommodation'),
            DB::raw('safari_advance_payments.ontransit AS ontransit'),
            DB::raw('safari_advance_payments.other_cost AS other_cost'),
            DB::raw('safari_advance_payments.ticket_fair AS ticket_fair'),
            DB::raw('safari_advance_payments.tranportation AS transportation'),
            DB::raw('safari_advances.number AS safari_advance_number'),
            DB::raw('safari_advances.uuid AS safari_advance_uuid'),
        ])
            ->join('payments','payments.id','safari_advance_payments.payment_id')
            ->join('safari_advances','safari_advances.id','safari_advance_payments.safari_advance_id')
            ->join('users','users.id','safari_advances.user_id');
    }

    public function getSafariAdvanceByPaymentID($payment_id)
    {
        return $this->getQuery()
            ->where('safari_advance_payments.payment_id', $payment_id);
    }
}
