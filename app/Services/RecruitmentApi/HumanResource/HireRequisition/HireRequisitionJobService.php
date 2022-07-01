<?php

namespace App\Services\RecruitmentApi\HumanResource\HireRequisition;

use Illuminate\Support\Facades\Http;

trait HireRequisitionJobService
{

    public function getApplicantsByJob($hire_requisition_job_id)
    {
        $response = Http::get(config('mdh.recruitment_portal_url').'applications/'.$hire_requisition_job_id.'/applicants');
        return json_decode($response);
    }

    public function getApplicantByJob($online_applicant_id, $hire_requisition_job_id)
    {
        $response = Http::get(config('mdh.recruitment_portal_url').'applicant/'.$online_applicant_id.'/resource/'.$hire_requisition_job_id);
        return json_decode($response);
    }

    public function sendApplicantUpdate($hr_hire_requisitions_job_id, $online_applicant_id, $mimosa_applicant_id)
    {
        $shortlisted = "Shortlisted";
        return Http::post(config('mdh.recruitment_portal_url').'applicant/'.$online_applicant_id.'/resource/'.$hr_hire_requisitions_job_id.'/mimosa_applicant_id/'.$mimosa_applicant_id.'status'.$shortlisted.'/update');
    }
}