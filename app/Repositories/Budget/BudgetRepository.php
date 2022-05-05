<?php

namespace App\Repositories\Budget;

use App\Models\Budget\Budget;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;

class BudgetRepository extends BaseRepository
{
    const MODEL = Budget::class;

    public function getAllActive()
    {
        return $this->query()->select([
            DB::raw('activities.title AS activity_title'),
            DB::raw('activities.uuid AS activity_uuid'),
            DB::raw('fiscal_years.uuid AS fiscal_year_uuid'),
            DB::raw('SUM(budgets.amount) AS total_amount'),
            DB::raw('fiscal_years.title AS fiscal_year'),
            DB::raw('SUM(budgets.numeric_output) AS numeric_output_sum'),
            DB::raw("string_agg(DISTINCT regions.name, ',') as region_list"),
        ])
            ->join('activities','activities.id','budgets.activity_id')
            ->leftjoin('regions','regions.id','budgets.region_id')
            ->join('fiscal_years','fiscal_years.id','budgets.fiscal_year_id')
            ->groupBy('activities.title','fiscal_years.title','activities.uuid','fiscal_years.uuid');
    }

    /**
     * @param $inputs
     * @return bool
     */
    public function processStore($inputs)
    {
        if(isset($inputs['regions'])){
            $this->storeRegionSpecific($inputs);
        }else{
            $this->storeNoneRegionSpecific($inputs);
        }
        return true;
    }

    /**
     * @param $inputs
     */
    public function storeRegionSpecific($inputs)
    {
        foreach ($inputs['regions'] as $region){
            $input = [
                'fiscal_year_id' => $inputs['fiscal_year'],
                'region_id' => $region,
                'activity_id' => $inputs['activity'],
                'numeric_output' => $inputs['output'.$region],
                'amount' => $inputs['amount'.$region],
                'actual_amount' => $inputs['amount'.$region],
                'rate_id' => active_rate_id(),
            ];
            $this->store($input);
        }
    }

    /**
     * @param $inputs
     */
    public function storeNoneRegionSpecific($inputs)
    {
            $input = [
                'fiscal_year_id' => $inputs['fiscal_year'],
                'activity_id' => $inputs['activity'],
                'numeric_output' => $inputs['output'],
                'amount' => $inputs['amount'],
                'actual_amount' => $inputs['amount'],
                'rate_id' => active_rate_id(),
            ];
            $this->store($input);
    }

    public function store($input)
    {
        $this->checkIfBudgetHasBeenRegistered($input);
        return DB::transaction(function() use ($input){
            $this->query()->create($input);
        });
    }

    public function checkIfBudgetHasBeenRegistered($input)
    {
        $check = $this->query()->where('fiscal_year_id', $input['fiscal_year_id'])->where('activity_id', $input['activity_id']);
        if($check->count() > 0){
            $budget = $check->first();
            throw new GeneralException('Activity '.$budget->activity->code. ' - '.$budget->activity->title. ' - '.$budget->activity->description. ' of year '.$budget->fiscalYear->title. 'Already Registered');
        }
    }

}
