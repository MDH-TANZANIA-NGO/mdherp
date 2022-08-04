<?php
Route::group(['namespace' => 'Reports', 'middleware' => ['web', 'auth'], 'prefix' => 'activity_reports', 'as' => 'activity_report.'], function () {
    Route::get('index', 'ActivityReportController@index')->name('index');
    Route::get('create', 'ActivityReportController@create')->name('create');
    Route::get('initiate', 'ActivityReportController@initiate')->name('initiate');
    Route::get('{uuid}/show', 'ActivityReportController@show')->name('show');
//    Route::get('approved', 'TimesheetReportController@getApprovedTimesheets')->name('approved');
//    Route::get('rejected', 'TimesheetReportController@getRejectedTimesheets')->name('rejected');
//    Route::post('filter_range', 'TimesheetReportController@getFilteredRange')->name('filter_range');
//    Route::get('not_submitted', 'TimesheetReportController@getAllNotSubmittedTimesheet')->name('not_submitted');
});

Route::group(['namespace' => 'Reports', 'middleware' => ['web', 'auth'], 'prefix' => 'access_activity_reports', 'as' => 'access_activity_report.'], function () {
    Route::get('processing', 'ActivityReportController@AccessProcessingDatatable')->name('processing');
    Route::get('approved', 'ActivityReportController@AccessApprovedDatatable')->name('approved');
    Route::get('rejected', 'ActivityReportController@AccessRejectedDatatable')->name('rejected');
});

