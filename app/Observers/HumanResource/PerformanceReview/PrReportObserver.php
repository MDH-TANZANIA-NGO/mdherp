<?php

namespace App\Observers\HumanResource\PerformanceReview;

use App\Services\Generator\Number;
use App\Exceptions\GeneralException;
use App\Models\HumanResource\PerformanceReview\PrReport;

class PrReportObserver
{
    use Number;
    /**
     * Handle the app models human resource performance review pr report "created" event.
     *
     * @param  PrReport $prReport
     * @return void
     */
    public function created(PrReport $prReport)
    {
        //
    }

    /**
     * Handle the app models human resource performance review pr report "updated" event.
     *
     * @param  PrReport $prReport
     * @return void
     */
    public function updated(PrReport $prReport)
    {
        if($prReport->isDirty('done') && $prReport->number == null && $prReport->parent == null){
            if (!access()->user()->assignedSupervisor()) {
                throw new GeneralException('You are not assigned a supervisor');
            }
            $prReport->update(['number' => $this->generateNumber($prReport), 'supervisor_id' => access()->user()->assignedSupervisor()->supervisor_id]);
        }
    }

    /**
     * Handle the app models human resource performance review pr report "deleted" event.
     *
     * @param  PrReport $prReport
     * @return void
     */
    public function deleted(PrReport $prReport)
    {
        //
    }

    /**
     * Handle the app models human resource performance review pr report "restored" event.
     *
     * @param  PrReport $prReport
     * @return void
     */
    public function restored(PrReport $prReport)
    {
        //
    }

    /**
     * Handle the app models human resource performance review pr report "force deleted" event.
     *
     * @param  PrReport $prReport
     * @return void
     */
    public function forceDeleted(PrReport $prReport)
    {
        //
    }
}
