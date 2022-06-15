<?php

namespace App\Repositories\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\PrObjective;
use App\Models\HumanResource\PerformanceReview\PrReport;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PrObjectiveRepository extends BaseRepository
{
    const MODEL = PrObjective::class;

    public function store(PrReport $pr_report, $inputs)
    {
        return DB::transaction(function() use($pr_report, $inputs){
            return $pr_report->objectives()->create($inputs);
        });
    }

    /** 
     * Update goal
    **/
    public function update(PrObjective $pr_objective, $inputs)
    {
        return DB::transaction(function() use($pr_objective, $inputs){
            return $pr_objective->update($inputs);
        });
    }

    /** 
     * Update goal
    **/
    public function updateChallenge(PrObjective $pr_objective, $inputs)
    {
        return DB::transaction(function() use($pr_objective, $inputs){
            return $pr_objective->update($inputs);
        });
    }

    /** 
     * Destroy goal
    **/
    public function destroy(PrObjective $pr_objective)
    {
        return DB::transaction(function() use($pr_objective){
            return $pr_objective->forceDelete();
        });
    }

}
