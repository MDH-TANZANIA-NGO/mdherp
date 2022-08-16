<?php

namespace App\Repositories\HumanResource\HireRequisition;

use App\Exceptions\GeneralException;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;
use App\Models\HumanResource\HireRequisition\HrHireRequisitionJobApplicantShortlister;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class HrHireRequisitionJobApplicantShortlisterRepository extends BaseRepository
{
    const MODEL = HrHireRequisitionJobApplicantShortlister::class;

    public function store($hr_hire_requisition_job_applicant_id)
    {
        //check if selected
    }

    public function checkIfHrHireRequisitionsJobSelected($input)
    {
        if (!isset($input['hr_applicants'])) {
            throw new GeneralException('Please select atleast one job to proceed');
        }
    }

    public function shortlists(HireRequisitionJob $hire_requisition_job, $input)
    {
        $this->checkIfHrHireRequisitionsJobSelected($input);
        return DB::transaction(function() use($hire_requisition_job, $input){
            //check if applicant is registerd
        });
    }

    public function shortlist($hr_hire_requisitions_job_id, $online_applicant_id)
    {
        return DB::transaction(function () use ($hr_hire_requisitions_job_id, $online_applicant_id) {
            //register applicant on mimosa
            //check if user has been registerd
            if (HrHireApplicant::where('user_recruitment_id', $online_applicant_id)->count() == 0) {
                //call api for online recruitment applicants details
                $applicant = $this->getApplicantByJob($online_applicant_id, $hr_hire_requisitions_job_id);
                $applicant_input = [
                    'user_recruitment_id' => $applicant->id,
                    'first_name' => $applicant->applicant->first_name,
                    'middle_name' => $applicant->applicant->middle_name,
                    'last_name' => $applicant->applicant->last_name,
                    'email' => $applicant->email,
                    'phone' => $applicant->applicant->phone,
                ];
                $hr_hire_applicant = HrHireApplicant::create($applicant_input);
                $hr_hire_applicant_id = $hr_hire_applicant->id;
            }else{
                $hr_hire_applicant_id = HrHireApplicant::where('user_recruitment_id',$online_applicant_id)->first()->id;
            }
            //check if shortlisted
            if(HrHireRequisitionJobApplicant::where('hr_hire_applicant_id', $hr_hire_applicant_id)->where('hr_hire_requisitions_job_id', $hr_hire_requisitions_job_id)->count() > 0){
                throw new GeneralException('Applicant Already Shortlisted');
            }
            //attach applicant and job to mimosa
            $job_applicant = $this->query()->create([
                'hr_hire_requisitions_job_id' => $hr_hire_requisitions_job_id,
                'hr_hire_applicant_id' => $hr_hire_applicant_id,
                'user_id' => access()->id(),
            ]);
            //send applicant details to recruitment
             $this->sendApplicantUpdate($hr_hire_requisitions_job_id, $online_applicant_id);
            return $job_applicant;
        });
    }
}