<?php

namespace App\Services\RecruitmentApi\HumanResource\HireRequisition;

use Illuminate\Support\Facades\Http;

trait HireRequisitionJobService
{

    public function getApplicants($hire_requisition_job_id)
    {
        $response = Http::get(config('mdh.recruitment_portal_url',null).'applications/'.$hire_requisition_job_id.'/applicants');
        return json_decode($response);
    }
}