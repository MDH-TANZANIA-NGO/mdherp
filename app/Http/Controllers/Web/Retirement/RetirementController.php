<?php

namespace App\Http\Controllers\Api\Facility\Web\Retirement;

use App\Events\NewWorkflow;
use App\Http\Controllers\Api\Facility\Controller;
use App\Http\Controllers\Api\Facility\Web\Retirement\Datatables\RetirementDatatables;
use App\Models\Retirement\Retirement;
use App\Models\Retirement\RetirementDetail;
use App\Models\Retirement\RetirementType;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
use App\Repositories\Retirement\RetirementRepository;
use App\Repositories\Retirement\RetirementTypeRepository;
use App\Repositories\SafariAdvance\SafariAdvanceRepository;
use App\Repositories\System\DistrictRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Generator\Number;
use App\Services\Workflow\Workflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RetirementController extends Controller
{
    use Number, RetirementDatatables;
    protected $retirements;
    protected $safari_advances;
    protected $safari_advance_details;
    protected $district;
    protected $wf_tracks;
    protected $designations;
//    protected $rettype;
//    protected $programActivities;
    /**
     * @var ProgramActivityRepository
     */


    /**
     * @var RetirementTypeRepository
     */


    public function __construct()
    {
        $this->retirements = (new RetirementRepository());
        $this->safari_advances = (new SafariAdvanceRepository());
        $this->district=(new DistrictRepository());
//        $this->rettype=(new RetirementTypeRepository());
        $this->wf_tracks = (new WfTrackRepository());
//        $this->programActivities = (new ProgramActivityRepository());
    }

    public function index(RetirementRepository $retirementRepository)
    {
        return view('retirement.index')
            ->with('retirements', $retirementRepository);
    }

    public  function  initiate(SafariAdvanceRepository $safariAdvanceRepository)
    {

        return view('retirement.forms.initiate')
//            ->with('retirementtype', $this->rettype->getTypes()->get()->pluck('type', 'id'))
            ->with('safaries', $safariAdvanceRepository->getCompletedWithoutRetirement()->get()
//                ->with('programs', $this->programActivities->getCompletedWithoutRetirement()->get())
                ->pluck('number','id'));
    }

    public  function  create(Retirement $retirement)
    {

        return view('retirement.forms.create')
            ->with('retirement', $retirement)
            ->with('district', $this->district->getForPluck())
            ->with('retire_safaris', $this->safari_advances->getSafariDetails()->get()->where('safari_id', $retirement->safari_advance_id));
    }

    public function store(Request $request)
    {
        $retirement = $this->retirements->store($request->all());
        return redirect()->route('retirement.create', $retirement);
    }

    public function update(Request $request, $uuid)
    {
//        ddd($this->retirements->all());

        $this->retirements->update($request->all(),$uuid);
        //check if there is a file and add attachement


        $retirement = $this->retirements->findByUuid($uuid);
        $retirementDetails = RetirementDetail::where('retirement_id', $retirement->id)->first();

        if($request->hasFile('attachment')){
            $retirementDetails->update(['attachment_receipt' => $request->file('attachment_receipt')->store('Retirements/attachment/receipt')]);
        }
//        if($request->hasFile('attachment_receipt')){
//            $retirementDetails->update(['attachment_receipt' => $request->file('attachment_receipt')->store('Retirements/attachment/receipt')]);
//        }
//        if($request->hasFile('attachment_supportive')){
//            $retirementDetails->update(['attachment_supportive' => $request->file('attachment_supportive')->store('Retirements/attachment/supportive')]);
//        }
//        if($request->hasFile('attachment_other')){
//            $retirementDetails->update(['attachment_other' => $request->file('attachment_other')->store('Retirements/attachment/other')]);
//        }

        $wf_module_group_id = 4;

        $next_user = $retirement->user->assignedSupervisor()->supervisor_id;
        event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $retirement->id,'region_id' => $retirement->region_id, 'type' => 1],[],['next_user_id' => $next_user]));

        return redirect()->route('retirement.show',$uuid);
    }

    public function show(Retirement $retirement)
    {
        /* Check workflow */
        $wf_module_group_id = 4;
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $retirement->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $retirement->id, 'type' => $wf_module->type]);
        $check_workflow = $workflow->checkIfHasWorkflow();
        $current_wf_track = $workflow->currentWfTrack();
        $wf_module_id = $workflow->wf_module_id;
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($retirement, $current_level, $workflow->wf_definition_id);

        $designation = access()->user()->designation_id;
//ddd($retirement->details());
        return view('retirement.show')
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($retirement))
            ->with('retirement', $retirement)
            ->with('retirementz',$retirement->details()->get());
    }

    public function goback()
    {
        return redirect()->back();
    }


}
