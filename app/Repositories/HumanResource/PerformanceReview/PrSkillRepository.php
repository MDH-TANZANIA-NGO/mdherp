<?php

namespace App\Repositories\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Models\HumanResource\PerformanceReview\PrSkill;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PrSkillRepository extends BaseRepository
{
    const MODEL = PrSkill::class;

    public function store(PrReport $pr_report, $input)
    {
        return DB::transaction(function() use($pr_report, $input){
            return $pr_report->skill->create($input);
        });
    }
}