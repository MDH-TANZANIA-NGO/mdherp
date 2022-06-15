<?php

namespace App\Http\Controllers\Web\HumanResource\PerformanceReview;

use App\Events\NewWorkflow;
use Illuminate\Http\Request;
use App\Services\Workflow\Workflow;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Workflow\Traits\WorkflowInitiator;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Repositories\HumanResource\PerformanceReview\PrReportRepository;
use App\Http\Controllers\Web\HumanResource\PerformanceReview\Traits\Datatables\PrReportDatatables;

class PrReportController extends Controller
{
    use PrReportDatatables, WorkflowInitiator;
    protected $pr_reports;
    protected $wf_tracks;

    public function __construct()
    {
        $this->pr_reports = (new PrReportRepository());
        $this->wf_tracks = (new WfTrackRepository());
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
        ->with('wait_verification_count', $this->pr_reports->getAccessApprovedWaitForEvaluation()->count())
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
    public function evaluationInitiate(PrReport $pr_report)
    {
        $pr_report_evaluation = $this->pr_reports->evaluationInitiate($pr_report);
        alert()->success($pr_report_evaluation->parent->type->title.' evaluation initiated Successfully');
        return redirect()->route('hr.pr.saved', $pr_report_evaluation);
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
        ->with('pr_objectives', $pr_report->objectives)
        ->with('can_submit_challenges', $pr_report->parent->objectives()->whereNull('challenge')->count());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PrReport $pr_report)
    {
        $wf_module_group_id = $this->getWfModuleGroupId($pr_report);
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $pr_report->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $pr_report->id, 'type' => $wf_module->type]);
        $current_wf_track = $workflow->currentWfTrack();
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($pr_report, $current_level, $workflow->wf_definition_id);
        return view('HumanResource.PerformanceReview.show')
            ->with('pr_report', $pr_report)
            ->with('pr_objectives', $pr_report->objectives)
            ->with('can_be_processed_for_evaluation', $this->pr_reports->canBeAprocessedForEvaluation($pr_report))
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($pr_report));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PrReport $pr_report
     * @return \Illuminate\Http\Response
     */
    public function submit(PrReport $pr_report)
    {   
        $this->startWorkflow($pr_report, 1, access()->user()->assignedSupervisor()->supervisor_id);
        $this->pr_reports->updateDoneAssignNextUserIdAndGenerateNumber($pr_report); 
        alert()->success(__('Submitted Successfully'), __('Performance Review'));
        return redirect()->route('hr.pr.show', $pr_report);
    }
}
