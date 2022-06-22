<?php

namespace App\Repositories\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\PrRemark;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PrRemarkRepository extends BaseRepository
{
    const MODEL = PrRemark::class;

    public function store(PrReport $pr_report, $input)
    {
        return DB::transaction(function() use($pr_report, $input){
            return $pr_report->remarks()->create($input);
        });
    }
}