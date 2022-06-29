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

    public function getSelected($interview_id){
        return $this->query()->select([
            DB::raw("CONCAT_WS(' ',hr_hire_applicants.first_name,hr_hire_applicants.middle_name,hr_hire_applicants.last_name) as full_name") 
        ])
        ->Join('hr_interview_applicants','hr_interview_applicants.applicant_id','hr_hire_applicants.id')
        ->join('hr_intereview_schedules','hr_intereview_schedules.id','hr_interview_applicants.interview_schedule_id')
        ->where('hr_intereview_schedules.interview_id',$interview_id);
    }
    public function getPendingSelected($interview_id){
        return $this->query()->select([
            DB::raw("CONCAT_WS(' ',hr_hire_applicants.first_name,hr_hire_applicants.middle_name,hr_hire_applicants.last_name) as full_name") 
        ])
        ->Join('hr_interview_applicants','hr_interview_applicants.applicant_id','hr_hire_applicants.id')
        ->join('hr_intereview_schedules','hr_intereview_schedules.id','hr_interview_applicants.interview_schedule_id')
        ->where('hr_intereview_schedules.interview_id',$interview_id);
    }

}