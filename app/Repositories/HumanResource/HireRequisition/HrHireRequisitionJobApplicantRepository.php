<?php

namespace App\Repositories\HumanResource\HireRequisition;

use App\Models\HumanResource\HireRequisition\HrHireApplicant;
use App\Models\HumanResource\HireRequisition\HrHireRequisitionJobApplicant;
use App\Repositories\BaseRepository;
use App\Services\RecruitmentApi\HumanResource\HireRequisition\HireRequisitionJobService;
use Illuminate\Support\Facades\DB;

class HrHireRequisitionJobApplicantRepository extends BaseRepository
{
    const MODEL = HrHireRequisitionJobApplicant::class;
    use  HireRequisitionJobService;

    /** 
     * Shortlist applicant and attach to related job
     * @param $hr_hire_requisitions_job_id, $online_applicant_id
     * @param $online_applicant_id
     * @return mixed
    */
    public function shortlist($hr_hire_requisitions_job_id, $online_applicant_id)
    {
        return DB::transaction(function() use($hr_hire_requisitions_job_id, $online_applicant_id){
            //call api for online recruitment applicants details
            $applicant = $this->getApplicantByJob($online_applicant_id,$hr_hire_requisitions_job_id);
            $applicant_input = [
                'user_recruitment_id' => $applicant->id,
                'first_name' => $applicant->applicant->first_name,
                'middle_name' => $applicant->applicant->middle_name,
                'last_name' => $applicant->applicant->last_name,
                'email' => $applicant->email,
                'phone' => $applicant->applicant->phone,
            ];
            //register applicant on mimosa
            $hr_hire_applicant = HrHireApplicant::create($applicant_input);
            //attach applicant and job to mimosa
            $job_applicant = $this->query()->create([
                'hr_hire_requisitions_job_id' => $hr_hire_requisitions_job_id,
                'hr_hire_applicant_id' => $hr_hire_applicant->id
            ]);
            //send applicant details to recruitment
            // $this->sendApplicantUpdate($hr_hire_requisitions_job_id, $online_applicant_id, $hr_hire_applicant->id);
            return $job_applicant;
        });
    }

}