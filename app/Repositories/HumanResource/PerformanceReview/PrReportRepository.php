<?php

namespace App\Repositories\HumanResource\PerformanceReview;

use App\Exceptions\GeneralException;
use App\Models\Budget\FiscalYear;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Repositories\BaseRepository;
use App\Services\Generator\Number;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PrReportRepository extends BaseRepository
{
    const MODEL = PrReport::class;

    use Number;

    public function getQuery()
    {
        return $this->query()->select([
            'pr_reports.id AS id',
            'pr_reports.number AS number',
            'pr_reports.from_at AS from_at',
            'pr_reports.to_at AS to_at',
            'pr_reports.submited_at AS submited_at',
            'pr_reports.created_at AS created_at',
            'pr_reports.uuid AS uuid',
            'pr_types.title AS pr_type_title',
            'fiscal_years.title AS fiscal_year_title',
            'pr_reports.wf_done_date as approved_at'
        ])
            ->join('users', 'users.id', 'pr_reports.user_id')
            ->join('pr_types', 'pr_types.id', 'pr_reports.pr_type_id')
            ->join('fiscal_years', 'fiscal_years.id', 'pr_reports.fiscal_year_id');
    }

    /** 
     * get Access Processing
     * 
    */
    public function getAccessProcessing()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('pr_reports.wf_done', 0)
            ->where('pr_reports.done', true)
            ->where('pr_reports.rejected', false)
            ->where('users.id', access()->id());
    }


    /** 
     * get Access Returned For Modification
     * 
    */
    public function getAccessReturnedForModification()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('pr_reports.wf_done', 0)
            ->where('pr_reports.done', true)
            ->where('pr_reports.rejected', true)
            ->where('users.id', access()->id());
    }

    /** 
     * get Access Approved
     * @return mixed
    */
    public function getAccessApproved()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('pr_reports.wf_done', 1)
            ->where('pr_reports.done', true)
            ->where('pr_reports.rejected', false)
            ->where('users.id', access()->id());
    }

    /** 
     * get Access Saved
     * @return mixed
    */
    public function getAccessSaved()
    {
        return $this->getQuery()
            ->whereDoesntHave('wfTracks')
            ->where('pr_reports.wf_done', 0)
            ->where('pr_reports.done', false)
            ->where('pr_reports.rejected', false)
            ->where('users.id', access()->id());
    }

    /** 
     * get Access Approved Wait For Evaluation
     * @return mixed
    */
    public function getAccessApprovedWaitForEvaluation()
    {
        return $this->getAccessApproved()
            ->whereDoesntHave('child');
            // ->whereDate('pr_reports.to_at', '<=', Carbon::now()->format('Y-m-d'));
    }

    /** 
     * get Access Approved Wait For Evaluation
     * @return mixed
    */
    public function canBeAprocessedForEvaluation(PrReport $pr_report)
    {
        return $this->getAccessApprovedWaitForEvaluation()
            ->where('pr_reports.id', $pr_report->id)
            ->count();
    }


    /** 
     * store probation form
     * @return mixed
    **/
    public function probationStore()
    {
        return DB::transaction(function () {
            return access()->user()->prReports()->create([
                'from_at' => access()->user()->employed_date,
                'to_at' => access()->user()->three_month_probation,
                'fiscal_year_id' => FiscalYear::query()->where('active', true)->first()->id,
                'designation_id' => access()->user()->designation_id,
                'pr_type_id' => 1
            ]);
        });
    }

    public function store($input)
    {
        return DB::transaction(function () use($input){
            return access()->user()->prReports()->create([
                'from_at' => $input['from_at'],
                'to_at' => $input['to_at'],
                'fiscal_year_id' => FiscalYear::query()->where('active', true)->first()->id,
                'designation_id' => access()->user()->designation_id,
                'pr_type_id' => $input['type'],
                'region_id' => access()->user()->region_id
            ]);
        });
    }

    /** 
     * store probation form
     * @return mixed
    **/
    public function evaluationInitiate(PrReport $pr_report)
    {
        return DB::transaction(function () use($pr_report){
            return $pr_report->child()->create([
                'user_id' => $pr_report->user_id,
                'pr_type_id' => $pr_report->pr_type_id,
                'designation_id' => $pr_report->designation_id,
                'fiscal_year_id' => $pr_report->fiscal_year_id,
            ]);
        });
    }


    /**
     * Update is done column and generate number
     * @param Requisition $requisition
     * @return mixed
     */
    public function updateDoneAssignNextUserIdAndGenerateNumber(PrReport $pr_report)
    {
        $this->checkIfHasWorkflow($pr_report);
        $number = $pr_report->parent ? null : $this->generateNumber($pr_report);
        return DB::transaction(function () use ($pr_report, $number) {
            return $pr_report->update([
                'done' => true,
                // 'supervisor_id' => access()->user()->assignedSupervisor()->supervisor_id,
                // 'number' => $number
            ]);
        });
    }

    public function checkIfHasWorkflow(PrReport $pr_report)
    {
        if($pr_report->wfTracks()->count()){
            throw new GeneralException('You can not submit twice');
        }
    }
}
