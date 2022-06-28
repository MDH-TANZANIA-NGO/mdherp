<?php

namespace App\Repositories\HumanResource\HireRequisition;

use App\Models\Budget\FiscalYear;
use App\Services\Generator\Number;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;
use App\Models\HumanResource\HireRequisition\HrHireRequisitionJobShortlist;

class HrHireRequisitionJobShortlistRepository extends BaseRepository
{
    use Number;
    const MODEL = HrHireRequisitionJobShortlist::class;

    public function shortlist(HireRequisitionJob $hire_requisition_job, $input)
    {
        return DB::transaction(function() use($hire_requisition_job, $input){
            //do shortlist parent
            $shortlist = $this->query()->create([
                'user_id' => access()->id(),
                'supervisor_id' => access()->user()->assignedSupervisor()->supervisor_id,
                'fiscal_year_id' => FiscalYear::query()->where('active', true)->first()->id,
                'region_id' => access()->user()->region_id,
                'done' => true
            ]);
            //generate number
            $shortlist->update(['number' => $this->generateNumber($shortlist)]);
            //shortlist participants
            $shortlist->job_pert->sync(['hire_requisition_job_id' => $hire_requisition_job],$input);
            return $shortlist;
        });
    }

}