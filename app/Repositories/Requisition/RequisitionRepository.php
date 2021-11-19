<?php

namespace App\Repositories\Requisition;

use App\Models\Requisition\Requisition;
use App\Repositories\BaseRepository;
use App\Services\Calculator\Requisition\InitiatorBudgetChecker;

class RequisitionRepository extends BaseRepository
{
    use InitiatorBudgetChecker;

    const MODEL = Requisition::class;

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

}
