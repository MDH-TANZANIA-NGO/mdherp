<?php

namespace App\Services\Calculator\Requisition;

use App\Models\Requisition\RequisitionType\RequisitionType;
use App\Repositories\Project\ActivityRepository;

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
            'actual' => null,
            'commitment' => null,
            'pipeline' => null,
            'available budget' => null,
        ];
    }

    public function activity($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year)
    {
        return (new ActivityRepository())->getSubQuery($activity_id, $project_id, $region_id)->first();
    }

    public function requisition($requisition_type_id)
    {
        return RequisitionType::query()->findOrFail($requisition_type_id);
    }

}
