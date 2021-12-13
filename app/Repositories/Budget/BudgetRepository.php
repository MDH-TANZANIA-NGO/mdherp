<?php

namespace App\Repositories\Budget;

use App\Models\Budget\Budget;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

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
            ->join('regions','regions.id','budgets.region_id')
            ->join('fiscal_years','fiscal_years.id','budgets.fiscal_year_id')
            ->groupBy('activities.title','fiscal_years.title','activities.uuid','fiscal_years.uuid');
    }

    public function processStore($inputs)
    {
        foreach ($inputs['regions'] as $region){
            $input = [
                'fiscal_year_id' => $inputs['fiscal_year'],
                'region_id' => $region,
                'activity_id' => $inputs['activity'],
                'numeric_output' => $inputs['output'.$region],
                'amount' => $inputs['amount'.$region],
                'actual_amount' => $inputs['amount'.$region],
            ];
            $this->store($input);
        }
    }

    public function store($input)
    {
        return DB::transaction(function() use ($input){
            $this->query()->create($input);
        });
    }
}
