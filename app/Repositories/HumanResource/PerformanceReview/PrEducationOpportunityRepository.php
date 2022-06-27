<?php

namespace App\Repositories\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\PrEducationOpportunity;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PrEducationOpportunityRepository extends BaseRepository
{
    const MODEL = PrEducationOpportunity::class;

    public function store(PrReport $pr_report, $input)
    {
        return DB::transaction(function() use($pr_report, $input){
            return $pr_report->education()->create($input);
        });
    }
}