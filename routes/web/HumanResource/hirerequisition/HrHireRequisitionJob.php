<?php
Route::group(['namespace' => 'humanResource\HireRequisition', 'middleware' => ['web', 'auth'], 'prefix' => 'human-resource', 'as' => 'hr.'], function () {
    Route::group(['prefix' => 'hire-requisition/jobs', 'as' => 'job.'], function () {
        Route::get('applications', 'HireRequisitionJobController@applications')->name('application');
        Route::get('{hire_requisition_job}/show', 'HireRequisitionJobController@show')->name('show');
        Route::get('{hire_requisition_job}/mimosa-recruiment-portal-applicant/{online_applicant_id}/show/', 'HireRequisitionJobController@showMore')->name('show_more');
        Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
            Route::get('applications', 'HireRequisitionJobController@applicationDatatable')->name('application');
            Route::get('applications/doesnot-have-requests', 'HireRequisitionJobController@jobApplicationWhichHaveShortlistedApplicantsDatatable')->name('doesnot_have_request');
        });
        // JobApplicant
        Route::group(['prefix' => 'applications', 'as' => 'application.'], function () {
            Route::get('{id}/{application_id}/shortlist', 'HrHireRequisitionJobApplicantController@shortlist')->name('shortlist');
            Route::get('{id}/{application_id}/un-shortlist', 'HrHireRequisitionJobApplicantController@unShortlist')->name('un_shortlist');
        });
    });
});
