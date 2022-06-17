<?php

namespace App\Http\Controllers\Web\HumanResource\PerformanceReview;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\HumanResource\PerformanceReview\Traits\Datatables\PrCompetenceDatatables;
use App\Models\HumanResource\PerformanceReview\PrCompetenceKeyNarration;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Repositories\HumanResource\PerformanceReview\PrCompetenceRepository;
use Illuminate\Http\Request;

class PrCompetenceController extends Controller
{
    use PrCompetenceDatatables;
    protected $pr_competences;

    public function __construct()
    {
        $this->pr_competences = (new PrCompetenceRepository());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(Request $request, PrCompetenceKeyNarration $pr_competence_key_narration, PrReport $pr_report)
    {
        $competence_rate = $this->pr_competences->storeOrUpdate($pr_report, $pr_competence_key_narration, $request->all());
        return response()->json($competence_rate);
    }
}
