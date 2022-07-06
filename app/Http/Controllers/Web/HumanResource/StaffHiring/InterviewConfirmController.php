<?php

namespace App\Http\Controllers\Web\HumanResource\StaffHiring;

use App\Models\HumanResource\Interview\InterviewApplicant;
use App\Repositories\HumanResource\Interview\InterviewApplicantRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InterviewConfirmController extends Controller
{
    protected $interview_applicant;


    public function __construct()
    {
        $this->interview_applicant = (new InterviewApplicantRepository());
    }
    public function index($applicant_id, $interview_id){

        $interview_details = InterviewApplicant::query()->where('applicant_id', $applicant_id)->where('interview_id', $interview_id)->first();
//    $interview_details = $this->interview_applicant->getInterviewScheduleApplicantDetails($applicant_id, $interview_id)->first();
//dd($our_query);
        return view('HumanResource.StaffHiring.interviewconfirm')
            ->with('interview_details', $interview_details);
        }

        public function update($applicant_id, $interview_id)
        {
            $interview_details = $this->interview_applicant->getInterviewScheduleApplicantDetails($applicant_id, $interview_id)->first();
            InterviewApplicant::query()->where('id', $interview_details->id)->update(['confirm'=>1]);
            return redirect()->back();
        }
}
