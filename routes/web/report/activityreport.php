<?php
Route::group(['namespace' => 'Reports', 'middleware' => ['web', 'auth'], 'prefix' => 'activity_reports', 'as' => 'activity_report.'], function () {
    Route::get('index', 'ActivityReportController@index')->name('index');
//    Route::get('submitted', 'TimesheetReportController@getSubmittedTimesheets')->name('submitted');
//    Route::get('approved', 'TimesheetReportController@getApprovedTimesheets')->name('approved');
//    Route::get('rejected', 'TimesheetReportController@getRejectedTimesheets')->name('rejected');
//    Route::post('filter_range', 'TimesheetReportController@getFilteredRange')->name('filter_range');
//    Route::get('not_submitted', 'TimesheetReportController@getAllNotSubmittedTimesheet')->name('not_submitted');
});

//Route::group(['namespace' => 'Reports', 'middleware' => ['web', 'auth'], 'prefix' => 'leave_reports', 'as' => 'leave_report.'], function () {
//    Route::get('index', 'LeaveReportController@index')->name('index');
//    Route::get('submitted', 'LeaveReportController@getSubmittedLeaves')->name('submitted');
//    Route::get('approved', 'LeaveReportController@getApprovedLeaves')->name('approved');
//    Route::get('rejected', 'LeaveReportController@getRejectedLeaves')->name('rejected');
//});

