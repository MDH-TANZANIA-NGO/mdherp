<?php

namespace App\Repositories\HumanResource\HireRequisition;

use App\Models\Budget\FiscalYear;
use App\Services\Generator\Number;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;
use App\Models\HumanResource\HireRequisition\HrHireApplicant;
use App\Models\HumanResource\HireRequisition\HrHireRequisitionJobShortlist;

class HrHireApplicantRepository extends BaseRepository
{
    use Number;
    const MODEL = HrHireApplicant::class;

    public function getSelected($interview){
        return $this->query()->select([
            'hr_hire_applicants.id',
            DB::raw("CONCAT_WS(' ',hr_hire_applicants.first_name,hr_hire_applicants.middle_name,hr_hire_applicants.last_name) as full_name"),
            DB::raw("hr_hire_applicants.email") ,
            DB::raw("hr_interview_schedules.interview_date")
        ])
        ->Join('hr_interview_applicants','hr_interview_applicants.applicant_id','hr_hire_applicants.id')
        ->join('hr_interview_schedules','hr_interview_schedules.id','hr_interview_applicants.interview_schedule_id')
        ->where('hr_interview_applicants.interview_id',$interview->id);
    }


    public function getSelectedWithMarks($interview){
        
        return $this->query()->select([
            'hr_hire_applicants.id',
            DB::raw("CONCAT_WS(' ',hr_hire_applicants.first_name,hr_hire_applicants.middle_name,hr_hire_applicants.last_name) as full_name"),
            DB::raw("hr_hire_applicants.email") ,
            DB::raw("SUM(hr_interview_question_marks.marks) as Marks")
        ])
        ->leftjoin('hr_interview_question_marks','hr_interview_question_marks.applicant_id','hr_hire_applicants.id')
        ->where('hr_interview_question_marks.interview_id',$interview->id)
        ->whereNull('hr_interview_question_marks.deleted_at')
        ->groupby('hr_hire_applicants.id');
    }
    public function getPendingSelected($interview){
        $hr_requisition_job_id = $interview->hr_requisition_job_id;
        $interview_id =  $interview->id;
        return $this->query()->select([
            DB::raw("DISTINCT(hr_hire_applicants.id)"),
            DB::raw("CONCAT_WS(' ',hr_hire_applicants.first_name,hr_hire_applicants.middle_name,hr_hire_applicants.last_name) as full_name"),
        ])
        ->whereNotIn('hr_hire_applicants.id',function($query) use($interview_id){
            $query->select('hr_interview_applicants.applicant_id')->from('hr_interview_applicants')
                    ->where('interview_id',$interview_id);
        })
        ->groupby('hr_hire_applicants.id','hr_hire_applicants.first_name','hr_hire_applicants.middle_name','hr_hire_applicants.last_name');

    }

}
