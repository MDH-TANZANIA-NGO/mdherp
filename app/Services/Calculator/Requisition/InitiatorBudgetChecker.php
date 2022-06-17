<?php

namespace App\Services\Calculator\Requisition;

use App\Models\Requisition\RequisitionType\RequisitionType;
use App\Repositories\Project\ActivityRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\RequisitionType\RequisitionTypeRepository;
use App\Models\Rate\Rate;
use Illuminate\Support\Facades\Log;

trait InitiatorBudgetChecker
{
    public function check($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year)
    {

        return [
            'project' => $this->activity($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year)->project_list,
            'activity' => $this->activity($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year)->code_title,
//            'requisition_type' => $this->requisition($requisition_type_id)->title,
            'sub_program_area' => $this->activity($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year)->sub_program_title,
            'numeric_output' => $this->activity($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year)->numeric_output,
            'output_unit' => $this->activity($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year)->output_unit_title,
            'budget' => $this->activity($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year)->budget_amount,
            'budget_id' => $this->activity($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year)->budget_id,
            'actual' => $this->activity($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year)->budget_actual_amount,
            'commitment' => $this->commitment($project_id, $activity_id, $region_id),
            'pipeline' => $this->pipeline($project_id, $activity_id, $region_id),
            'actual_expenditure'=> $this->actualExpenditure($project_id, $activity_id, $region_id),
            'available budget' => null,
            'exchange_rate' => $this->exchangeRate($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year),
        ];
    }

    public function activity($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year)
    {

        return (new ActivityRepository())->getSubQueryFilter($activity_id, $project_id, $region_id)->first();
    }

    public function requisition($requisition_type_id)
    {
        return (new RequisitionTypeRepository())->query()->where('id',$requisition_type_id)->first();
    }

    public function pipeline($project_id, $activity_id, $region_id)
    {
//        return (new RequisitionRepository())->getPipelines()->sum('requisitions.amount');
//        return (new RequisitionRepository())->getSumOnPipeline($project_id, $activity_id, $region_id)->sum('requisitions.amount');
        return (new RequisitionRepository())->getAboveSiteSumPipeline($project_id, $activity_id, $region_id)->sum('requisitions.amount');
    }
    public function commitment($project_id, $activity_id, $region_id)
    {
//        return (new RequisitionRepository())->getCommitmentOnTheSameBudget()->sum('requisitions.amount');
        return (new RequisitionRepository())->getCommitment($project_id, $activity_id, $region_id)->sum('requisitions.amount');
    }

    public function actualExpenditure($project_id, $activity_id, $region_id)
    {
        return (new RequisitionRepository())->getActualExpenditures($project_id, $activity_id, $region_id)->sum('requisitions.amount');
//        return (new RequisitionRepository())->getActualExpenditure()->sum('payments.payed_amount');
    }

    public function exchangeRate($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year)
    {
        $rate = null;
        $rate_id = $this->activity($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year)->rate_id;
        if($rate_id)
            $rate = Rate::query()->find($rate_id)->amount;
        return $rate;
    }

}
