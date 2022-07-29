<?php
Route::group(['namespace' => 'HumanResource\HireRequisition', 'middleware' => ['web', 'auth'], 'prefix' => 'human-resource/job-shortlisters', 'as' => 'job_shortlister.'], function () {
    Route::get('', 'HrUserHireRequisitionJobShortlisterRequestController@index')->name('index');
    Route::post('store', 'HrUserHireRequisitionJobShortlisterRequestController@store')->name('store');
    Route::put('{shortlister_request}/update', 'HrUserHireRequisitionJobShortlisterRequestController@update')->name('update');
    Route::get('{shortlister_request}/initiate', 'HrUserHireRequisitionJobShortlisterRequestController@initiate')->name('initiate');
    Route::get('{shortlister_request}/submit', 'HrUserHireRequisitionJobShortlisterRequestController@submit')->name('submit');
    Route::get('{shortlister_request}/show', 'HrUserHireRequisitionJobShortlisterRequestController@show')->name('show');
    //Datatables
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('processing', 'HrUserHireRequisitionJobShortlisterRequestController@ProcessingDatatable')->name('processing');
        Route::get('returned-for-modications', 'HrUserHireRequisitionJobShortlisterRequestController@ReturnedForModificationDatatable')->name('return_for_modification');
        Route::get('approved', 'HrUserHireRequisitionJobShortlisterRequestController@ApprovedDatatable')->name('approved');
        Route::get('saved', 'HrUserHireRequisitionJobShortlisterRequestController@SavedDatatable')->name('saved');
    });
});
