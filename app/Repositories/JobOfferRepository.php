<?php

namespace App\Repositories;

use App\Models\JobOffer\JobOffer;
use App\Services\Generator\Number;
use Illuminate\Support\Facades\DB;

class JobOfferRepository extends BaseRepository
{
    use Number;
    const MODEL = JobOffer::class;
    public function __construct()
    {
        //
    }
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('job_offers.id AS id'),
            DB::raw('job_offers.hr_interview_applicant_id AS hr_interview_applicant_id'),
            DB::raw('job_offers.parent_id AS parent_id'),
            DB::raw('job_offers.salary AS salary'),
            DB::raw('job_offers.user_id AS user_id'),
            DB::raw('designations.id AS designation_id'),
            DB::raw('job_offers.number AS number'),
            DB::raw('job_offers.details AS details'),
            DB::raw('job_offers.created_at AS created_at'),
            DB::raw('job_offers.uuid AS uuid'),
          ])
            ->leftjoin('hr_interview_applicants','hr_interview_applicants.id','job_offers.hr_interview_applicant_id')
            ->leftjoin('hr_interviews', 'hr_interviews.id', 'hr_interview_applicants.interview_id')
            ->leftjoin('hr_hire_requisitions_jobs', 'hr_hire_requisitions_jobs.id', 'hr_interviews.hr_requisition_job_id')
            ->leftjoin('designations', 'designations.id','hr_hire_requisitions_jobs.designation_id');
    }
    public function getAccessProcessing()
    {
        return $this->getQuery()
            ->where('job_offers.done', true)
            ->where('job_offers.rejected', false)
            ->where('job_offers.wf_done', 0)
            ->where('job_offers.user_id', access()->user()->id);
    }
    public function getAccessApproved()
    {
        return $this->getQuery()
            ->where('job_offers.done', true)
            ->where('job_offers.rejected', false)
            ->where('job_offers.wf_done', 1)
            ->where('job_offers.user_id', access()->user()->id);
    }
    public function getAccessRejected()
    {
        return $this->getQuery()
            ->where('job_offers.done', true)
            ->where('job_offers.rejected', true)
            ->where('job_offers.wf_done', 0)
            ->where('job_offers.user_id', access()->user()->id);
    }
    public function inputProcess($inputs)
    {
        $salary = currency_converter($inputs['salary'], 'USD');
        return[
            'salary'=> $salary,
            'details'=> $inputs['details'],
            'hr_interview_applicant_id'=>$inputs['hr_hire_requisitions_job_applicants_id'],
            'user_id'=>access()->user()->id,
            'date_of_arrival'=>$inputs['date_of_arrival'],
            'wf_done'=> 0,
            'done'=> true

        ];
    }
    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            $job_offer_id = $this->query()->create($this->inputProcess($inputs))->id;
            $job_offer =  $this->find($job_offer_id);
            $number =  $number = $this->generateNumber($job_offer);
            return $job_offer->update(['number'=>$number]);
        });
    }
    public function update($inputs, $uuid)
    {
        return DB::transaction(function () use ($inputs, $uuid){
            $job_offer =  $this->findByUuid($uuid);
            $job_offer->update($this->inputProcess($inputs));

        });
    }
}
