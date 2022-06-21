<?php

namespace App\Providers;

use App\Models\HumanResource\PerformanceReview\PrRemark;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Observers\HumanResource\PerformanceReview\PrRemarkObserver;
use App\Observers\HumanResource\PerformanceReview\PrReportObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('permission', function ($permission) {
            return access()->allow($permission);
        });
        PrReport::observe(PrReportObserver::class);
        PrRemark::observe(PrRemarkObserver::class);
    }
}
