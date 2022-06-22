<?php

namespace App\Http\Controllers\Web\HumanResource\PerformanceReview;

use App\Http\Controllers\Controller;
use App\Models\HumanResource\PerformanceReview\PrNextObjective;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Repositories\HumanResource\PerformanceReview\PrNextObjectiveRepository;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class PrNextObjectiveController extends Controller
{
    protected $pr_next_objectives;

    public function __construct()
    {
        $this->pr_next_objectives = (new PrNextObjectiveRepository());
    }

    public function store(Request $request, PrReport $pr_report)
    {
        $this->pr_next_objectives->store($pr_report, $request->all());
        alert()->success('Objective Stored successfully');
        return redirect()->back();
    }

    public function update(Request $request, PrNextObjective $pr_next_objective)
    {
        $this->pr_next_objectives->update($pr_next_objective, $request->all());
        alert()->success('Objective Updated successfully');
        return redirect()->back();
    }
}
