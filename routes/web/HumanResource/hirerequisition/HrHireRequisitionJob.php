
<?php
Route::group(['namespace' => 'HumanResource\HireRequisition', 'middleware' => ['web', 'auth'], 'prefix' => 'human-resource', 'as' => 'hr.'], function () {
    Route::group(['prefix' => 'hire-requisition/jobs', 'as' => 'job.'], function () {
        Route::get('applications', 'HireRequisitionJobController@applications')->name('application');
        Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
            Route::get('applications', 'HireRequisitionJobController@applicationDatatable')->name('application');
        });
    });
});
