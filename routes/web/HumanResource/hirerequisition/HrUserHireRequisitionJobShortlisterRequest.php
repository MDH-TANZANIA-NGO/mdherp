<?php
Route::group(['namespace' => 'HumanResource\HireRequisition', 'middleware' => ['web', 'auth'], 'prefix' => 'human-resource/job-shortlisters', 'as' => 'job_shortlister.'], function () {
    Route::get('', 'HrUserHireRequisitionJobShortlisterRequestController@index')->name('index');
    Route::post('store', 'HrUserHireRequisitionJobShortlisterRequestController@store')->name('store');
    Route::get('{shortlister_request}/initiate', 'HrUserHireRequisitionJobShortlisterRequestController@initiate')->name('initiate');
    Route::get('{shortlister_request}/submit', 'HrUserHireRequisitionJobShortlisterRequestController@submit')->name('submit');
    Route::get('{shortlister_request}/show', 'HrUserHireRequisitionJobShortlisterRequestController@show')->name('show');
});
