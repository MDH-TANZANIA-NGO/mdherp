<?php

namespace App\Http\Controllers\Web\JobOffer;

use App\Events\NewWorkflow;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\JobOffer\Datatables\JobOfferDatatable;
use App\Models\Auth\User;
use App\Repositories\HumanResource\Interview\InterviewApplicantRepository;
use App\Repositories\JobOfferRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Workflow\Workflow;
use Illuminate\Http\Request;

class JobOfferController extends Controller
{
    use JobOfferDatatable;

    protected $job_offers;
    protected $interview_applicants;
    protected  $wf_tracks;
    public function __construct()
    {
        $this->job_offers =  (new JobOfferRepository());
        $this->interview_applicants = (new InterviewApplicantRepository());
        $this->wf_tracks = (new WfTrackRepository());
    }
    public function index()
    {
        //
        return view('humanResource.jobOffer.index')
            ->with('job_offers', $this->job_offers);
    }


    public function initiate()
    {
        //
        return view('humanResource.jobOffer.forms.initiate')
            ->with('applicant', $this->interview_applicants->getApplicantForJobOffer()->pluck('full_name', 'id'));
    }

    public function create(Request  $request)
    {
        $job_details =  $this->interview_applicants->getAdvertDetails($request->get('applicant_id'))->first();

        return view('humanResource.jobOffer.forms.create')
            ->with('job_details', $job_details);

    }


    public function store(Request $request)
    {

        $job_offer =   $this->job_offers->store($request->all());
//        dd($job_offer);
        $wf_module_group_id = 14;
        $next_user = User::query()->where('designation_id', '=', '121')->first()->id;
        event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $job_offer->id,'region_id' => $job_offer->user->region_id, 'type' => 1],[],['next_user_id' => $next_user]));
        alert()->success('Job Offer Sent for Approval', 'Success');
        return redirect()->back();
    }


    public function show($uuid)
    {
        $job_offer =  $this->job_offers->findByUuid($uuid);
        //
        /* Check workflow */
        $wf_module_group_id = 14;
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $job_offer->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $job_offer->id, 'type' => $wf_module->type]);
        $check_workflow = $workflow->checkIfHasWorkflow();
        $current_wf_track = $workflow->currentWfTrack();
        $wf_module_id = $workflow->wf_module_id;
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($job_offer, $current_level, $workflow->wf_definition_id);

        $designation = access()->user()->designation_id;

        return view('humanResource.jobOffer.display.show')
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($job_offer))
            ->with('job_offer', $job_offer);

    }


    public function edit($uuid)
    {
        //
        $job_offer =  $this->job_offers->findByUuid($uuid);
        return view('humanResource.jobOffer.forms.edit')
            ->with('job_offer', $job_offer);
    }


    public function update(Request $request, $uuid)
    {
        //
        $this->job_offers->update($request->all(), $uuid);
        alert()->success('Job Offer updated successfully');
        return redirect()->route('job_offer.index');
    }


    public function destroy($id)
    {
        //
    }

    public function print($uuid)
    {
        $job_offer =  $this->job_offers->findByUuid($uuid);
        $view = view('printables.humanResource.hireRequisition.jobOffer.job_offer')->with('job_offer', $job_offer)/*->with('trips', $taf->trips)->with('components', $this->components->getAll()->get()*/->render();
        $pdf = \PDF::loadHTML($view)->setPaper('a4', 'potrait');
        return $pdf->download($job_offer->number.'   ' .$job_offer->created_at.'.pdf');
    }
}
