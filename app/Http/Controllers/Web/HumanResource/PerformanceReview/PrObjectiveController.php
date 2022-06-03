<?php

namespace App\Http\Controllers\Web\HumanResource\PerformanceReview;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\HumanResource\PerformanceReview\Traits\Datatables\PrObjectiveDatatables;
use App\Http\Requests\HumanResource\PerformanceReview\PrObjectiveRequest;
use App\Models\HumanResource\PerformanceReview\PrObjective;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Repositories\HumanResource\PerformanceReview\PrObjectiveRepository;
use Illuminate\Http\Request;

class PrObjectiveController extends Controller
{
    use PrObjectiveDatatables;
    protected $pr_objectives;

    public function __construct()
    {
        $this->pr_objectives = (new PrObjectiveRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrObjectiveRequest $request, PrReport $pr_report)
    {
        $this->pr_objectives->store($pr_report, $request->all());
        alert()->success('Objective/Goals Addedd Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrObjective $pr_objective)
    {
        alert()->success('Objective/Goals Removed Successfully');
        $this->pr_objectives->destroy($pr_objective);
        return redirect()->back();
    }
}
