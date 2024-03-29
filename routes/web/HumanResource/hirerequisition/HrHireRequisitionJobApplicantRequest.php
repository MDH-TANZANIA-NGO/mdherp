<?php
Route::group(['namespace' => 'HumanResource\HireRequisition', 'middleware' => ['web', 'auth'], 'prefix' => 'human-resource/job-applicant-requests', 'as' => 'job_applicant_request.'], function () {
        Route::get('', 'HrHireRequisitionJobApplicantRequestController@index')->name('index');
        Route::post('store', 'HrHireRequisitionJobApplicantRequestController@store')->name('store');
        Route::get('{uuid}/show', 'HrHireRequisitionJobApplicantRequestController@show')->name('show');
       //Datatables
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('processing', 'HrHireRequisitionJobApplicantRequestController@ProcessingDatatable')->name('processing');
        Route::get('returned-for-modications', 'HrHireRequisitionJobApplicantRequestController@ReturnedForModificationDatatable')->name('return_for_modification');
        Route::get('approved', 'HrHireRequisitionJobApplicantRequestController@ApprovedDatatable')->name('approved');
    });
});