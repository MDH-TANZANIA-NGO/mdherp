<?php

namespace App\Repositories\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\PrCompetenceKeyNarration;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Models\HumanResource\PrCompetence;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PrCompetenceRepository extends BaseRepository
{
    const MODEL = PrCompetence::class;

    /** 
     * Store or Update
     * @param PrReport $pr_report
     * @param PrCompetenceKeyNarration $pr_competence_key_narration
     * @param $input
    */
    public function storeOrUpdate(PrReport $pr_report, PrCompetenceKeyNarration $pr_competence_key_narration, $input)
    {
        return DB::transaction(function() use($pr_report, $pr_competence_key_narration, $input){
            $rate_competence_narration = $pr_report->competences()->where('pr_competence_key_narration_id', $pr_competence_key_narration->id)->get();
            if($rate_competence_narration->count()){
                return $pr_report->competences()->first()->update([
                    'pr_rate_scale_id' => $input['rate_scale'],
                ]);
            }else{
                return $pr_report->competences()->create([
                    'pr_competence_key_narration_id' => $pr_competence_key_narration->id,
                    'pr_rate_scale_id' => $input['rate_scale'],
                ]);
            }
        });
    }
}
