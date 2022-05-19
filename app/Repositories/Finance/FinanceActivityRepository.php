<?php

namespace App\Repositories\Finance;

use App\Models\Payment\Payment;
use App\Models\ProgramActivity\ProgramActivity;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\SafariAdvance\SafariAdvance;
use App\Notifications\Workflow\WorkflowNotification;
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

    public function getQuery()
    {
        {
            return $this->query()->select([
                DB::raw('payments.id AS id'),
                DB::raw('payments.payed_amount AS payed_amount'),
                //DB::raw("concat_ws(' ', users.first_name, users.last_name) as full_name"),
                DB::raw('payments.requested_amount AS requested_amount'),
                DB::raw('payments.number AS number'),
                DB::raw('safari_advance_payments.disbursed_amount AS disbursed_amount'),
                DB::raw('safari_advance_payments.account_no AS account_no'),
                DB::raw('safari_advance_payments.perdiem_total_amount AS perdiem_total_amount'),
                DB::raw('safari_advance_payments.transportation AS transportation'),
                DB::raw('safari_advance_payments.requisition_travelling_cost_id AS requisition_travelling_cost_id'),
                DB::raw('safari_advance_payments.accommodation AS accommodation'),
                DB::raw('safari_advance_payments.ontransit AS ontransit'),
                DB::raw('safari_advance_payments.other_cost AS other_cost'),
                DB::raw('safari_advance_payments.ticket_fair AS ticket_fair'),
            ])
                ->leftjoin('safari_advance_payments','safari_advance_payments.payment_id', 'payments.id');
        }
    }

    public function getPaidSafari($safari_id)
    {
        return $this->getQuery()->where('safari_advance_payments.safari_advance_id', $safari_id);
    }



    public function inputProcess($inputs)
    {

        return[

            'region_id'=> (int) $inputs['region_id'],
            'requisition_id' =>(int) $inputs['requisition_id'],
            'requested_amount'=> (int)$inputs['requested_amount'],
            'user_id'=>access()->user()->id,
            'remarks'=>$inputs['remarks'],

            'payed_amount'=>(int) $inputs['total_amount'],

        ];
    }
    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            $payment_id = $this->query()->create($this->inputProcess($inputs))->id;
            return $payment_id;
        });


    }


    public function update($inputs, $uuid)
    {
        return DB::transaction(function () use ($inputs, $uuid){
            $pay = $this->findByUuid($uuid);
            $number = $this->generateNumber($pay);
            $is_safari =  requisition_travelling_cost::where('requisition_id', $pay->requisition_id)->first();
            $is_programactivity =  ProgramActivity::where('requisition_id', $pay->requisition_id)->first();

            if ($pay->done == 0)
            DB::update('update payments set done =?, number = ? where uuid= ?',[1, $number, $uuid]);
            else{
                DB::update('update payments set payed_amount =? where uuid= ?',[ $inputs['total_amount'], $uuid]);
            }

          if ($is_safari)
            {
                $safari_uuid = SafariAdvance::where('requisition_travelling_cost_id', $is_safari->id)->first()->uuid;
                DB::update('update safari_advances set paid = ?, amount_paid = ? where uuid = ?',[true, $pay->payed_amount, $safari_uuid] );
            }

        });
    }


    /**
     * Get applicant level
     * @param $wf_module_id
     * @return int|null
     * Get fron desk level per module id
     */
    public function getApplicantLevel($wf_module_id)
    {
        $level = null;
        switch ($wf_module_id) {
            case 7:
                $level = 1;
                break;
        }
        return $level;
    }

    /**
     * Get applicant level
     * @param $wf_module_id
     * @return int|null
     * Get fron desk level per module id
     */
    public function getHeadOfDeptLevel($wf_module_id)
    {
        $level = null;
        switch ($wf_module_id) {
            case 7:
                $level = 2;
                break;
        }
        return $level;
    }

    /**
     * @param $resource_id
     * @param $wf_module_id
     * @param $current_level
     * @param int $sign
     * @param array $inputs
     * @throws \App\Exceptions\GeneralException
     */
    public function processWorkflowLevelsAction($resource_id, $wf_module_id, $current_level, $sign = 0, array $inputs = [])
    {
        $payment = $this->find($resource_id);
        $applicant_level = $this->getApplicantLevel($wf_module_id);
        $head_of_dept_level = $this->getHeadOfDeptLevel($wf_module_id);
//        $account_receivable_level = $this->getAccountReceivableLevel($wf_module_id);
//        if($requisition->rejected){}
        switch ($inputs['rejected_level'] ?? $current_level) {
            case $applicant_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('programactivity.show', $payment),
                    'subject' =>$payment->number. " Has been revised to your level",
                    'message' => $payment->number. ' need modification.. Please do the need and send it back for approval'
                ];
//                User::query()->find($payment->user_id)->notify(new WorkflowNotification($email_resource));

                break;
            case $head_of_dept_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('programactivity.show', $payment),
                    'subject' =>$payment->number . " Has been revised to your level",
                    'message' => $payment->number .  ' need modification. Please do the need and send it back for approval'
                ];
//                  User::query()->find($this->nextUserSelector($wf_module_id, $resource_id, $current_level))->notify(new WorkflowNotification($email_resource));

                break;
        }
    }

    /**
     * Update rejected column
     * @param $id
     * @param $sign
     * @return mixed
     */
    public function updateRejected($id, $sign)
    {
        $payment = $this->query()->find($id);
        return DB::transaction(function () use ($payment, $sign) {
            $rejected = 0;
            if ($sign == -1) {
                $rejected = 1;
            }
            return $payment->update(['rejected' => $rejected]);
        });
    }




}
