<?php

namespace App\Repositories\HumanResource\PerformanceReview;

use App\Models\HumanResource\PrReport;
use App\Models\Budget\FiscalYear;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PrReportRepository extends BaseRepository
{
    const MODEL = PrReport::class;

    public function getQuery()
    {
        return $this->query()->select([

        ])
        ->join('users','users.id','pr_reports.user_id');
    }

    public function getAccessProcessing()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('pr_reports.wf_done', 0)
            ->where('pr_reports.done', true)
            ->where('pr_reports.rejected', false)
            ->where('users.id', access()->id());
    }


    public function getAccessReturnedForModification()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('pr_reports.wf_done', 0)
            ->where('pr_reports.done', true)
            ->where('pr_reports.rejected', true)
            ->where('users.id', access()->id());
    }

    public function getAccessApproved()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('pr_reports.wf_done', 1)
            ->where('pr_reports.done', true)
            ->where('pr_reports.rejected', false)
            ->where('users.id', access()->id());
    }


    public function getAccessSaved()
    {
        return $this->getQuery()
            ->whereDoesntHave('wfTracks')
            ->where('pr_reports.wf_done', 0)
            ->where('pr_reports.done', false)
            ->where('pr_reports.rejected', false)
            ->where('users.id', access()->id());
    }

    public function inputsProcessor($inputs)
    {
        return [
            'from_at' => $inputs['from_at'],
            'to_at' => $inputs['to_at'],
            'fiscal_year' => FiscalYear::query()->where('active', true)->first()->id,
            'designation_id' => access()->user()->designation_id,
            'parent_id' => $inputs['parent_id'] ?? null,
            'supervisor_id' => access()->user()->assignedSupervisor()->supervisor_id
        ];
    }

    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            return $this->query()->create($this->inputsProcessor($inputs));
        });
    }

}
