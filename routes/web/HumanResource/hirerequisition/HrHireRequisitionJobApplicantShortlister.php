<?php
Route::group(['namespace' => 'HumanResource\HireRequisition', 'middleware' => ['web', 'auth'], 'prefix' => 'human-resource-job-applicant-shortlister', 'as' => 'job_applicant_shortlister.'], function () {
        Route::post('application/{hire_requisition_job}/shortlist', 'HrHireRequisitionJobApplicantShortlisterController@shortlist')->name('shortlist');
});
