<?php

namespace App\Repositories\Requisition;

use App\Models\Requisition\Requisition;
use App\Repositories\BaseRepository;
use App\Services\Calculator\Requisition\InitiatorBudgetChecker;
use Illuminate\Support\Facades\DB;

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

    public function inputProcess($inputs)
    {
        return [
            'user_id' => access()->id(),
            'requisition_type_id' => $inputs['requisition_type'],
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

}
