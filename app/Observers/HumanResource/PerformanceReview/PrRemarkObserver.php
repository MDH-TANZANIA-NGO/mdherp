<?php

namespace App\Observers\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\PrRemark;

class PrRemarkObserver
{
    /**
     * Handle the pr remark "created" event.
     *
     * @param  \App\PrRemark  $prRemark
     * @return void
     */
    public function created(PrRemark $prRemark)
    {
        if(auth()->check()){
            $prRemark->user_id = access()->id();
            $prRemark->save();
        }
    }

    /**
     * Handle the pr remark "updated" event.
     *
     * @param  \App\PrRemark  $prRemark
     * @return void
     */
    public function updated(PrRemark $prRemark)
    {
        //
    }

    /**
     * Handle the pr remark "deleted" event.
     *
     * @param  \App\PrRemark  $prRemark
     * @return void
     */
    public function deleted(PrRemark $prRemark)
    {
        //
    }

    /**
     * Handle the pr remark "restored" event.
     *
     * @param  \App\PrRemark  $prRemark
     * @return void
     */
    public function restored(PrRemark $prRemark)
    {
        //
    }

    /**
     * Handle the pr remark "force deleted" event.
     *
     * @param  \App\PrRemark  $prRemark
     * @return void
     */
    public function forceDeleted(PrRemark $prRemark)
    {
        //
    }
}
