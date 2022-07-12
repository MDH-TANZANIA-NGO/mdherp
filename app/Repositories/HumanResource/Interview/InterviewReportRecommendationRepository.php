<?php

namespace App\Repositories\HumanResource\Interview;

use App\Exceptions\GeneralException;
use App\Models\Auth\User;
use App\Models\Budget\FiscalYear;
use App\Models\HumanResource\Interview\Interview;
use App\Models\HumanResource\Interview\InterviewReport;
use App\Models\HumanResource\Interview\InterviewReportRecommendation;
use App\Models\HumanResource\Interview\InterviewWorkflowReport;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use App\Services\Generator\Number;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InterviewReportRecommendationRepository extends BaseRepository
{
    const MODEL = InterviewReportRecommendation::class;

    use Number;

    public function getApplicantForJobOffer()
    {
        return $this->query()->select([
            DB::raw("CONCAT_WS(' ',hr_hire_applicants.first_name,hr_hire_applicants.middle_name,hr_hire_applicants.last_name ) AS full_name"),
            DB::raw('hr_interview_report_recommendations.id AS id'),
            // DB::raw('hr_interview_report_recommendations.interview_id AS interview_id'),
            // DB::raw('hr_interview_report_recommendations.interview_schedule_id AS interview_schedule_id'),
            DB::raw('hr_hire_advertisement_requisitions.description AS description'),
            DB::raw('hr_hire_requisitions_jobs.designation_id AS designation_id'),
            DB::raw('designations.name AS designation_name'),
            DB::raw('units.name AS unit_name'),
            DB::raw('job_offers.status AS job_offer_status')
            //  DB::raw('hr_interview_types.name AS interview_type_name'),
            // DB::raw('hr_interview_schedules.interview_date AS interview_date'),
        ])
            ->join('hr_hire_applicants', 'hr_hire_applicants.id', 'hr_interview_report_recommendations.applicant_id')
            // ->join('hr_interviews', 'hr_interviews.id', 'hr_interview_report_recommendations.interview_id')
            // ->leftjoin('hr_interview_types', 'hr_interviews.interview_type_id', 'hr_interview_types.id')
            // ->leftjoin('hr_interview_schedules', 'hr_interview_schedules.interview_id', 'hr_interviews.id')
            ->join('hr_hire_requisitions_jobs','hr_hire_requisitions_jobs.id', 'hr_interview_report_recommendations.hr_requisition_job_id')
            ->leftjoin('hr_hire_advertisement_requisitions','hr_hire_advertisement_requisitions.hire_requisition_job_id','hr_hire_requisitions_jobs.id')
            ->leftjoin('designations','hr_hire_requisitions_jobs.designation_id', 'designations.id')
            ->leftjoin('units', 'designations.unit_id', 'units.id')
            ->leftjoin('job_offers', 'job_offers.hr_interview_applicant_id', 'hr_interview_report_recommendations.id')
            ->where('hr_interview_report_recommendations.is_confirmed',1)
            ->whereDoesntHave('jobOffer')
            ->orWhere('job_offers.status', 2);

    }

    public function getAdvertDetails($id)
    {
        // dd($id);
        return $this->getApplicantForJobOffer()
            ->where('hr_interview_report_recommendations.id', $id);
    }

    public function getInterviewScheduleApplicantDetails($applicant_id, $interview_id)
    {
        return $this->getApplicantForJobOffer()
            ->where('hr_interview_report_recommendations.applicant_id', $applicant_id);
            // ->where('hr_interview_applicants.interview_id', $interview_id);

    }

  

}
