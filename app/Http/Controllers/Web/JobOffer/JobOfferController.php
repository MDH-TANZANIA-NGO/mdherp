<?php

namespace App\Http\Controllers\Web\JobOffer;
use App\Models\Auth\User;
use App\Events\NewWorkflow;
use Illuminate\Http\Request;
use App\Services\Workflow\Workflow;
use App\Http\Controllers\Controller;
use App\Models\JobOffer\JobOfferRemark;
use App\Repositories\JobOfferRepository;
use App\Repositories\Access\UserRepository;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Notifications\Workflow\WorkflowNotification;
use App\Models\HumanResource\Interview\InterviewApplicant;
use App\Models\HumanResource\HireRequisition\HrHireApplicant;
use App\Http\Controllers\Web\JobOffer\Datatables\JobOfferDatatable;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;
use App\Models\HumanResource\Interview\InterviewReportRecommendation;
use App\Repositories\HumanResource\Interview\InterviewApplicantRepository;
use App\Repositories\HumanResource\Interview\InterviewReportRecommendationRepository;

class JobOfferController extends Controller
{
   use JobOfferDatatable;

   protected $job_offers;
   protected $interview_applicants;
   protected  $wf_tracks;
   protected  $users;
   protected $projects;
   public function __construct()
   {
       $this->job_offers =  (new JobOfferRepository());
    //    $this->interview_applicants = (new InterviewApplicantRepository());
       $this->interview_applicants = (new InterviewReportRecommendationRepository());
       $this->wf_tracks = (new WfTrackRepository());
       $this->users = (new UserRepository());
       $this->projects = (new ProjectRepository());
   }
    public function index()
    {
        //
        return view('humanResource.jobOffer.index')
            ->with('job_offers', $this->job_offers);
    }


    public function initiate()
    {
        return view('humanResource.jobOffer.forms.initiate')
            ->with('applicant', $this->interview_applicants->getApplicantForJobOffer()->get()->pluck('full_name', 'id'));
    }

    public function create(Request  $request)
    {
        $job_details =  $this->interview_applicants->getAdvertDetails($request->get('id'))->first();
        return view('humanResource.jobOffer.forms.create')
            ->with('job_details', $job_details)
            ->with('projects', $this->projects->getActiveForPluck());
    }


    public function store(Request $request)
    {
        // return  $request;
        $job_offer =   $this->job_offers->store($request->all());
        // return  $job_offer->interviewApplicant->hr_requisition_job_id;
        $department = HireRequisitionJob::find($job_offer->interviewApplicant->hr_requisition_job_id)->department_id;
    //    return $department;
        // $department = $job_offer->interviewApplicant->interviews->jobRequisition->department_id;
       
        $next_user = $this->users->getDirectorOfDepartment($department)->get();
        $next_user =  $next_user->first()->user_id;
        $wf_module_group_id = 14;
        event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $job_offer->id,'region_id' => $job_offer->user->region_id, 'type' => 1],[],['next_user_id' => $next_user]));
        alert()->success('Job Offer Sent for Approval', 'Success');
        return redirect()->route('job_offer.show', $job_offer->uuid);
    }


    public function show($uuid)
    {
        $job_offer =  $this->job_offers->findByUuid($uuid);

        $job_offer_remarks =  JobOfferRemark::query()->where('job_offer_id', $job_offer->id)->get();

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
            ->with('job_offer', $job_offer)
            ->with('job_offer_remarks', $job_offer_remarks);

    }


    public function edit($uuid)
    {
        //
        $job_offer =  $this->job_offers->findByUuid($uuid);

        $job_offer_projects =  $this->projects->getJobOfferProjects($job_offer->id)->get();

        return view('humanResource.jobOffer.forms.edit')
            ->with('job_offer', $job_offer)
            ->with('projects',$this->projects->getActiveForPluck())
            ->with('job_offer_projects', $job_offer_projects);
    }


    public function update(Request $request, $uuid)
    {

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

    public function offerAcceptance($uuid)
    {

        return view('HumanResource.JobOffer.acceptingoffer')
            ->with('job_offer', $this->job_offers->findByUuid($uuid));
    }

    public function  acceptingOffer($uuid)
    {
        $job_offer = $this->job_offers->findByUuid($uuid);
        $job_offer->update(['status'=>'1']);
        $applicant_details =  $job_offer->interviewApplicant->applicant;
       $user_id =  User::query()->create([
            'first_name' => $applicant_details->first_name,
            'middle_name' => $applicant_details->middle_name,
            'last_name' => $applicant_details->last_name,
            'phone' => $applicant_details->phone,
            'email' => $applicant_details->email,
            'designation_id' => $job_offer->interviewApplicant->interviews->jobRequisition->designation_id,
            'password' => config('app.key'),
           'user_account_cv_id'=> 4,
        ])->id;

       HrHireApplicant::query()->where('id', $applicant_details->id)->update(['user_id'=>$user_id]);

        alert()->success('Job offer accepted successfully', 'Congratulation');
        return redirect()->back();
    }

    public function rejectOffer(Request $request, $uuid)
    {
        $job_offer = $this->job_offers->findByUuid($uuid);
        $job_offer->update(['status'=>'2']);

        if (access()->user())
        {
            JobOfferRemark::query()->create([
                'job_offer_id'=>$job_offer->id,
                'user_id'=>$job_offer->user_id,
                'comments'=>$request['comments']

            ]);
        }
        elseif(access()->guest()){
            JobOfferRemark::query()->create([
                'job_offer_id'=>$job_offer->id,
                'applicant_id'=>$job_offer->interviewApplicant->applicant->id,
                'comments'=>$request['comments']

            ]);

        }


        alert()->success('Job Offer rejected successfully');

        return redirect()->back();
    }

    public function replyRemarks(Request $request, $uuid)
    {
        $job_offer = $this->job_offers->findByUuid($uuid);
        $job_offer->update(['status'=>null]);
        JobOfferRemark::query()->create([
            'job_offer_id'=>$job_offer->id,
            'user_id'=>$job_offer->user_id,
            'comments'=>$request['comments']

        ]);
        $email_resource_to_applicant = (object)[
            'link' =>  route('job_offer.accepting_offer',$job_offer),
            'subject' => "Job Offer: Management and Development for Health",
            'message' =>  " <p>I am pleased to extend the following offer of employment to you on behalf of <b>Management and Development for Health </b>. You have been selected as the best candidate for the ".$job_offer->interviewApplicant->interviews->jobRequisition->designation->full_title." position.</p> ". ",  Kindly login to portal for your action"

        ];
        $job_offer->interviewApplicant->applicant->notify(new  WorkflowNotification($email_resource_to_applicant));
        alert()->success('Reply sent successfully');

        return redirect()->back();

    }
}
