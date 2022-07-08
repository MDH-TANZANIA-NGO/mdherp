<?php
Route::group(['namespace' => 'HumanResource\HireRequisition', 'middleware' => ['web', 'auth'], 'prefix' => 'human-resource/job-shortlister-users', 'as' => 'job_shortlist_user.'], function () {
    Route::post('{hr_user_shortlister_id}/{hr_hire_requisition_job_id}/store', 'HrUserHireRequisitionJobShortlisterUserController@store')->name('store');
});
