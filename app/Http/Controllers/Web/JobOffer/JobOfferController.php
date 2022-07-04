<?php

namespace App\Http\Controllers\Web\JobOffer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\JobOffer\Datatables\JobOfferDatatable;
use App\Repositories\HumanResource\Interview\InterviewApplicantRepository;
use App\Repositories\JobOfferRepository;
use Illuminate\Http\Request;

class JobOfferController extends Controller
{
   use JobOfferDatatable;

   protected $job_offers;
   protected $interview_applicants;
   public function __construct()
   {
       $this->job_offers =  (new JobOfferRepository());
       $this->interview_applicants = (new InterviewApplicantRepository());
   }
    public function index()
    {
        //
        return view('HumanResource.JobOffer.index')
            ->with('job_offers', $this->job_offers);
    }


    public function initiate()
    {
        //
        return view('HumanResource.JobOffer.forms.initiate')
            ->with('applicant', $this->interview_applicants->getApplicantForJobOffer()->pluck('full_name', 'id'));
    }

    public function create(Request  $request)
    {
        $job_details =  $this->interview_applicants->getAdvertDetails($request->get('applicant_id'))->first();

        return view('HumanResource.JobOffer.forms.create')
            ->with('job_details', $job_details);

    }


    public function store(Request $request)
    {
        //

        $this->job_offers->store($request->all());
        alert()->success('Job Offer Sent for Approval', 'Success');
        return redirect()->back();
    }


    public function show($uuid)
    {
        //
    }


    public function edit($uuid)
    {
        //
        $job_offer =  $this->job_offers->findByUuid($uuid);
        return view('HumanResource.JobOffer.forms.edit')
            ->with('job_offer', $job_offer);
    }


    public function update(Request $request, $uuid)
    {
        //
        $this->job_offers->update($request->all(), $uuid);
    }


    public function destroy($id)
    {
        //
    }
}
