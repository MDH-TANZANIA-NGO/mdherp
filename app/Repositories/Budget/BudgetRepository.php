<?php

namespace App\Repositories\Budget;

use App\Models\Budget\Budget;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class BudgetRepository extends BaseRepository
{
    const MODEL = Budget::class;

    public function processStore($inputs)
    {
        foreach ($inputs['regions'] as $region){
            $input = [
                'fiscal_year_id' => $inputs['fiscal_year'],
                'region_id' => $inputs['region'.$region],
                'activity_id' => $inputs['activity'],
                'numeric_output' => $inputs['numeric_output'.$region],
                'amount' => $inputs['amount'.$region],
            ];
            $this->store($input);
        }
    }

    public function store($input)
    {
        return DB::transaction(function() use ($input){
            $this->query()->store($input);
        });
    }
}
