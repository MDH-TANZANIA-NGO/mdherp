<?php

namespace App\Repositories\Requisition;

use App\Models\Auth\User;
use App\Models\Requisition\Requisition;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use App\Services\Calculator\Requisition\InitiatorBudgetChecker;
use App\Services\Generator\Number;
use App\Services\Workflow\Traits\WorkflowUserSelector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RequisitionRepository extends BaseRepository
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
            DB::raw('requisitions.is_closed AS is_closed'),
            DB::raw('requisitions.created_at AS created_at'),
//            DB::raw('projects.title AS project_title'),
            DB::raw('activities.title AS activity_title'),
        ])
            ->join('requisition_types', 'requisition_types.id', 'requisitions.requisition_type_id')
            ->join('projects', 'projects.id', 'requisitions.project_id')
            ->join('activities', 'activities.id', 'requisitions.activity_id')
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

    public function getAllApprovedRequisitions()
    {
        return $this->getQueryAll()
            ->where('requisitions.wf_done', 1);
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
            return $this->query()->create($this->inputProcess($inputs));
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
              //  User::query()->find($this->nextUserSelector($wf_module_id, $resource_id, $current_level))->notify(new WorkflowNotification($email_resource));

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
            ->where('projects.id', $project_id)
            ->where('budgets.activity_id', $activity_id)
            ->where('budgets.region_id', $region_id);
    }

    /**
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
            ->where('requisitions.done', true);
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


}
