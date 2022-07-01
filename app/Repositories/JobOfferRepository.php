<?php

namespace App\Repositories;

use App\Models\JobOffer\JobOffer;
use Illuminate\Support\Facades\DB;

class JobOfferRepository extends BaseRepository
{
    const MODEL = JobOffer::class;
    public function __construct()
    {
        //
    }
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('job_offers.id AS id'),
            DB::raw('job_offers.hr_hire_requisitions_job_id AS hr_hire_requisitions_job_id'),
            DB::raw('job_offers.parent_id AS parent_id'),
            DB::raw('job_offers.salary AS salary'),
            DB::raw('job_offers.user_id AS user_id'),
            DB::raw('job_offers.number AS number'),
            DB::raw('job_offers.details AS details'),
            DB::raw('job_offers.created_at AS created_at'),
            DB::raw('job_offers.uuid AS uuid'),
          ])
            ->join('hr_hire_requisitions_jobs','hr_hire_requisitions_jobs.id','job_offers.hr_hire_requisitions_job_id')
            ;
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
}
