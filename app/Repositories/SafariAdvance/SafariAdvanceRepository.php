<?php

namespace App\Repositories\SafariAdvance;

use App\Events\NewWorkflow;
use App\Http\Controllers\Web\Safari\Datatables\SafariDatatables;
use App\Models\Auth\User;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\SafariAdvance\SafariAdvance;
use App\Models\SafariAdvance\SafariAdvanceHotelSelection;
use App\Notifications\Workflow\WorkflowNotification;
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
            'ontransit'=>$input['ontransit'],
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
    public function storeHotelReservation($inputs)
    {
        return DB::transaction(function () use ($inputs){
            return SafariAdvanceHotelSelection::query()->create(
                [
                    'safari_advance_id'=>$inputs['safari_advance_id'],
                    'hotel_id'=>$inputs['hotel_id'],
                    'priority_level'=>$inputs['priority_level'],

                ]
            );
        });
    }

    public function update($inputs, $uuid)
    {


        return DB::transaction(function () use ($inputs, $uuid){
            $safari = $this->findByUuid($uuid);
            $scope = $inputs['scope'];
            $number = $this->generateNumber($safari);

            if ($safari->done == true)
            {
                DB::table('safari_advance_details')->update($this->inputDetails($inputs));
                DB::update('update safari_advances set scope =?  where uuid= ?',[$scope,  $uuid]);

            }
            else{
                DB::update('update safari_advances set scope =?, number = ?, done = ? where uuid= ?',[$scope, $number,true, $uuid]);
                //create
                DB::table('safari_advance_details')->insert($this->inputDetails($inputs));
            }

        });


    }

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('safari_advances.id AS id'),
            DB::raw('safari_advances.user_id AS user_id'),
            DB::raw("concat_ws(' ', users.first_name, users.last_name) as full_name"),
            DB::raw('users.email AS email'),
            DB::raw('users.phone AS phone'),
            DB::raw('safari_advances.number AS number'),
            DB::raw('safari_advances.number AS number'),
            DB::raw('safari_advances.amount_requested AS amount_requested'),
            DB::raw('safari_advances.amount_paid AS amount_paid'),
            DB::raw('safari_advances.created_at AS created_at'),
            DB::raw('safari_advances.amount_paid AS amount_paid'),
            DB::raw('safari_advances.uuid AS uuid'),
        ])
            ->join('users','users.id', 'safari_advances.user_id');
    }

    public function getAllApprovedSafari()
    {
        return$this->getQuery()
            ->where('safari_advances.wf_done', true)
            ->where('safari_advances.paid', false);
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
            ->where('safari_advances.wf_done', 1)
//            ->where('safari_advances.done', true)
            ->where('safari_advances.rejected', false)
            ->where('users.id', access()->id());
    }
    public function getAccessSavedDatatable()
    {
        return $this->getQuery()
            ->whereDoesntHave('wfTracks')
            ->where('safari_advances.wf_done', 0)
            ->where('safari_advances.done', false)
            ->where('safari_advances.rejected', false)
            ->where('safari_advances.number', null)
            ->where('users.id', access()->id());
    }
    public function getAccessPaidDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('safari_advances.wf_done', 1)

            ->where('users.id', access()->id())
//            ->where('safari_advances.done', false)
            ->where('safari_advances.rejected', false)
            ->whereHas('safarPayments');
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
            DB::raw('safari_advances.amount_requested AS amount_requested'),
            DB::raw('safari_advances.amount_paid AS amount_paid'),
        ])
            ->join('safari_advance_details', 'safari_advance_details.safari_advance_id', 'safari_advances.id');
    }

    public function getDisbursedAmount()
    {
        return $this->getQuery()->select([
           DB::raw('safari_advance_payments.disbursed_amount AS disbursed_amount'),
           DB::raw('safari_advances.id AS safari_id'),
        ])
            ->leftjoin('safari_advance_payments','safari_advance_payments.safari_advance_id','safari_advances.id');
    }

    public function payment($inputs, $uuid )
    {
        return DB::transaction(function () use ($inputs, $uuid){
            $amount_paid = $inputs['payed_amount'];
            $this->getQuery()->get()->pluck('user_id');
//            dd($this->getQuery()->where('uuid', $uuid)->get()->pluck('safari_advance.uuid'));

            DB::update('update safari_advances set amount_paid =? where uuid= ?',[$amount_paid,  $uuid]);
            //create
            DB::table('payments')->insert(
                [
                    'referenced_table'=> 'safari_advances',
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
            ->where('safari_advances.wf_done', 1)
            ->whereDoesntHave('retirement');
    }
    public function getCompletedWithRetirement()
    {
        return $this->getQuery()
            ->where('safari_advances.wf_done', 1)
            ->whereHas('retirement');
    }

    public function getPaidSafari($safari_id)
    {
        return $this->getQuery()
            ->select([
                DB::raw('safari_advance_payments.id AS payment_id'),
                DB::raw('safari_advance_payments.account_no AS account_number'),
                DB::raw('safari_advance_payments.disbursed_amount AS disbursed_amount'),
            ])
            ->leftjoin('safari_advance_payments', 'safari_advance_payments.safari_advance_id', 'safari_advances.id')
        ->where('safari_advances.id', $safari_id);
    }



    public function getCompletedAccessWithoutRetirement()
    {
        return $this->getCompletedAccessWithoutRetirement()
            ->where('users.id', access()->id());
    }

    public function getCompletedAccessWithoutRetirementForPluck()
    {
        return $this->getCompletedAccessWithoutRetirement()
            ->get()
            ->pluck('safari_advances.number','safari_advances.id');
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
            case 3:
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
            case 3:
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
        $safari = $this->find($resource_id);
        $applicant_level = $this->getApplicantLevel($wf_module_id);
        $head_of_dept_level = $this->getHeadOfDeptLevel($wf_module_id);
//        $account_receivable_level = $this->getAccountReceivableLevel($wf_module_id);
//        if($requisition->rejected){}
        switch ($inputs['rejected_level'] ?? $current_level) {
            case $applicant_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('safari.show', $safari),
                    'subject' =>$safari->number. " Has been revised to your level",
                    'message' => $safari->number. ' need modification.. Please do the need and send it back for approval'
                ];
                User::query()->find($safari->user_id)->notify(new WorkflowNotification($email_resource));

                break;
            case $head_of_dept_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('safari.show', $safari),
                    'subject' =>$safari->number . " Has been revised to your level",
                    'message' => $safari->number .  ' need modification. Please do the need and send it back for approval'
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
        $safari = $this->query()->find($id);
        return DB::transaction(function () use ($safari, $sign) {
            $rejected = 0;
            if ($sign == -1) {
                $rejected = 1;
            }
            return $safari->update(['rejected' => $rejected]);
        });
    }

}
