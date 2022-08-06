<?php

namespace App\Repositories\HumanResource\Interview;

use App\Exceptions\GeneralException;
use App\Models\Auth\User;
use App\Models\Budget\FiscalYear;
use App\Models\HumanResource\Interview\Interview;
use App\Models\HumanResource\Interview\InterviewApplicant;
use App\Models\HumanResource\Interview\InterviewPanelist;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use App\Services\Generator\Number;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InterviewRepository extends BaseRepository
{
    const MODEL = Interview::class;

    use Number;

    public function getQuery()
    {
        return $this->query()->select([
            'hr_interviews.id AS id',
            'hr_interviews.number AS number',
            'hr_interviews.created_at AS created_at',
            'hr_interviews.uuid AS uuid',
            'hr_interview_types.name as interview_type',
            'hr_interview_panelists.user_id as user_id',
             DB::raw("STRING_AGG(to_char(hr_interview_schedules.interview_date,'dd-mm-yyyy'),',') as interview_date"),
             DB::raw("CONCAT_WS(' ',units.title, designations.name) AS job_title"),
        ])
            ->join('hr_interview_schedules','hr_interview_schedules.interview_id','hr_interviews.id')
            ->join('hr_interview_types','hr_interview_types.id','hr_interviews.interview_type_id')
            ->join('hr_hire_requisitions_jobs', 'hr_hire_requisitions_jobs.id', 'hr_interviews.hr_requisition_job_id')
            ->join('designations','designations.id','hr_hire_requisitions_jobs.designation_id')
            ->join('units','units.id','designations.unit_id')
            ->leftjoin('hr_interview_panelists',function($query){
                $query->on('hr_interview_panelists.interview_id','hr_interviews.id')->where('hr_interview_panelists.technical_staff',1);
            })
            ->groupby('hr_interviews.id','units.title','designations.name','hr_interview_types.name','hr_interview_panelists.user_id');
    }
    public function getQuery2()
    {
        return $this->query()->select([
             DB::raw("hr_interview_panelist_counters.counter"),
             DB::raw("hr_interview_panelist_counters.total_panelist"),
             DB::raw("hr_hire_requisitions_jobs.id"),
             DB::raw("hr_hire_requisitions_jobs.uuid"),
             DB::raw("CONCAT_WS(' ',units.title, designations.name) AS job_title")
        ])
            ->join('hr_hire_requisitions_jobs','hr_hire_requisitions_jobs.id','hr_interviews.hr_requisition_job_id')
            ->join('hr_interview_panelist_counters','hr_interview_panelist_counters.interview_id','hr_interviews.id')
            ->join('designations','designations.id','hr_hire_requisitions_jobs.designation_id')
            ->join('units','units.id','designations.unit_id')
            ->whereColumn('hr_interview_panelist_counters.total_panelist','=','hr_interview_panelist_counters.counter')
            ->groupby('hr_hire_requisitions_jobs.id','units.title', 'designations.name','hr_interview_panelist_counters.counter','hr_interview_panelist_counters.total_panelist','hr_interview_panelist_counters.interview_id');
    }


    public function getQuery3()
    {
        return $this->query()->select([
            'hr_interviews.id AS id',
            'hr_interviews.number AS number',
            'hr_interviews.created_at AS created_at',
            'hr_interviews.uuid AS uuid',
            'hr_interview_types.name as interview_type',
            'hr_interview_panelists.user_id as user_id',
             DB::raw("COUNT(hr_interview_applicants.id) as total_applicants"),
             DB::raw("SUM(CASE WHEN hr_interview_applicants.confirm IS NULL THEN 0 ELSE 1 END) as total_confirmed"),
             DB::raw("STRING_AGG(to_char(hr_interview_schedules.interview_date,'dd-mm-yyyy'),',') as interview_date"),
             DB::raw("CONCAT_WS(' ',units.title, designations.name) AS job_title"),
        ])
            ->leftjoin('hr_interview_schedules','hr_interview_schedules.interview_id','hr_interviews.id')
            ->join('hr_interview_types','hr_interview_types.id','hr_interviews.interview_type_id')
            ->join('hr_hire_requisitions_jobs', 'hr_hire_requisitions_jobs.id', 'hr_interviews.hr_requisition_job_id')
            ->join('designations','designations.id','hr_hire_requisitions_jobs.designation_id')
            ->join('units','units.id','designations.unit_id')
            ->leftjoin("hr_interview_applicants","hr_interview_applicants.interview_id","hr_interviews.id")
            ->leftjoin('hr_interview_panelists',function($query){
                $query->on('hr_interview_panelists.interview_id','hr_interviews.id')->where('hr_interview_panelists.technical_staff',1);
            })
            ->groupby('hr_interviews.id','units.title','designations.name','hr_interview_types.name','hr_interview_panelists.user_id');
    }

    public function getQueryWithInterview()
    { 
        return $this->getQuery();
    }

    /** 
     * get Access Processing
     * 
    */
    public function getAccessProcessing()
    {
        return $this->getQuery3()
            ->whereHas('wfTracks')
            ->where('hr_interviews.wf_done', 0)
            ->where('hr_interviews.done', true)
            ->where('hr_interviews.rejected', false)
            ->where('users.id', access()->id());
    }


    /** 
     * get Access Returned For Modification
     * 
    */
    public function getAccessReturnedForModification()
    {
        return $this->getQuery()
                    ->whereNotNull('hr_interviews.has_interview_invitation')           
                    ->whereNull('hr_interviews.has_questions'); 
    }

    /** 
     * get Access Approved
     * @return mixed
    */
    public function getAccessApproved()
    {
        return $this->getQuery3()
            ->whereHas('wfTracks')
            ->where('hr_interviews.wf_done', 1)
            ->where('hr_interviews.done', true)
            ->where('hr_interviews.rejected', false)
            ->where('users.id', access()->id());
    }

    /** 
     * get Access Saved
     * @return mixed
    */
    public function getAccessSavedDatatable()
    {
        return $this->getQuery3()
            ->where('hr_interviews.done', 0)
            ->where('hr_interviews.user_id', access()->id());
    }

    /** 
     * get Access Approved Wait For Evaluation
     * @return mixed
    */
    public function getAccessWaitForQuestionsDatatable()
    {
         return $this->getQuery3()
                ->whereNotNull('hr_interviews.has_interview_invitation')           
                ->whereNull('hr_interviews.has_questions')       
                ->where('hr_interviews.done',1);           
    }
    public function getAccessWaitForReportDatatable()
    {
         return $this->getQuery3()
                ->whereNotNull('hr_interviews.has_interview_invitation')           
                ->whereNotNull('hr_interviews.has_questions')
                ->where('hr_interviews.done',1);    
      
    }
    public function getForSelectByJob($hr_requisition_job_id)
    {
         return $this->query()->select([
                    'hr_interviews.id AS id',
                    'hr_interviews.number AS number',
                    'hr_interviews.created_at AS created_at',
                    'hr_interviews.uuid AS uuid',
                    'hr_interview_types.name as interview_type',
                    DB::raw("STRING_AGG(to_char(hr_interview_schedules.interview_date,'dd-mm-yyyy'),',') as interview_date"),
                ])
                ->join('hr_interview_schedules','hr_interview_schedules.interview_id','hr_interviews.id')
                ->join('hr_interview_types','hr_interview_types.id','hr_interviews.interview_type_id')
                ->where('hr_interviews.hr_requisition_job_id',$hr_requisition_job_id)        
                ->groupby('hr_interviews.id','hr_interviews.number','hr_interviews.created_at','hr_interviews.uuid','hr_interview_schedules.interview_date','hr_interview_types.name');     
    }

    /** 
     * get Access Approved Wait For Evaluation
     * @return mixed
    */
 
    public function store($input)
    {
        return DB::transaction(function () use($input){
            $input['hr_requisition_job_id'] = $input['hr_requisition_job_id'];
            $input['shortlist_id'] = '0';
            $input['user_id'] = access()->id();
            return $this->query()->create($input);
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


    public function interviewPanelist($interviews){
        return InterviewPanelist::select([
            'users.id',
            DB::raw("concat_ws(' ', units.name, designations.name) as title"),
            DB::raw("concat_ws( ' ', users.first_name,users.middle_name, users.last_name) as full_name"),
            'users.email'       
        ])
        ->join('users','users.id','hr_interview_panelists.user_id')
        ->join('designations','designations.id','users.designation_id')
        ->join('units','units.id','designations.unit_id')
        ->whereIn('hr_interview_panelists.interview_id',$interviews->pluck('id')->toArray()); 
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

    public function checkIfHasWorkflow(Interview $interview)
    {
        if($interview->wfTracks()->count()){
            throw new GeneralException('You can not submit twice');
        }
    }
    public function invitedApplicants($interview)
    {
        return InterviewApplicant::where("interview_id",$interview)->where('is_emailed',1);
    }
    public function applicants($interview)
    {
        return InterviewApplicant::where("interview_id",$interview);
    }
    public function confirmedApplicants($interview)
    {
        return InterviewApplicant::where("interview_id",$interview)->where('confirm',1);
    }

    public function submit($interview)
    {
        $number = $this->generateNumber($interview);
        $interview->update([
            'number'=> $number
        ]);
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
