<?php

namespace App\Repositories\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\PrAttribute;
use App\Models\HumanResource\PerformanceReview\PrAttributeRate;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PrAttributeRateRepository extends BaseRepository
{
    const MODEL = PrAttributeRate::class;


    /** 
     * Store or Update
     * @param PrReport $pr_report
     * @param PrAttribute $pr_attribute
     * @param $input
    */
    public function storeOrUpdate(PrReport $pr_report, PrAttribute $pr_attribute, $input)
    {
        return DB::transaction(function() use($pr_report, $pr_attribute, $input){
            $rate_attribute = $pr_report->attributeRates()->where('id', $pr_attribute->id);
            if($rate_attribute->count()){
                return $pr_report->attributeRates()->first()->update([
                    'pr_rate_scale_id' => $input['rate_scale'],
                ]);
            }else{
                return $pr_report->attributeRates()->create([
                    'pr_attribute_id' => $pr_attribute->id,
                    'pr_rate_scale_id' => $input['rate_scale'],
                ]);
            }
        });
    }
}