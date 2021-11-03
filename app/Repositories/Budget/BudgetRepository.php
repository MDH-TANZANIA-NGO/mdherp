<?php

namespace App\Repositories\Budget;

use App\Models\Budget\Budget;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class BudgetRepository extends BaseRepository
{
    const MODEL = Budget::class;

    /**
     *return mixed
     */
   public function all(){
       return Budget::with(['activity', 'fiscalYear'])
           ->get();
   }

    /**
     * Inputs Processor
     * @param $inputs
     * @return array
     */
    public function inputsProcessor($inputs)
    {
        return [
            'fiscal_year_id' => $inputs['fiscal_year_id'],
            'activity_id' => $inputs['activity_id'],
            'code' => $inputs['code'],
            'amount' => $inputs['amount'],
        ];
    }

    /**
     * Store new Project
     * @param $inputs
     * @return mixed
     */
    public function store($inputs){
        return DB::transaction(function () use($inputs){
            return $this->query()->create($this->inputsProcessor($inputs));
        });
    }
    public function update($inputs, Budget $budget)
    {
        return DB::transaction(function () use($inputs, $budget){
            $budget->update($this->inputsProcessor($inputs));
            return $budget;
        });
    }
}
