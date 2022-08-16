<?php

namespace App\Repositories\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\PrNextObjective;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PrNextObjectiveRepository extends BaseRepository
{
    const MODEL = PrNextObjective::class;

    public function store(PrReport $pr_report, $input)
    {
        return DB::transaction(function() use($pr_report, $input){
            return $pr_report->nextObjectives()->create($input);
        });
    }

    public function update(PrNextObjective $pr_next_objective, $input)
    {
        return DB::transaction(function() use($pr_next_objective, $input){
            return $pr_next_objective->update($input);
        });
    }

    public function destroy(PrNextObjective $pr_next_objective)
    {
        return DB::transaction(function() use($pr_next_objective){
            return $pr_next_objective->delete();
        });
    }
}