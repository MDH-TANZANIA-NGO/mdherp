
<?php
Route::group(['namespace' => 'HumanResource\HireRequisition', 'middleware' => ['web', 'auth'], 'prefix' => 'job-shortlist', 'as' => 'jl.'], function () {
    Route::get('applications/{id}', 'HrHireRequisitionJobShortlistController@submit')->name('submit');
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('applications', 'HrHireRequisitionJobShortlistController@applicationDatatable')->name('application');
    });
});
