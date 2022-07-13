<?php

namespace App\Repositories\HumanResource\Interview;

use App\Exceptions\GeneralException;
use App\Models\Auth\User;
use App\Models\Budget\FiscalYear;
use App\Models\HumanResource\Interview\Interview;
use App\Models\HumanResource\Interview\InterviewReport;
use App\Models\HumanResource\Interview\InterviewWorkflowReport;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use App\Services\Generator\Number;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InterviewReportRepository extends BaseRepository
{
    const MODEL = InterviewWorkflowReport::class;

    use Number;

    public function getQuery()
    {
        return $this->query()->select([
            'hr_interview_workflow_reports.id as id',
             DB::raw("CONCAT_WS(' ',units.title, designations.name) AS job_title"),
             'hr_interview_workflow_reports.created_at as created_at',
             'hr_interview_workflow_reports.uuid as uuid',
             'hr_hire_requisitions_jobs.empoyees_required as total'
            //  DB::raw("string_agg(DISTINCT regions.name, ',') as region"),

        ])
             
            ->join('hr_hire_requisitions_jobs', 'hr_hire_requisitions_jobs.id', 'hr_interview_workflow_reports.hr_requisition_job_id')
            ->join('designations','designations.id','hr_hire_requisitions_jobs.designation_id')
            ->join('units','units.id','designations.unit_id')
            
            ->join('users','users.id','hr_interview_workflow_reports.user_id');
            // ->join('hr_hire_requisition_locations','hr_hire_requisition_locations.hr_requisition_job_id','hr_interview_workflow_reports.hr_requisition_job_id')
            // ->join('regions','regions.id','hr_hire_requisition_locations.region_id')
            // ->groupby('regions.name','units.title', 'designations.name','hr_interview_workflow_reports.id','hr_hire_requisition_locations.region_id');
            
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


     

    public function getQueryWithInterview()
    { 
        return $this->getQuery();
    }

    /** 
     * get Access Processing
     * 
    */
    public function getAccessProcessingDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_interview_workflow_reports.wf_done', 0)
            ->where('hr_interview_workflo_reports.done', true)
            ->whereNull('hr_interview_workflow_reports.rejected')
            ->where('users.id', access()->id());
    }


    /** 
     * get Access Returned For Modification
     * 
    */
    public function getAccessDeniedDatatable(){
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_interview_workflow_reports.rejected', true)
            ->where('hr_interview_workflow_reports.user_id', access()->id());
    }


    public function getAccessRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_interview_workflow_reports.wf_done', 5)
            ->where('hr_interview_workflow_reports.user_id', access()->id());
    }
    /** 
     * get Access Approved
     * @return mixed
    */
    public function getAccessProvedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_interview_workflow_reports.wf_done', 1)
            ->where('hr_interview_workflow_reports.done', 1)
            ->whereNULL('hr_interview_workflow_reports.rejected')
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
            ->where('hr_interview_workflow_reports.wf_done', 0)
            ->where('hr_interview_workflow_reports.done', 0)
            ->whereNull('hr_interview_workflow_reports.rejected')
            ->where('users.id', access()->id());
    }

 
 
    public function store($input)
    {
        return DB::transaction(function () use($input){
            $input['hr_requisition_job_id'] = $input['hr_requisition_job_id'];
            // $input['shortlist_id'] = '0';
            $input['user_id'] = access()->id();
            return $this->query()->create($input);
        });
    }


    public function storeInterviewReport($interviews,$interview_workflow_report_id){
        foreach($interviews as $interview){
            $data = [
                        'interview_id'=>$interview->id,
                        'interview_report_id' => $interview_workflow_report_id
            ];
            InterviewReport::create($data);
        }
    }


    public function submit($interviewReport)
    {
        $number = $this->generateNumber($interviewReport);
        $interviewReport->update([
            'number'=> $number
        ]);
    }


    public function updateRecommendedApplicant($recommendedApplicants){
        $recommendedApplicants->each(function($item,$key){
            $item->is_confirmed = 1;
            $item->save();
        });
    }

}
