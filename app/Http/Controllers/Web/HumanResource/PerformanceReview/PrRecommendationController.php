<?php

namespace App\Http\Controllers\Web\HumanResource\PerformanceReview;

use App\Http\Controllers\Controller;
use App\Models\HumanResource\PerformanceReview\PrRecommendation;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Repositories\HumanResource\PerformanceReview\PrRecommendationRepository;
use Illuminate\Http\Request;

class PrRecommendationController extends Controller
{
    protected $pr_recommendations;

    public function __construct()
    {
        $this->pr_recommendations = (new PrRecommendationRepository());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PrReport $pr_report)
    {
        $request['user_id'] = access()->id();
        $this->pr_achievement_comments->store($pr_report, $request->all());
        alert()->success('Recommendation stored successfully');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PrRecommendation $pr_recommendation)
    {
        $this->pr_achievement_comments->update($pr_recommendation, $request->all());
        alert()->success('Recommendation updated successfully');
        return redirect()->back();
    }
}
