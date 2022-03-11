<?php

namespace App\Http\Controllers\Web\Retirement;

use App\Events\NewWorkflow;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Retirement\Datatables\RetirementDatatables;
use App\Models\FilesAttachment\FilesAttachment;
use App\Models\Retirement\Retirement;
use App\Models\Retirement\RetirementDetail;
use App\Repositories\Retirement\RetirementRepository;
use App\Repositories\SafariAdvance\SafariAdvanceRepository;
use App\Repositories\System\DistrictRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Generator\Number;
use App\Services\Workflow\Workflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\File;

class RetirementController extends Controller
{
    use Number, RetirementDatatables;
    protected $retirements;
    protected $safari_advances;
    protected $safari_advance_details;
    protected $district;
    protected $wf_tracks;
    protected $designations;

    public function __construct()
    {
        $this->retirements = (new RetirementRepository());
        $this->safari_advances = (new SafariAdvanceRepository());
        $this->district=(new DistrictRepository());
        $this->wf_tracks = (new WfTrackRepository());
    }

    /*public function index(RetirementRepository $retirementRepository)
    {
        return view('retirement.index')
            ->with('retirements', $retirementRepository);
    }*/

    public function index()
    {
        return view('retirement.index')
            ->with('retirements', $this->retirements);
    }

    public  function  initiate(SafariAdvanceRepository $safariAdvanceRepository)
    {
        return view('retirement.forms.initiate')
            ->with('safaries', $safariAdvanceRepository->getCompletedWithoutRetirement()->get()
                ->pluck('number','id'));
    }

    public  function  create(Retirement $retirement)
    {
        return view('retirement.forms.create')
            ->with('retirement', $retirement)
            ->with('district', $this->district->getForPluck())
            ->with('retire_safaris', $this->safari_advances->getSafariDetails()->get()->where('safari_id', $retirement->safari_advance_id));
    }

   /* public  function  edit(Retirement $retirement)
    {
        return view('retirement.forms.create')
            ->with('retirement', $retirement)
            ->with('district', $this->district->getForPluck())
            ->with('retire_safaris', $this->safari_advances->getSafariDetails()->get()->where('safari_id', $retirement->safari_advance_id));
    }*/

    public  function  edit(Retirement $retirement)
    {
        return view('retirement.forms.edit')
            ->with('retirement', $retirement)
            ->with('district', $this->district->getForPluck())
            ->with('retire_safaris', $this->safari_advances->getSafariDetails()->get()->where('safari_id', $retirement->safari_advance_id))
            ->with('retirementz',$retirement->details()->get());
    }

    public function store(Request $request)
    {
        $retirement = $this->retirements->store($request->all());
        return redirect()->route('retirement.create', $retirement);
    }

    public function update(Request $request, $uuid)
    {

        //dd($this->retirements->all());

        $retirement_attribute =$this->retirements->findByUuid($uuid);


        //dd($request->all());

        if ($retirement_attribute->done == true)
        {
            $this->retirements->update($request->all(),$uuid);

            $retirement_detailz = RetirementDetail::where('retirement_id', $retirement_attribute->id)->first();

            if ($request->hasFile('attachments')){
                foreach($request->file('attachments') as $attachment){
                    $retirement_detailz->addMedia($attachment)->toMediaCollection('attachments');
                }
            }

            alert()->success('Retirement Submitted Successfully','Success');
            return redirect()->route('retirement.show',$uuid);
        }
        else{
            $this->retirements->update($request->all(),$uuid);

            $retirement_detailz = RetirementDetail::where('retirement_id', $retirement_attribute->id)->first();

            if ($request->hasFile('attachments')){
                foreach($request->file('attachments') as $attachment){
                    $retirement_detailz->addMedia($attachment)->toMediaCollection('attachments');
                }
            }

            $retirement = $this->retirements->findByUuid($uuid);

            $wf_module_group_id = 4;

            $next_user = $retirement->user->assignedSupervisor()->supervisor_id;
            event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $retirement->id,'region_id' => $retirement->region_id, 'type' => 1],[],['next_user_id' => $next_user]));
            alert()->success('Retirement Submitted Successfully','Success');
            return redirect()->route('retirement.show',$uuid);

        }


    }

    public function refurbish(Request $request, $uuid){

        $this->retirements->refurbishing($request->all(),$uuid);
        alert()->success('Retirement Modified Successfully','Success');
        return redirect()->route('retirement.show',$uuid);
    }

    public function show(Retirement $retirement)
    {
       //dd($retirement->details()->get());
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

        $retirementatt =$this->retirements = (new RetirementRepository());

        //dd($retirementatt->getattachment()->get());

        return view('retirement.show')
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($retirement))
            ->with('retirement', $retirement)
            ->with('retirementz',$retirement->details()->get());
            //->with('attachmentname', $retirementatt->getattachment()->get('attachment_name'));
    }


}
