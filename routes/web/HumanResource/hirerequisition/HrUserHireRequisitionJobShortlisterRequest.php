<?php
Route::group(['namespace' => 'HumanResource\HireRequisition', 'middleware' => ['web', 'auth'], 'prefix' => 'human-resource/job-shortlisters', 'as' => 'job_shortlister.'], function () {
    Route::post('store', 'HrUserHireRequisitionJobShortlisterRequestController@store')->name('store');
    Route::get('{shortlister_request}/initiate', 'HrUserHireRequisitionJobShortlisterRequestController@initiate')->name('initiate');
});
