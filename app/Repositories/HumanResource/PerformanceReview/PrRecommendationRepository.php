<?php 

namespace App\Repositories\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\PrRecommendation;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PrRecommendationRepository extends BaseRepository
{
    const MODEL = PrRecommendation::class;

    public function store(PrReport $pr_report, $input)
    {
        return DB::transaction(function() use($input, $pr_report){
            return $pr_report->recommendation()->create($input);
        });
    }

    public function update(PrRecommendation $pr_recommandation, $input)
    {
        return DB::transaction(function() use($input, $pr_recommandation){
            return $pr_recommandation->update($input);
        });
    }
}