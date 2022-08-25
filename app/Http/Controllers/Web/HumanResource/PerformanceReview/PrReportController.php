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
use App\Http\Requests\HumanResource\PerformanceReview\PrReportRequest;
use App\Repositories\HumanResource\PerformanceReview\PrAttributeRepository;
use App\Repositories\HumanResource\PerformanceReview\PrCompetenceKeyRepository;
use App\Repositories\HumanResource\PerformanceReview\PrRateScaleRepository;
use App\Repositories\HumanResource\PerformanceReview\PrTypeRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PrReportController extends Controller
{
    use PrReportDatatables, WorkflowInitiator;
    protected $pr_reports;
    protected $pr_types;
    protected $wf_tracks;
    protected $pr_rate_scales;
    protected $pr_attributes;
    protected $pr_competence_keys;

    public function __construct()
    {
        $this->pr_reports = (new PrReportRepository());
        $this->pr_types = (new PrTypeRepository());
        $this->wf_tracks = (new WfTrackRepository());
        $this->pr_rate_scales = (new PrRateScaleRepository());
        $this->pr_attributes = (new PrAttributeRepository());
        $this->pr_competence_keys = (new PrCompetenceKeyRepository);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
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
        return view('HumanResource.PerformanceReview.create')
        ->with('pr_types', $this->pr_types->forSelect());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrReportRequest $request)
    {
        $pr_report = $this->pr_reports->store($request->all());
        alert()->success($pr_report->type->title.' initiated Successfully');
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
        ->with('pr_rate_scales', $this->pr_rate_scales->pluckWithDescription())
        ->with('pr_competence_keys', $this->pr_competence_keys->getAll())
        ->with('pr_attributes', $this->pr_attributes->getAll())
        ->with('can_submit_challenges', $pr_report->parent ? $pr_report->parent->objectives()->whereNull('challenge')->count() : 0);
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
            $can_update_attribute_rate_resource =  $this->wf_tracks->canUpdateAttributeRateResource($pr_report, $current_level, $workflow->wf_module_id);
        return view('HumanResource.PerformanceReview.show')
            ->with('pr_report', $pr_report)
            ->with('pr_objectives', $pr_report->objectives)
            ->with('pr_rate_scales', $this->pr_rate_scales->forSelect())
            ->with('pr_attributes', $this->pr_attributes->getAll())
            ->with('pr_competence_keys', $this->pr_competence_keys->getAll())
            ->with('pr_report_attribute_rates', $pr_report->attributeRates)
            ->with('can_be_processed_for_evaluation', $this->pr_reports->canBeAprocessedForEvaluation($pr_report))
            ->with('can_update_attribute_rate_resource', $can_update_attribute_rate_resource)
            ->with('code_value_initiator_remark', code_value()->query()->where('code_id',13)->get())
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('workflows', $workflow)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($pr_report));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCompleted(PrReport $pr_report)
    {
        return view('HumanResource.PerformanceReview.show_completed')
            ->with('pr_report', $pr_report)
            ->with('pr_objectives', $pr_report->objectives)
            ->with('pr_rate_scales', $this->pr_rate_scales->forSelect())
            ->with('pr_attributes', $this->pr_attributes->getAll())
            ->with('pr_competence_keys', $this->pr_competence_keys->getAll())
            ->with('pr_report_attribute_rates', $pr_report->attributeRates)
            ->with('can_be_processed_for_evaluation', $this->pr_reports->canBeAprocessedForEvaluation($pr_report))
            ->with('code_value_initiator_remark', code_value()->query()->where('code_id',13)->get())
            ->with('can_edit_resource', false);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PrReport $pr_report
     * @return \Illuminate\Http\Response
     */
    public function submit(PrReport $pr_report)
    {
        DB::transaction(function() use($pr_report){
            $this->pr_reports->updateDoneAssignNextUserIdAndGenerateNumber($pr_report);
            if($pr_report->types != 1){
            $this->startWorkflow($pr_report, $pr_report->types, $pr_report->supervisor_id);
            }else{
            $pr_report->update(['wf_done' => 1, 'wf_done_date' => Carbon::now()]);
            }
        });
        alert()->success(__('Submitted Successfully'), __('Performance Review'));
        if($pr_report->types == 1){
            return redirect()->route('hr.pr.show_completed', $pr_report);
        }
        return redirect()->route('hr.pr.show', $pr_report);
    }

    public function completed(PrReport $pr_report)
    {
        $this->pr_reports->completed($pr_report);
        alert()->success(__('Email has been sent Successfully to supervisor to continue with approval'), __('Performance Appraisal Report'));
        return redirect()->back();
    }
}
