<?php

namespace App\Repositories\HumanResource\Interview;

use App\Exceptions\GeneralException;
use App\Models\Auth\User;
use App\Models\Budget\FiscalYear;
use App\Models\HumanResource\Interview\Interview;
use App\Models\HumanResource\Interview\InterviewApplicant;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use App\Services\Generator\Number;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InterviewApplicantRepository extends BaseRepository
{
    const MODEL = InterviewApplicant::class;

    use Number;

    public function getQuery()
    {
        return $this->query()->select([
             DB::raw("CONCAT_WS(' ',hr_hire_applicants.first_name,hr_hire_applicants.middle_name,hr_hire_applicants.last_name ) AS full_name"),
             DB::raw("hr_hire_applicants.id"),
        ])
        ->join('hr_hire_applicants', 'hr_hire_applicants.id', 'hr_interview_applicants.applicant_id');
     }
    public function getApplicantForJobOffer()
    {
        return $this->query()->select([
            DB::raw("CONCAT_WS(' ',hr_hire_applicants.first_name,hr_hire_applicants.middle_name,hr_hire_applicants.last_name ) AS full_name"),
            DB::raw('hr_interview_applicants.id AS id'),
            DB::raw('hr_interview_applicants.interview_id AS interview_id'),
            DB::raw('hr_interview_applicants.interview_schedule_id AS interview_schedule_id'),
            DB::raw('hr_hire_advertisement_requisitions.description AS description'),
            DB::raw('hr_hire_requisitions_jobs.designation_id AS designation_id'),
            DB::raw('designations.name AS designation_name'),
            DB::raw('units.name AS unit_name'),
            DB::raw('job_offers.status AS job_offer_status'), DB::raw('hr_interview_types.name AS interview_type_name'),
            DB::raw('hr_interview_schedules.interview_date AS interview_date'),
        ])
            ->join('hr_hire_applicants', 'hr_hire_applicants.id', 'hr_interview_applicants.applicant_id')
            ->join('hr_interviews', 'hr_interviews.id', 'hr_interview_applicants.interview_id')
            ->leftjoin('hr_interview_types', 'hr_interviews.interview_type_id', 'hr_interview_types.id')
            ->leftjoin('hr_interview_schedules', 'hr_interview_schedules.interview_id', 'hr_interviews.id')
            ->join('hr_hire_requisitions_jobs','hr_hire_requisitions_jobs.id', 'hr_interviews.hr_requisition_job_id')
            ->leftjoin('hr_hire_advertisement_requisitions','hr_hire_advertisement_requisitions.hire_requisition_job_id','hr_hire_requisitions_jobs.id')
            ->leftjoin('designations','hr_hire_requisitions_jobs.designation_id', 'designations.id')
            ->leftjoin('units', 'designations.unit_id', 'units.id')
            ->leftjoin('job_offers', 'job_offers.hr_interview_applicant_id', 'hr_interview_applicants.id')
            ->where('hr_interview_applicants.status',1)
            ->whereDoesntHave('jobOffer')
            ->orWhere('job_offers.status', '1');

    }




    public function getAdvertDetails($id)
    {

        return $this->getApplicantForJobOffer()

            ->where('hr_interview_applicants.id', $id);
    }

    public function getInterviewScheduleApplicantDetails($applicant_id, $interview_id)
    {
        return $this->getApplicantForJobOffer()
            ->where('hr_interview_applicants.applicant_id', $applicant_id)
            ->where('hr_interview_applicants.interview_id', $interview_id);

    }

    public function getForSelect($interviews){
        return $this->getQuery()->whereIn('hr_interview_applicants.interview_id',$interviews)->get()->pluck('full_name','id');
    }
    public function competedScored($interview_id)
    {
        return $this->query()->where('is_scored',1)->where('interview_id',$interview_id);
    }
    public function pendingScored($interview_id)
    {
        return $this->query()->where('is_scored',0)->where('interview_id',$interview_id);
    }

    public function store($input)
    {
        return DB::transaction(function () use($input){
            $data['interview_id'] = $input['interview_id'];
            $data['interview_schedule_id'] = $input['interview_schedule_id'];
            $applicants = $input['applicant'];
            foreach($applicants as $applicant){
                $data['applicant_id'] = $applicant;
                $applicant = $this->query()->create($data);
                $number = $this->generateNumber($applicant);
                $applicant->number = $number;
                $applicant->save();

            }
        });
    }

    /**
     * store probation form
     * @return mixed
    **/
    public function getShortlisted()
    {
         return DB::table('hr_hire_requisition_job_applicants')
            ->select('hr_hire_requisition_job_applicants.id',
            DB::raw("CONCAT_WS(' ',hr_hire_applicants.first_name,hr_hire_applicants.middle_name,hr_hire_applicants.last_name) as full_name")
            ,'hr_hire_requisition_job_applicants.created_at')
            ->join('hr_hire_applicants','hr_hire_applicants.id','hr_hire_requisition_job_applicants.hr_hire_applicant_id');

    }





    /**
     * Update is done column and generate number
     * @param Requisition $requisition
     * @return mixed
     */
    public function updateDoneAssignNextUserIdAndGenerateNumber(Interview $pr_report)
    {
        $this->checkIfHasWorkflow($pr_report);
        $number = $pr_report->parent ? null : $this->generateNumber($pr_report);
        return DB::transaction(function () use ($pr_report, $number) {
            return $pr_report->update(['done' => true]);
        });
    }

    public function checkIfHasWorkflow(Interview $pr_report)
    {
        if($pr_report->wfTracks()->count()){
            throw new GeneralException('You can not submit twice');
        }
    }

    public function completed(Interview $pr_report)
    {
            $pr_report->update(['completed' => 1]);
            $email_resource = (object)[
                'link' =>  route('hr.pr.show',$pr_report),
                'subject' => "Kindly Processd with workflow ".$pr_report->parent->type->title." ".$pr_report->parent->number,
                'message' => 'Employee has Completed to fill all the required inputs'
            ];
            // User::query()->find($pr_report->parent->supervisor_id)->notify(new WorkflowNotification($email_resource));
    }
}
