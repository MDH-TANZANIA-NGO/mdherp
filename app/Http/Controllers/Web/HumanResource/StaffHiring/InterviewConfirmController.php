<?php

namespace App\Http\Controllers\Web\HumanResource\StaffHiring;

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

    $interview_details = $this->interview_applicant->getInterviewScheduleApplicantDetails($applicant_id, $interview_id)->first();
//dd($interview_details);
        return view('HumanResource.StaffHiring.interviewconfirm')
            ->with('interview_details', $interview_details);
        }
}
