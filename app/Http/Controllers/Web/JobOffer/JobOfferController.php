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


    public function create()
    {
        //
        return view('HumanResource.JobOffer.forms.create')
            ->with('applicant', $this->interview_applicants->getApplicantForJobOffer()->pluck('full_name', 'id'));
    }


    public function store(Request $request)
    {
        //
        $this->job_offers->store($request->all());
    }


    public function show($uuid)
    {
        //
    }


    public function edit($uuid)
    {
        //
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
