<?php

namespace App\Repositories\Requisition;

use App\Exceptions\GeneralException;
use App\Models\Auth\User;
use App\Models\Project\Traits\Relationship\ActivityRelationship;
use App\Models\Requisition\Requisition;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use App\Services\Calculator\Requisition\InitiatorBudgetChecker;
use App\Services\Generator\Number;
use App\Services\Workflow\Traits\WorkflowUserSelector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Project\Project;

class
RequisitionRepository extends BaseRepository
{
    use InitiatorBudgetChecker, Number, WorkflowUserSelector;

    const MODEL = Requisition::class;

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('requisitions.id AS id'),
            DB::raw('requisitions.number AS number'),
            DB::raw('requisition_types.title AS type_title'),
            DB::raw('requisitions.amount AS amount'),
            DB::raw('requisitions.uuid AS uuid'),
            DB::raw('requisitions.user_id AS user_id'),
            DB::raw('requisitions.user_id AS user_id'),
            DB::raw('requisitions.wf_done AS wf_done'),
            DB::raw('requisitions.wf_done_date AS wf_done_date'),
            DB::raw('requisitions.requisition_type_category AS requisition_type_category'),
            DB::raw('requisitions.user_id AS user_id'),
            DB::raw('requisitions.rejected AS rejected'),
            DB::raw('requisitions.code AS code'),
            DB::raw('requisitions.created_at AS created_at'),
            DB::raw('requisitions.updated_at AS updated_at'),
            DB::raw('requisitions.deleted_at AS deleted_at'),
            DB::raw('regions.name AS region_name'),
            DB::raw('requisitions.is_closed AS is_closed'),
            DB::raw('requisitions.created_at AS created_at'),
            DB::raw('projects.title AS project_title'),
            DB::raw('activities.title AS activity_title'),
        ])
            ->join('requisition_types', 'requisition_types.id', 'requisitions.requisition_type_id')
            ->join('projects', 'projects.id', 'requisitions.project_id')
            ->join('activities', 'activities.id', 'requisitions.activity_id')
            ->join('regions', 'requisitions.region_id', 'regions.id')
            ->join('users', 'users.id', 'requisitions.user_id');
    }

    public function getQueryAll()
    {
        return $this->query()->select([
            DB::raw('requisitions.id AS id'),
            DB::raw('requisitions.number AS number'),
            DB::raw('requisitions.amount AS amount'),
            DB::raw('requisitions.uuid AS uuid'),
            DB::raw('requisitions.created_at AS created_at'),])
            ->join('users', 'users.id', 'requisitions.user_id');
    }
    public function getPayedAmount()
    {
        return $this->query()->select([
            DB::raw('requisitions.id AS id'),
            DB::raw('requisitions.budget_id AS budget_id'),
            DB::raw('requisitions.amount AS requested_amount'),
            DB::raw('payments.id AS payment_id'),
            DB::raw('payments.payed_amount AS paid_amount'),])
            ->join('payments','payments.requisition_id', 'requisitions.id')
            ->where('requisitions.is_closed', true)
            ->whereHas('budget');
    }

//    Get all approved requests but which they have not been closed

   public function getAllApprovedNotClosedRequisitions()
   {
       return $this->getAllApprovedRequisitions()
           ->where('requisitions.is_closed', false);
   }

/*   Get all requisitions which are approved and they are for
    training or other program activities*/

    public function getAllApprovedTrainingRequisitions()
    {
        return $this->getAllApprovedRequisitions()
            ->where('requisitions.requisition_type_category', 2);
    }
    /*   Get all requisitions which are approved and they are for
        training or other program activities but they have not been closed */

    public function getAllApprovedTrainingNotClosedRequisitions()
    {
        return $this->getAllApprovedTrainingRequisitions()
            ->where('requisitions.is_closed', false);
    }

    /*   Get all requisitions which are approved and they are for
       training or other program activities but they have not been closed By region*/

    public function getAllApprovedTrainingNotClosedRequisitionsByRegion($region_id)
    {
        return $this->getAllApprovedTrainingNotClosedRequisitions()
            ->where('requisitions.region_id', $region_id);
    }

//    Get all approved requisitions from all requisition types

    public function getAllApprovedRequisitions()
    {
        return $this->getQueryAll()
            ->where('requisitions.wf_done', 1);
    }
    public function getAllApprovedNotClosedInSameBudget()
    {
        return $this->getAllApprovedRequisitions()
            ->where('is_closed', false)
            ->whereHas('budget');
    }
    public function getAllApprovedClosedInSameBudget()
    {
        return $this->getAllApprovedRequisitions()
            ->where('is_closed', true)
            ->whereHas('budget');
    }
    public function getAllNotApprovedInTheSameBudget()
    {
                return $this->getQueryAll()
                    ->where('wf_done', 0)
                    ->whereHas('budget');
    }
    public function getAllDeniedInTheSameBudget()
    {
        return $this->getQueryAll()
            ->where('wf_done', 5)
            ->whereHas('budget');
    }

    public function getAccessProcessingDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('requisitions.wf_done', 0)
            ->where('requisitions.done', true)
            ->where('requisitions.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessPaidDatatable()
    {
        return $this->query()->select([
            DB::raw('requisitions.id AS id'),
            DB::raw('requisitions.number AS number'),
            DB::raw('requisitions.amount AS amount'),
            DB::raw('requisitions.uuid AS uuid'),
            DB::raw('requisitions.is_closed AS is_closed'),
            DB::raw('requisition_types.title AS type_title'),
            DB::raw('activities.title AS activity_title'),
            DB::raw('payments.id AS payment_id'),
            DB::raw('payments.payed_amount AS payed_amount'),
            DB::raw('requisitions.created_at AS created_at'),])
            ->join('requisition_types', 'requisition_types.id', 'requisitions.requisition_type_id')
            ->join('projects', 'projects.id', 'requisitions.project_id')
            ->join('activities', 'activities.id', 'requisitions.activity_id')
            ->join('users', 'users.id', 'requisitions.user_id')
            ->join('payments', 'payments.requisition_id', 'requisitions.id')
            ->whereHas('wfTracks')
            ->where('requisitions.wf_done', 1)
            ->where('requisitions.done', true)
            ->where('requisitions.rejected', false)
            ->whereHas('payments')
            ->where('users.id', access()->id());
    }

    public function getAccessRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('requisitions.wf_done', 0)
            ->where('requisitions.done', true)
            ->where('requisitions.rejected', true)
            ->where('users.id', access()->id());
    }

    public function getAccessDeniedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('requisitions.wf_done', 5)
            ->where('requisitions.done', true)
            ->where('requisitions.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessApprovedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('requisitions.wf_done', 1)
            ->where('requisitions.done', true)
            ->where('requisitions.rejected', false)
            ->where('users.id', access()->id());
    }


    public function getAccessSavedDatatable()
    {
        return $this->getQuery()
            ->whereDoesntHave('wfTracks')
            ->where('requisitions.wf_done', 0)
            ->where('requisitions.done', false)
            ->where('requisitions.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAllRequisitions()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('requisitions.done', true);
    }

    /**
     * @param $requisition_type_id
     * @param $project_id
     * @param $activity_id
     * @param $region_id
     * @param $fiscal_year
     * @return array
     */
    public function getResults($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year)
    {
        return $this->check($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year);
    }

    public function inputProcess($inputs)
    {
//        $description = $inputs['description'];
        return [
            'user_id' => access()->id(),
            'requisition_type_id' => $inputs['requisition_type'],
            'requisition_type_category' => $inputs['requisition_type_category'],
            'project_id' => $inputs['project'],
            'activity_id' => $inputs['activity'],
            'region_id' => $inputs['region_id'],
            'budget_id' => $inputs['budget_id'],
            'type' => access()->user()->designation_id == 13 ? 2 : 1,
        ];
    }

    public function store($inputs)
    {

        return DB::transaction(function () use ($inputs) {
            $requisition_id =  $this->query()->create($this->inputProcess($inputs))->id;
            $requisition =  $this->find($requisition_id);
             $this->storeIndividualAvailableBudget($requisition);

             return $requisition;

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
            case 1:
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
            case 1:
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
        $requisition = $this->find($resource_id);
        $applicant_level = $this->getApplicantLevel($wf_module_id);
        $head_of_dept_level = $this->getHeadOfDeptLevel($wf_module_id);
//        $account_receivable_level = $this->getAccountReceivableLevel($wf_module_id);
//        if($requisition->rejected){}
        switch ($inputs['rejected_level'] ?? $current_level) {
            case $applicant_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('requisition.show', $requisition),
                    'subject' => $requisition->typeCategory->title . " Has been revised to your level",
                    'message' => $requisition->typeCategory->title . " " . $requisition->number . ' need modification.. Please do the need and send it back for approval'
                ];
//                User::query()->find($requisition->user_id)->notify(new WorkflowNotification($email_resource));

                break;
            case $head_of_dept_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('requisition.show', $requisition),
                    'subject' => $requisition->typeCategory->title . " Has been revised to your level",
                    'message' => $requisition->typeCategory->title . " " . $requisition->number . ' need modification.. Please do the need and send it back for approval'
                ];
              User::query()->find($this->nextUserSelector($wf_module_id, $resource_id, $current_level))->notify(new WorkflowNotification($email_resource));

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
        $requisition = $this->query()->find($id);

        return DB::transaction(function () use ($requisition, $sign) {
            $rejected = 0;
            if ($sign == -1) {
                $rejected = 1;
            }
            return $requisition->update(['rejected' => $rejected]);
        });
    }

    /**
     * Update is done column and generate number
     * @param Requisition $requisition
     * @return mixed
     */
    public function updateDoneAssignNextUserIdAndGenerateNumber(Requisition $requisition)
    {
        return DB::transaction(function () use ($requisition) {
            return $requisition->update([
                'done' => 1,

//                'supervisor_id' => null,
                'number' => $this->generateNumber($requisition)
            ]);
        });
    }

    public function updatingTotalAmount(Requisition $requisition)
    {
        return DB::transaction(function () use ($requisition) {
            return $requisition->update([
                'amount' => $this->getTotalAmountToUpdate($requisition),
            ]);
        });
    }

    public function getTotalAmountToUpdate(Requisition $requisition)
    {
        $total_amount = null;
        switch ($requisition->requisition_type_id) {
            case 1:
                $total_amount = $requisition->items()->sum('total_amount');
                break;

            case 2:
                switch ($requisition->requisition_type_category) {
                    case 1:
                        $total_amount = $requisition->travellingCost()->sum('total_amount');

                        break;
                    case 2:
                        $total_amount1 = $requisition->trainingCost()->sum('total_amount');
                        $total_amount2 = $requisition->trainingItems()->sum('total_amount');
                        $total_amount = $total_amount1 + $total_amount2;
                        break;
                }
        }
        return $total_amount;
    }

    /**
     * @return mixed
     */
    public function getQueryExtended($project_id, $activity_id, $region_id)
    {
        return $this->query()
            ->join('projects', 'projects.id', 'requisitions.project_id')
            ->join('budgets', 'budgets.id', 'requisitions.budget_id')
            ->join('activities', 'activities.id', 'budgets.activity_id')
            ->join('regions', 'regions.id', 'budgets.region_id')
            ->join('fiscal_years', 'fiscal_years.id', 'budgets.fiscal_year_id')
            ->leftjoin('payments', 'payments.requisition_id','requisitions.id')
            ->where('projects.id', $project_id)
            ->where('budgets.activity_id', $activity_id)
            ->where('budgets.region_id', $region_id);
    }

    public function getPipelines()
    {
        return $this->query()
            ->where('requisitions.wf_done', 0)
            ->where('requisitions.done', true)
            ->whereHas('budget');

    }

    public function getCommitmentOnTheSameBudget()
    {
        return $this->query()
            ->where('requisitions.wf_done', 1)
            ->where('requisitions.done', true)
            ->whereHas('budget')
            ->whereDoesntHave('payments');
    }
    public function getActualExpenditure()
    {
        return $this->query()
            ->where('requisitions.wf_done', 1)
            ->where('requisitions.done', true)
            ->whereHas('budget')
            ->leftjoin('payments', 'payments.requisition_id', 'requisitions.id')
            ->where('payments.wf_done', 1);
    }

    /**
     * Get sum pipeline for treatment and care
     * @param $project_id
     * @param $activity_id
     * @param $region_id
     * @return mixed
     */
    public function getSumOnPipeline($project_id, $activity_id, $region_id)
    {
        return $this->getQueryExtended($project_id, $activity_id, $region_id)
            ->where('fiscal_years.active', true)
            ->where('requisitions.wf_done', 0)
            ->where('requisitions.done', true);
    }

    /**
     * get Above Site Sum Pipeline
     * @param $project_id
     * @param $activity_id
     * @return mixed
     */
    public function getAboveSiteSumPipeline($project_id, $activity_id)
    {
        return $this->query()
            ->join('projects', 'projects.id', 'requisitions.project_id')
            ->join('budgets', 'budgets.id', 'requisitions.budget_id')
            ->join('activities', 'activities.id', 'budgets.activity_id')
            ->leftjoin('regions', 'regions.id', 'budgets.region_id')
            ->join('fiscal_years', 'fiscal_years.id', 'budgets.fiscal_year_id')
            ->leftjoin('payments', 'payments.requisition_id','requisitions.id')
            ->where('projects.id', $project_id)
            ->where('budgets.activity_id', $activity_id)
            ->where('fiscal_years.active', true)
            ->where('requisitions.wf_done', 0)
            ->where('requisitions.done', true);
    }

    public function getSumOnPipelineFilter($project_id, $activity_id, $region_id)
    {
        return Project::query()->where('id',$project_id)->first()->is_above_site ? $this->getAboveSiteSumPipeline($project_id, $activity_id) : $this->getSumOnPipeline($project_id, $activity_id, $region_id);
    }

    /**
     * @param $project_id
     * @param $activity_id
     * @param $region_id
     * @return mixed
     */
    public function getCommitment($project_id, $activity_id, $region_id)
    {
        return $this->getQueryExtended($project_id, $activity_id, $region_id)
            ->where('fiscal_years.active', true)
            ->where('requisitions.wf_done', 1)
            ->where('requisitions.done', true)
            ->where('payments.id',null)
            ->orwhere('payments.wf_done',0);
    }

    /**
     * @param $project_id
     * @param $activity_id
     * @param $region_id
     * @return mixed
     */
    public function getActualExpenditures($project_id, $activity_id, $region_id)
    {
        return $this->getQueryExtended($project_id, $activity_id, $region_id)
            ->where('fiscal_years.active', true)
            ->where('requisitions.wf_done', 1)
            ->where('requisitions.done', true)
//            ->where('payments.id',null)
            ->where('payments.wf_done',1);
    }

    public function processComplete(Requisition $requisition)
    {
        return DB::transaction(function () use ($requisition) {
            $requisition->budget->update([
                'actual_amount' => $requisition->budget->actual_amount - $requisition->amount,
            ]);
        });
    }
    public function  updateActualAmount(Requisition $requisition)
    {

        return DB::transaction(function () use ($requisition) {
            $requisition->budget->update([
                'actual_amount' => $requisition->budget->actual_amount + ($requisition->amount - $requisition->payments->payed_amount),
            ]);
            $requisition->update([
               'is_closed'=>'true',
            ]);
        });
    }

    public function storeIndividualAvailableBudget($requisition)
    {

        $budget = $this->check($requisition->requisition_type_id, $requisition->project_id,$requisition->activity_id, $requisition->region_id, $requisition->budget()->first()->fiscal_year_id);
        $available_budget = $budget['actual'] + $budget['pipeline'];

       return $requisition->fundChecker()->create([
            'requisition_id'=>$requisition->id,
            'available_budget'=>$available_budget,
            'actual_amount'=>$available_budget
        ]);
    }

    public function updateIndividualAvailableBudget($requisition, $requested, $addition = null)
    {
        $current_amount = 0;
        if ($requisition->amount) {
            $current_amount = $requisition->amount;
        }
        if ($addition) {
            $difference_amount = $current_amount - $requested;

//
            $actual_amount = $requisition->fundChecker()->first()->actual_amount + $difference_amount;

            $requisition->fundChecker()->update([
                'actual_amount' => $actual_amount
            ]);


        }
    }
    /*public function checkAvailableBudgetIndividual($requisition, $total_amount, $current_amount = null, $updated_amount = null)
    {
        $check_budget = $requisition->fundChecker()->first();
//        dd($check_budget);
        if ($check_budget->actual_amount < $total_amount) {
        }
    }*/

   /* public function updateIndividualAvailableBudget($requisition, $available_budget,$requested_amount,$options)
    {
//        $calculated_actual_amount = 0;
//        if($options['stored']){
//            $calculated_actual_amount = $available_budget - $requested_amount;
//        }
//
//        //$item->audits()->orderBy('id', 'DESC')->first()->old_values['total_amount']
//
//        if($options['updated']){
//            if($options['item']){
//                if($options['item']->total_amount < $requested_amount){
//
//                }else{
//
//                }
//            }
//        }
//
//        return DB::transaction(function () use($requisition,$calculated_actual_amount){
//            $requisition->fundChecker()->update([
//                'actual_amount'=>$calculated_actual_amount,
//            ]);
//        });


//        $current_amount=0;
//        if($requisition->amount){
//            $current_amount = $requisition->amount;
//        }
//        if ($addition)
//        {
//            $difference_amount =  $current_amount - $requested;
//            $actual_amount = $requisition->fundChecker()->first()->actual_amount + $difference_amount;
//            $requisition->fundChecker()->update([
//                'actual_amount'=>$actual_amount
//            ]);
//        }else{
//            $difference_amount =  $requested - $current_amount;
//            $actual_amount = $requisition->fundChecker()->first()->actual_amount - $difference_amount;
//            $requisition->fundChecker()->update([
//                'actual_amount'=>$actual_amount
//            ]);
//        }


    }*/
    public function checkAvailableBudgetIndividual($requisition, $requested_amount,$options = [])
    {
        $check_budget = $requisition->fundChecker()->first();
        if ($check_budget->actual_amount < $requested_amount){

            throw new GeneralException('Insufficient Fund' );
        }
        return $this->updateIndividualAvailableBudget($requisition, $check_budget->actual_amount,$requested_amount, $options);



    }

/*    These functions

    will be used as helpers
     in Direct requisitions*/

    public function getNoDays($from, $to)
    {

        $datetime1 = new \DateTime($from);
        $datetime2 = new  \DateTime($to);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');
        $days = (int)$days + 1;


        return $days;
    }


}
