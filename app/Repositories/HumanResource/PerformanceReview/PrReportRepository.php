<?php

namespace App\Repositories\HumanResource\PerformanceReview;

use App\Models\HumanResource\PrReport;
use App\Models\Budget\FiscalYear;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PrReportRepository extends BaseRepository
{
    const MODEL = PrReport::class;

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
