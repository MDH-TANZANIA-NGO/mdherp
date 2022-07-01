<?php

namespace App\Repositories\HumanResource\Interview;

use App\Exceptions\GeneralException;
use App\Models\Auth\User;
use App\Models\Budget\FiscalYear;
use App\Models\HumanResource\Interview\Interview;
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
            'interview.id AS id',
            'interview.number AS number',
            'interview.created_at AS created_at',
            'interview.uuid AS uuid',
            'interview.wf_done_date as approved_at'
        ])
            ->join('users', 'users.id', 'interview.user_id')
            ->join('hr_hire_requisitions_jobs', 'hr_hire_requisitions_jobs.id', 'interview.hr_requisition_job_id');
            // ->join('fiscal_years', 'fiscal_years.id', 'interview.fiscal_year_id');
    }

    /** 
     * get Access Processing
     * 
    */
    public function getAccessProcessing()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('interview.wf_done', 0)
            ->where('interview.done', true)
            ->where('interview.rejected', false)
            ->where('users.id', access()->id());
    }


    /** 
     * get Access Returned For Modification
     * 
    */
    public function getAccessReturnedForModification()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('interview.wf_done', 0)
            ->where('interview.done', true)
            ->where('interview.rejected', true)
            ->where('users.id', access()->id());
    }

    /** 
     * get Access Approved
     * @return mixed
    */
    public function getAccessApproved()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('interview.wf_done', 1)
            ->where('interview.done', true)
            ->where('interview.rejected', false)
            ->where('users.id', access()->id());
    }

    /** 
     * get Access Saved
     * @return mixed
    */
    public function getAccessSavedDatatable()
    {
        return $this->getQuery()
            ->whereDoesntHave('wfTracks')
            ->where('interview.wf_done', 0)
            ->where('interview.done', false)
            ->where('interview.rejected', false)
            ->where('users.id', access()->id());
    }

    /** 
     * get Access Approved Wait For Evaluation
     * @return mixed
    */
    public function getAccessApprovedWaitForEvaluation()
    {
        return $this->getAccessApproved()
            ->whereDoesntHave('child');
            // ->whereDate('interview.to_at', '<=', Carbon::now()->format('Y-m-d'));
    }

    /** 
     * get Access Approved Wait For Evaluation
     * @return mixed
    */
    public function canBeAprocessedForEvaluation(Interview $pr_report)
    {
        return $this->getAccessApprovedWaitForEvaluation()
            ->where('interview.id', $pr_report->id)
            ->count();
    }


    /** 
     * store probation form
     * @return mixed
    **/
    public function probationStore()
    {
        return DB::transaction(function () {
            return access()->user()->prReports()->create([
                'from_at' => access()->user()->employed_date,
                'to_at' => access()->user()->three_month_probation,
                'fiscal_year_id' => FiscalYear::query()->where('active', true)->first()->id,
                'designation_id' => access()->user()->designation_id,
                'pr_type_id' => 1
            ]);
        });
    }

    public function store($input)
    {
        return DB::transaction(function () use($input){
            $input['hr_requisition_job_id'] = $input['hr_requisition_job_id'];
            $input['shortlist_id'] = '12';
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
            // ->join('hr_hire_requisition_job_applicants','hr_hire_applicants.id','hr_hire_requisition_job_applicants.hr_hire_applicant_id');
           

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
