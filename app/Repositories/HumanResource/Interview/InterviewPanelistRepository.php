<?php

namespace App\Repositories\HumanResource\Interview;

use App\Exceptions\GeneralException;
use App\Models\Auth\User;
use App\Models\Budget\FiscalYear;
use App\Models\HumanResource\Interview\Interview;
use App\Models\HumanResource\Interview\InterviewPanelist;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use App\Services\Generator\Number;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InterviewPanelistRepository extends BaseRepository
{
    const MODEL = InterviewPanelist::class;

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



    public function store($input)
    {
        return $this->query()->create($input);
    }
    public function update($panelist,$input)
    {
        return $panelist->update($input);
    }



 
}
