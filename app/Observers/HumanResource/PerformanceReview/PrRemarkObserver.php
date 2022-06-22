<?php

namespace App\Observers\HumanResource\PerformanceReview;

use App\Models\Auth\User;
use App\Models\HumanResource\PerformanceReview\PrRemark;
use App\Notifications\Workflow\WorkflowNotification;

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
        //Send Email to user
        if($prRemark->pr_remarks_cv_id == 42){
            $prRemark->update(['acceptable' => true]);
            $email_resource = (object)[
                'link' =>  route('hr.pr.show',$prRemark->prReport),
                'subject' => "Remarks From your supervisor on ".$prRemark->prReport->parent->type->title." ".$prRemark->prReport->parent->number,
                'message' => 'Remarks <br>'.$prRemark->remarks
            ];
            $prRemark->prReport->user->notify(new WorkflowNotification($email_resource));
        }

        if($prRemark->pr_remarks_cv_id == 43){
            $prRemark->update(['acceptable' => true]);
            $email_resource = (object)[
                'link' =>  route('hr.pr.show',$prRemark->prReport),
                'subject' => "Kindly Processd with workflow ".$prRemark->prReport->parent->type->title." ".$prRemark->prReport->parent->number,
                'message' => 'Here is the Remark <br>'.$prRemark->remarks
            ];
            // User::query()->find($prRemark->prReport->parent->supervisor_id)->notify(new WorkflowNotification($email_resource));
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
