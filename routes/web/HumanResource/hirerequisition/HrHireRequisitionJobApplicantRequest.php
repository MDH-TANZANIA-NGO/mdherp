<?php
Route::group(['namespace' => 'HumanResource\HireRequisition', 'middleware' => ['web', 'auth'], 'prefix' => 'human-resource/job-applicant-requests', 'as' => 'job_applicant_request.'], function () {
        Route::get('', 'HrHireRequisitionJobApplicantRequestController@index')->name('index');
        Route::post('store', 'HrHireRequisitionJobApplicantRequestController@store')->name('store');
        Route::get('{uuid}/show', 'HrHireRequisitionJobApplicantRequestController@show')->name('show');
        Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
            Route::get('{id}/{application_id}/shortlist', 'HrHireRequisitionJobApplicantRequestController@shortlist')->name('shortlist');
        });
});
