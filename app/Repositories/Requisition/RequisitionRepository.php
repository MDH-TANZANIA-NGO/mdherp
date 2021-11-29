<?php

namespace App\Repositories\Requisition;

use App\Models\Requisition\Requisition;
use App\Repositories\BaseRepository;
use App\Services\Calculator\Requisition\InitiatorBudgetChecker;
use App\Services\Generator\Number;
use Illuminate\Support\Facades\DB;

class RequisitionRepository extends BaseRepository
{
    use InitiatorBudgetChecker, Number;

    const MODEL = Requisition::class;

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('requisitions.id AS id'),
            DB::raw('requisitions.number AS number'),
            DB::raw('requisition_types.title AS type_title'),
            DB::raw('requisitions.amount AS amount'),
            DB::raw('requisitions.uuid AS uuid'),
            DB::raw('requisitions.created_at AS created_at'),
            DB::raw('projects.title AS project_title'),
            DB::raw('activities.title AS activity_title'),
        ])
            ->join('requisition_types', 'requisition_types.id','requisitions.requisition_type_id')
            ->join('projects','projects.id', 'requisitions.project_id')
            ->join('activities','activities.id','requisitions.activity_id')
            ->join('users','users.id', 'requisitions.user_id');
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

    public function getAccessRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('requisitions.wf_done', 0)
            ->where('requisitions.done', true)
            ->where('requisitions.rejected', true)
            ->where('users.id', access()->id());
    }

    public function getAccessProvedDatatable()
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
        return [
            'user_id' => access()->id(),
            'requisition_type_id' => $inputs['requisition_type'],
            'requisition_type_category' => $inputs['requisition_type_category'],
            'project_id' => $inputs['project'],
            'activity_id' => $inputs['activity'],
            'region_id' => $inputs['region_id'],
            'budget_id' => $inputs['budget_id'],
        ];
    }

    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
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
        switch($wf_module_id){
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
        switch($wf_module_id){
            case 1:
                $level = 2;
                break;
        }
        return $level;
    }

    /**
     * Process Workflow
     * @param $resource_id
     * @param $wf_module_id
     * @param $current_level
     * @param int $sign
     * @param array $inputs
     * @return void
     */
    public function processWorkflowLevelsAction($resource_id, $wf_module_id, $current_level, $sign=0, array $inputs=[])
    {
        $applicant_level = $this->getApplicantLevel($wf_module_id);
        $head_of_dept_level = $this->getHeadOfDeptLevel($wf_module_id);
//        $account_receivable_level = $this->getAccountReceivableLevel($wf_module_id);
        switch($current_level){
            case $applicant_level:
                $this->updateRejected($resource_id, $sign);
                /*Action on country director level*/
//                $this->sendApprovalNotification($report, $wf_definition->user);
                break;
            case $head_of_dept_level:
                $this->updateRejected($resource_id, $sign);
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
        return DB::transaction(function () use ($requisition, $sign){
            $rejected = 0;
            if($sign == -1){
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
        return DB::transaction(function () use ($requisition){
            return $requisition->update([
                'done' => 1,
//                'supervisor_id' => null,
                'number' => $this->generateNumber($requisition)
            ]);
        });
    }

    public function updatingTotalAmount(Requisition $requisition)
    {
        return DB::transaction(function () use ($requisition){
            return $requisition->update([
                'amount' => $this->getTotalAmountToUpdate($requisition),
            ]);
        });
    }

    public function getTotalAmountToUpdate(Requisition $requisition)
    {
        $total_amount = null;
        switch($requisition->requisition_type_id)
        {
            case 1:
                $total_amount = $requisition->items()->sum('total_amount');
                break;

            case 2:
                switch($requisition->requisition_type_category)
                {
                    case 1:
                        $total_amount = $requisition->travellingCost()->sum('total_amount');
                        break;
                    case 2:
//                        $total_amount = $requisition->items()->sum('total_amount');
                        break;
                }
        }
        return $total_amount;
    }

}
