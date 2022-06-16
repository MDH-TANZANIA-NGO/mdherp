<?php

namespace App\Http\Controllers\Web\HumanResource\PerformanceReview;

use App\Http\Controllers\Controller;
use App\Models\HumanResource\PerformanceReview\PrAttribute;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Repositories\HumanResource\PerformanceReview\PrAttributeRateRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PrAttributeRateController extends Controller
{
    protected $pr_attribute_rates;

    public function __construct()
    {
        $this->pr_attribute_rates = (new PrAttributeRateRepository());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(Request $request, PrAttribute $pr_attribute, PrReport $pr_report)
    {
        $attribute_rate = $this->pr_attribute_rates->storeOrUpdate($pr_report, $pr_attribute, $request->all());
        return response()->json($attribute_rate);
    }

}
