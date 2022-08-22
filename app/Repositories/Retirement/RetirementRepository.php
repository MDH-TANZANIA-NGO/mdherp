<?php

namespace App\Repositories\Retirement;

use App\Http\Controllers\Web\Retirement\Datatables\RetirementDatatables;
use App\Models\Auth\User;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\Retirement\Retirement;
use App\Models\Retirement\RetirementDetail;
use App\Models\SafariAdvance\SafariAdvance;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use App\Services\Generator\Number;
use App\Services\Workflow\Traits\WorkflowUserSelector;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class RetirementRepository extends BaseRepository
{
    use Number, WorkflowUserSelector;
    const MODEL = Retirement::class;
    //const MODEL = Media::class;



    public function __construct()
    {
        //
    }
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('retirements.id AS id'),
            DB::raw('retirements.user_id AS user_id'),
            DB::raw('retirements.number AS number'),
            DB::raw('retirements.amount_requested AS amount_requested'),
            DB::raw('payments.payed_amount AS amount_paid'),
            DB::raw('retirements.created_at AS created_at'),
            DB::raw('retirements.uuid AS uuid'),
        ])
            ->join('users','users.id', 'retirements.user_id')
            ->join('safari_advances','safari_advances.id','retirements.safari_advance_id')
            ->join('requisition_travelling_costs','requisition_travelling_costs.id','safari_advances.requisition_travelling_cost_id')
            ->join('requisitions','requisitions.id','requisition_travelling_costs.requisition_id')
            ->join('payments','payments.requisition_id','requisitions.id');
    }

    public function getattachment()
    {
        return $this->query()->select([
            DB::raw('media.name AS attachment_name')
        ]);
    }

    public function getAllApprovedRetirements()
    {
        return $this->getQuery()
            ->where('retirements.wf_done', true);
    }

    public function getAccessProcessingRetirementDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('retirements.wf_done_date', null)
            ->where('retirements.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessRejectedRetirementDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('retirements.wf_done', 0)
            ->where('retirements.rejected', true)
            ->where('users.id', access()->id());
    }

    public function getAccessApprovedRetirementDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('retirements.wf_done', true)
            ->where('retirements.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessSavedRetirementDatatable()
    {
        return $this->getQuery()
            ->whereDoesntHave('wfTracks')
            ->where('retirements.wf_done', false)
            ->where('retirements.done', false)
            ->where('retirements.rejected', false)
            ->where('retirements.number', null)
            ->where('users.id', access()->id());
    }

    public function inputProcess($inputs)
    {
       $safari_advance_id = SafariAdvance::all()->find($inputs['safari_advance_id']);
        return[

            'user_id'=> access()->user()->id,
            'safari_advance_id' => $inputs['safari_advance_id'],
            'amount_requested'=>$safari_advance_id->amount_requested,
            'amount_paid'=>$safari_advance_id->amount_paid,
            'amount_received'=>0,
            'activity_report'=>'',
            'region_id'=>access()->user()->region_id

        ];
    }
    public function inputProcessUpdate($inputs)
    {
        $safari_advance = SafariAdvance::where('id', $inputs['safari_advance_id'])->first();
        $retirement = Retirement::where('safari_advance_id', $safari_advance->id)->first();

        return[
/*
            'retirement_id'=> $retirement->id,
            'safari_advance_id'=>$inputs['safari_advance_id'],

            'district_id'=>$inputs['district_id'],
            'amount_requested'=>$inputs['amount_requested'],
            'amount_paid'=>$inputs['amount_paid'],
            'amount_received'=>$inputs['amount_received'],
            'from'=>$inputs['from'],
            'to'=>$inputs['to'],
            'amount_spent'=>$inputs['amount_spent'],
            'amount_variance'=>$inputs['amount_variance'],
            'activity_report'=>$inputs['activity_report'],
            'planned_report'=>$inputs['planned_report'],
            'no_participants'=>$inputs['no_participants'],
            'objective_report'=>$inputs['objective_report'],
            'methodology_report'=>$inputs['methodology_report'],
            'achievement_report'=>$inputs['achievement_report'],
            'challenge_report'=>$inputs['challenge_report'],
            'action_report'=>$inputs['action_report'], */

            'from'=>$inputs['from'],
            'to'=>$inputs['to'],
            'accomodation'=>$inputs['accomodation'],
            'perdiem_total_amount'=>$inputs['perdiem_total_amount'],
            'ticket_fair'=>$inputs['ticket_fair'],
            'ontransit'=>$inputs['ontransit'],
            'transportation'=>$inputs['transportation'],
            'other_cost'=>$inputs['other_cost'],
            'total_amount'=>$inputs['total_amount'],
            'total_amount_paid'=>$inputs['total_amount_paid'],
            'balance'=>$inputs['balance'],
            'activity_report'=>$inputs['activity_report'],

        ];
    }

    public function UpdateProcessRetirement($inputs)
    {
        return[
            /*'amount_spent'=>$inputs['amount_spent'],
            'amount_variance'=>$inputs['amount_variance'],
            'activity_report'=>$inputs['activity_report'],
            'planned_report'=>$inputs['planned_report'],
            'no_participants'=>$inputs['no_participants'],
            'objective_report'=>$inputs['objective_report'],
            'methodology_report'=>$inputs['methodology_report'],
            'achievement_report'=>$inputs['achievement_report'],
            'challenge_report'=>$inputs['challenge_report'],
            'action_report'=>$inputs['action_report'],*/

            'from'=>$inputs['from'],
            'to'=>$inputs['to'],
            'accomodation'=>$inputs['accomodation'],
            'perdiem_total_amount'=>$inputs['perdiem_total_amount'],
            'ticket_fair'=>$inputs['ticket_fair'],
            'ontransit'=>$inputs['ontransit'],
            'transportation'=>$inputs['transportation'],
            'other_cost'=>$inputs['other_cost'],
            'total_amount'=>$inputs['total_amount'],
            'total_amount_paid'=>$inputs['total_amount_paid'],
            'balance'=>$inputs['balance'],
            'activity_report'=>$inputs['activity_report'],

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
            $retire = $this->findByUuid($uuid);
            if($retire->done==TRUE){
                $this->query()->update($this->inputProcess($inputs));
                return DB::table('retirement_details')->update($this->inputProcessUpdate($inputs));
            }
            else{
                $number = $this->generateNumber($retire);
                DB::update('update retirements set number= ? where uuid= ?',[$number, $uuid]);

                DB::table('retirement_details')->insert(
                    [
                        'retirement_id'=> $retire->id,
                        'safari_advance_id'=>$inputs['safari_advance_id'],
                        'number' => $number,
                        'from'=>$inputs['from'],
                        'to'=>$inputs['to'],
                        'accomodation'=>$inputs['accomodation'],
                        'perdiem_total_amount'=>$inputs['perdiem_total_amount'],
                        'ticket_fair'=>$inputs['ticket_fair'],
                        'ontransit'=>$inputs['ontransit'],
                        'transportation'=>$inputs['transportation'],
                        'other_cost'=>$inputs['other_cost'],
                        'total_amount'=>$inputs['total_amount'],
                        'total_amount_paid'=>$inputs['total_amount_paid'],
                        'balance'=>$inputs['balance'],
                        'activity_report'=>$inputs['activity_report'],

//                      'district_id'=>$inputs['district_id'],

                       /* 'amount_requested'=>$inputs['amount_requested'],
                        'amount_paid'=>$inputs['amount_paid'],
                        'amount_received'=>$inputs['amount_received'],
                        'amount_spent'=>$inputs['amount_spent'],
                        'amount_variance'=>$inputs['amount_variance'],
                        'activity_report'=>$inputs['activity_report'],
                        'planned_report'=>$inputs['planned_report'],
                        'no_participants'=>$inputs['no_participants'],
                        'objective_report'=>$inputs['objective_report'],
                        'methodology_report'=>$inputs['methodology_report'],
                        'achievement_report'=>$inputs['achievement_report'],
                        'challenge_report'=>$inputs['challenge_report'],
                        'action_report'=>$inputs['action_report'],*/

                    ]

                );

            }

        });
    }

    public function refurbishing($inputs, $uuid){

        return DB::transaction(function () use ($inputs, $uuid){
            //$this->query()->update($this->inputProcess($inputs));
            return DB::table('retirement_details')->update($this->UpdateProcessRetirement($inputs));

        });

    }



    /*Tumeanzia hapa kucopy*/

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
            case 5:
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
            case 5:
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
        $retirement = $this->find($resource_id);
        $applicant_level = $this->getApplicantLevel($wf_module_id);
        $head_of_dept_level = $this->getHeadOfDeptLevel($wf_module_id);
//        $account_receivable_level = $this->getAccountReceivableLevel($wf_module_id);
//        if($requisition->rejected){}
        switch ($inputs['rejected_level'] ?? $current_level) {
            case $applicant_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('retirement.show', $retirement),
                    'subject' => $retirement->number . " Has been revised to your level",
                    'message' =>  $retirement->number . ' need modification.. Please do the need and send it back for approval'
                ];
//                User::query()->find($requisition->user_id)->notify(new WorkflowNotification($email_resource));

                break;
            case $head_of_dept_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('requisition.show', $retirement),
                    'subject' => $retirement->number . " Has been revised to your level",
                    'message' => $retirement->number . ' need modification.. Please do the need and send it back for approval'
                ];
               //   User::query()->find($this->nextUserSelector($wf_module_id, $resource_id, $current_level))->notify(new WorkflowNotification($email_resource));

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
        $retirement = $this->query()->find($id);

        return DB::transaction(function () use ($retirement, $sign) {
            $rejected = 0;
            if ($sign == -1) {
                $rejected = 1;
            }

            return $retirement->update(['rejected' => $rejected]);
        });
    }





}
