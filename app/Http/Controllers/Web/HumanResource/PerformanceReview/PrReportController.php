<?php

namespace App\Http\Controllers\Web\HumanResource\PerformanceReview;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\HumanResource\PerformanceReview\Traits\Datatables\PrReportDatatables;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Repositories\HumanResource\PerformanceReview\PrReportRepository;
use Illuminate\Http\Request;

class PrReportController extends Controller
{
    use PrReportDatatables;
    protected $pr_reports;

    public function __construct()
    {
        $this->pr_reports = (new PrReportRepository());
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('HumanResource.PerformanceReview.index')
        ->with('processing_count', $this->pr_reports->getAccessProcessing()->count())
        ->with('return_for_modification_count', $this->pr_reports->getAccessReturnedForModification()->count())
        ->with('approved_count', $this->pr_reports->getAccessApproved()->count())
        ->with('saved_count', $this->pr_reports->getAccessSaved()->count());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('HumanResource.PerformanceReview.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function probationStore()
    {
        $pr_report = $this->pr_reports->probationStore();
        alert()->success('Probation Appraisal initiated Successfully');
        return redirect()->route('hr.pr.saved', $pr_report);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saved(PrReport $pr_report)
    {
        return view('HumanResource.PerformanceReview.saved')
        ->with('pr_report', $pr_report)
        ->with('pr_objectives', $pr_report->objectives);
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
    public function destroy($id)
    {
        //
    }
}
