<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['*'], 'App\Http\View\Composers\WfTrack\WfTrackComposer');
        View::composer(['*'], 'App\Http\View\Composers\Requisition\RequisitionComposer');
        View::composer(['*'], 'App\Http\View\Composers\Leave\LeaveComposer');
        View::composer(['*'], 'App\Http\View\Composers\HumanResource\HireRequisition\HireRequisitionComposer');
        View::composer(['*'], 'App\Http\View\Composers\HumanResource\Advertisement\AdvertisementComposer');

    }
}
